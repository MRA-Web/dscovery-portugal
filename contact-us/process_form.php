<?php
require 'vendor/autoload.php'; // Inclua o autoload do Composer se estiver usando Composer
require 'fpdf/fpdf.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$servername = "localhost"; // O nome do servidor fornecido pela Hostinger
$database = "u562265580_contact_form"; // Nome do banco de dados
$username = "u562265580_contact_user"; // Nome de usuário do banco de dados
$password = "N>UQhF8np5"; // Senha do banco de dados

header('Content-Type: application/json');

// Cria a conexão
$conn = mysqli_connect($servername, $username, $password, $database);

// Verifica a conexão
if (!$conn) {
    echo json_encode(["status" => "error"]);
    exit();
}

// Obtém os dados do formulário
$name = mysqli_real_escape_string($conn, $_POST['name']);
$tel = mysqli_real_escape_string($conn, $_POST['tel']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Cria o PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Contact Form Submission', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Name: ' . $name, 0, 1);
$pdf->Cell(0, 10, 'Telephone: ' . $tel, 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $email, 0, 1);
$pdf->Cell(0, 10, 'Subject: ' . $subject, 0, 1);
$pdf->Cell(0, 10, 'Message: ' . $message, 0, 1);

// Salva o PDF em um arquivo temporário
$pdfFilePath = 'tmp/contact_form_submission.pdf';
$pdf->Output($pdfFilePath, 'F');

// Envia o email com o PDF para o chefe
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Alterar conforme o servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'dscoveryportugal@gmail.com'; // Seu email
    $mail->Password = 'R7p!O2x@mB9z&T4X'; // Sua senha
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remetente e destinatário
    $mail->setFrom('dscoveryportugal@gmail.com', 'Discovery Portugal');
    $mail->addAddress('chefe@example.com'); // Email do chefe
    $mail->Subject = 'New Contact Form Submission';
    $mail->Body = 'A new contact form has been submitted. Please find the attached PDF for details.';
    $mail->addAttachment($pdfFilePath); // Anexa o PDF

    $mail->send();
} catch (Exception $e) {
    echo json_encode(["status" => "error"]);
    unlink($pdfFilePath); // Remove o PDF temporário em caso de falha
    exit();
}

// Envia o email de confirmação para o cliente
$mail->clearAddresses();
$mail->addAddress($email);
$mail->Subject = 'Thank You for Your Contact Request';
$mail->Body = 'Thank you for reaching out to us. We have received your message and will get back to you shortly.';

// Envia o email de confirmação
try {
    $mail->send();
    echo json_encode(["status" => "success"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error"]);
}

// Remove o PDF temporário
unlink($pdfFilePath);

// Fecha a conexão
mysqli_close($conn);
?>
