<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

function sendEmails($id, $clientEmail) {
    $pdfFile = generatePDF($id);
    if (!$pdfFile) {
        return false;
    }

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

        // E-mail para o chefe
        $mail->setFrom('dscoveryportugal@gmail.com', 'Discovery Portugal');
        $mail->addAddress('rodrigocowbr@gmail.com'); // Substitua pelo e-mail do chefe
        $mail->addAttachment($pdfFile);

        $mail->isHTML(true);
        $mail->Subject = 'Novo contato recebido';
        $mail->Body = 'Um novo contato foi recebido. O PDF está anexado.';

        $mail->send();

        // E-mail para o cliente
        $mail->clearAddresses();
        $mail->addAddress($clientEmail);
        $mail->Subject = 'Obrigado por entrar em contato';
        $mail->Body = 'Obrigado por entrar em contato. Vamos respondê-lo em breve.';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
