<?php
require 'vendor/autoload.php'; // Inclui o autoload do Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use TCPDF;

// Configurações do banco de dados
$servername = "localhost";
$database = "u562265580_contact_form";
$username = "u562265580_contact_user";
$password = "N>UQhF8np5";

// Cria a conexão
$conn = mysqli_connect($servername, $username, $password, $database);

// Verifica a conexão
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Obtém os dados do formulário
$name = mysqli_real_escape_string($conn, $_POST['name']);
$tel = mysqli_real_escape_string($conn, $_POST['tel']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Cria a consulta SQL para inserir os dados
$sql = "INSERT INTO contatos (name, tel, email, subject, message) VALUES ('$name', '$tel', '$email', '$subject', '$message')";

// Executa a consulta
if (!mysqli_query($conn, $sql)) {
    die("Error: " . $sql . "<br>" . mysqli_error($conn));
}

// Gera o PDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, "Contact Form Submission", 0, 1, 'C');
$pdf->Cell(0, 10, "Name: $name", 0, 1);
$pdf->Cell(0, 10, "Phone: $tel", 0, 1);
$pdf->Cell(0, 10, "Email: $email", 0, 1);
$pdf->Cell(0, 10, "Subject: $subject", 0, 1);
$pdf->MultiCell(0, 10, "Message: $message");
$pdf->Output('contact_form.pdf', 'F');

// Enviar e-mail para o chefe com o PDF em anexo
$mail = new PHPMailer(true);
try {
    $mail->setFrom('rodrigochoradms@gmail.com', 'Rodrigo');
    $mail->addAddress('dscoveryportugal@gmail.com', 'DscoveryPortugal');
    $mail->Subject = 'New Contact Form Submission';
    $mail->Body    = 'Please find attached the PDF with the contact form submission details.';
    $mail->addAttachment('contact_form.pdf');
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// Enviar e-mail para o cliente
$mail->clearAddresses();
$mail->addAddress($email, $name);
$mail->Subject = 'Thank you for contacting us';
$mail->Body    = 'Thank you for your message. We will contact you shortly.';

// Envia o e-mail
if (!$mail->send()) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// Fecha a conexão
mysqli_close($conn);
?>
