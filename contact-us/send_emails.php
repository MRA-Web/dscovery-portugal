<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendEmails($pdfFile, $clientEmail) {
    if (!$pdfFile) {
        return false; // Se o arquivo PDF não foi gerado, retorna falso
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dscoveryportugal@gmail.com';
        $mail->Password = 'R7p!O2x@mB9z&T4X';
        
        // Usando porta 587 com STARTTLS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // E-mail para o chefe
        $mail->setFrom('dscoveryportugal@gmail.com', 'Dscovery Portugal');
        $mail->addAddress('rodrigocowbr@gmail.com');
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
