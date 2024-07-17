
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclua o autoload do Composer
require 'vendor/autoload.php';

$servername = "localhost";
$database = "u562265580_contact_form";
$username = "u562265580_contact_user";
$password = "N>UQhF8np5";

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

// Configuração do PHPMailer
$mail = new PHPMailer(true);
try {
    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'dscoveryportugal@gmail.com';
    $mail->Password = 'R7p!O2x@mB9z&T4X';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remetente e destinatário
    $mail->setFrom('dscoveryportugal@gmail.com', 'Discovery Portugal');
    $mail->addAddress('rodrigocowbr@gmail.com'); // E-mail do chefe
    $mail->addAddress($email); // E-mail do cliente

    // Assunto e corpo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Dados do Formulário';
    $mail->Body    = "<h1>Dados do Formulário</h1>
                      <p><strong>Nome:</strong> $name</p>
                      <p><strong>Telefone:</strong> $tel</p>
                      <p><strong>Email:</strong> $email</p>
                      <p><strong>Assunto:</strong> $subject</p>
                      <p><strong>Mensagem:</strong> $message</p>";

    // Enviando o e-mail
    $mail->send();
    echo json_encode(["status" => "success", "message" => "Dados enviados e e-mail notificado com sucesso!"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Não foi possível enviar o e-mail. Erro: {$mail->ErrorInfo}"]);
}

// Fecha a conexão
mysqli_close($conn);
?>
