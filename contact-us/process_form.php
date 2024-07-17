<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use TCPDF;

require 'vendor/autoload.php'; // Inclui o autoload do Composer

// Configurações de erro
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$database = "u562265580_contact_form";
$username = "u562265580_contact_user";
$password = "N>UQhF8np5";

header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON

// Cria a conexão
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Connection failed: " . mysqli_connect_error()]);
    exit();
}

// Obtém os dados do formulário
$name = mysqli_real_escape_string($conn, $_POST['name']);
$tel = mysqli_real_escape_string($conn, $_POST['tel']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Cria a consulta SQL para inserir os dados
$sql = "INSERT INTO contatos (name, tel, email, subject, message) VALUES ('$name', '$tel', '$email', '$subject', '$message')";

if (mysqli_query($conn, $sql)) {
    // Gera o PDF com TCPDF
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, "Contact Form Submission", 0, 1, 'C');
    $pdf->Cell(0, 10, "Name: $name", 0, 1);
    $pdf->Cell(0, 10, "Telephone: $tel", 0, 1);
    $pdf->Cell(0, 10, "Email: $email", 0, 1);
    $pdf->Cell(0, 10, "Subject: $subject", 0, 1);
    $pdf->Cell(0, 10, "Message: $message", 0, 1);

    // Salva o PDF em um arquivo
    $pdfFile = 'contact_form_submission.pdf';
    $pdf->Output($pdfFile, 'F');

    // Envia o e-mail para o chefe
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor de e-mail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dscoveryportugal@gmail.com';
        $mail->Password = 'R7p!O2x@mB9z&T4X';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Envia o e-mail para o chefe
        $mail->setFrom('dscoveryportugal@gmail.com', 'Discovery Portugal');
        $mail->addAddress('dscoveryportugal@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = 'A new contact form submission has been received. Please find the attached PDF with the details.';
        $mail->addAttachment($pdfFile);

        $mail->send();

        // Envio do alerta para o cliente
        $mail->clearAddresses();
        $mail->addAddress($email);
        $mail->Subject = 'Thank You for Contacting Us';
        $mail->Body = 'Dear ' . $name . ',<br><br>Thank you for contacting us. We will get back to you soon.<br><br>Best regards,<br>Discovery Portugal';

        $mail->send();

        echo json_encode(["status" => "success", "message" => "New record created, PDF sent to the boss and alert sent to the client"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Mailer Error: " . $mail->ErrorInfo]);
    }

    // Remove o arquivo PDF após o envio
    unlink($pdfFile);
} else {
    echo json_encode(["status" => "success", "message" => "Obrigado por entrar em contato! Entraremos em breve."]);

}

// Fecha a conexão
mysqli_close($conn);
