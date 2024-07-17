<?php
require 'vendor/autoload.php'; // Inclua o autoload do Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use FPDF\FPDF;

$servername = "localhost"; // O nome do servidor fornecido pela Hostinger
$database = "u562265580_contact_form"; // Nome do banco de dados
$username = "u562265580_contact_user"; // Nome de usuário do banco de dados
$password = "N>UQhF8np5"; // Senha do banco de dados

header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON

// Cria a conexão
$conn = mysqli_connect($servername, $username, $password, $database);

// Verifica a conexão
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

// Executa a consulta e verifica se houve erro
if (mysqli_query($conn, $sql)) {
    // Geração do PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Dados do Formulário', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Nome: ' . $name, 0, 1);
    $pdf->Cell(0, 10, 'Telefone: ' . $tel, 0, 1);
    $pdf->Cell(0, 10, 'Email: ' . $email, 0, 1);
    $pdf->Cell(0, 10, 'Assunto: ' . $subject, 0, 1);
    $pdf->Cell(0, 10, 'Mensagem: ' . $message, 0, 1);
    
    // Salva o PDF no servidor
    $pdfFile = 'form_data.pdf';
    $pdf->Output($pdfFile, 'F');

    // Configuração do PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configurações do servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ou o servidor SMTP que você está usando
        $mail->SMTPAuth = true;
        $mail->Username = 'dscoveryportugal@gmail.com';
        $mail->Password = 'R7p!O2x@mB9z&T4X';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remetente e destinatário
        $mail->setFrom('dscoveryportugal@gmail.com', 'Discovery Portugal');
        $mail->addAddress('rodrigocowbr@gmail.com'); // Adicione o e-mail do seu chefe
        $mail->addAddress($email); // Adiciona o e-mail do cliente

        // Assunto e corpo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Dados do Formulário';
        $mail->Body    = 'O PDF com os dados do formulário está em anexo.';

        // Anexando o PDF
        $mail->addAttachment($pdfFile);

        // Enviando o e-mail
        $mail->send();

        echo json_encode(["status" => "success", "message" => "Dados enviados e e-mails notificados com sucesso!"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Não foi possível enviar o e-mail. Erro: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Erro: " . mysqli_error($conn)]);
}

// Fecha a conexão
mysqli_close($conn);
?>
