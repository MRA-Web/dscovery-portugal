<?php
// Exibir todos os erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configurações do banco de dados
$servername = "localhost";
$username = "u562265580_contact_user";
$password = "N>UQhF8np5";
$dbname = "u562265580_contact_form";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter dados do formulário
$name = $_POST['name'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Preparar e executar a consulta SQL
$sql = "INSERT INTO contatos (name, tel, email, subject, message) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conn->error);
}

$stmt->bind_param("sssss", $name, $tel, $email, $subject, $message);

if ($stmt->execute()) {
    // Incluir o autoloader do Composer
    require_once 'vendor/autoload.php';

    // Usar a biblioteca FPDF diretamente
    require_once 'vendor/fpdf/fpdf/src/Fpdf.php';

    $pdfPath = generate_pdf($name, $tel, $email, $subject, $message);
    
    // Enviar e-mails
    send_emails($pdfPath, $email);

    echo "Formulário enviado com sucesso!";
} else {
    die("Erro ao enviar formulário: " . $stmt->error);
}

// Fechar a conexão
$stmt->close();
$conn->close();

// Função para gerar PDF
function generate_pdf($name, $tel, $email, $subject, $message) {
    // Criar uma instância do FPDF
    $pdf = new Fpdf();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);
    
    $pdf->Cell(0, 10, 'Nome: ' . $name, 0, 1);
    $pdf->Cell(0, 10, 'Telefone: ' . $tel, 0, 1);
    $pdf->Cell(0, 10, 'E-mail: ' . $email, 0, 1);
    $pdf->Cell(0, 10, 'Assunto: ' . $subject, 0, 1);
    $pdf->Cell(0, 10, 'Mensagem: ' . $message, 0, 1);

    // Verificar se a pasta 'pdfs' existe, caso contrário, criar
    $pdfDir = 'pdfs';
    if (!is_dir($pdfDir)) {
        mkdir($pdfDir, 0755, true);
    }

    $pdfPath = $pdfDir . '/' . $email . '_contact_form.pdf';
    $pdf->Output($pdfPath, 'F');
    
    return $pdfPath;
}

// Função para enviar e-mails
function send_emails($pdfPath, $clientEmail) {
    $bossEmail = 'dscoveryportugal@gmail.com';

    // Usar a biblioteca PHPMailer diretamente
    require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
    require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';

    // Configurações do servidor SMTP
    $smtpHost = 'smtp.gmail.com';  // Defina o servidor SMTP
    $smtpUsername = 'dscoveryportugal@gmail.com';                  
    $smtpPassword = 'R7p!O2x@mB9z&T4X';                           
    $smtpPort = 587;                                   

    // Função para enviar e-mail
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();                                           
        $mail->Host       = $smtpHost;                               
        $mail->SMTPAuth   = true;                              
        $mail->Username   = $smtpUsername;                  
        $mail->Password   = $smtpPassword;                           
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;         
        $mail->Port       = $smtpPort;                                   

        // Enviar e-mail para o chefe
        $mail->setFrom('no-reply@seusite.com', 'Mailer');
        $mail->addAddress($bossEmail, 'Chefe');     
        $mail->isHTML(true);                                  
        $mail->Subject = 'Novo formulário de contato';
        $mail->Body    = 'Um novo formulário de contato foi enviado. Veja o PDF em anexo.';
        $mail->addAttachment($pdfPath);
        $mail->send();

        // Enviar e-mail para o cliente
        $mail->clearAddresses();
        $mail->addAddress($clientEmail);     
        $mail->Subject = 'Recebemos seu formulário';
        $mail->Body    = 'Obrigado por entrar em contato. Recebemos seu formulário e responderemos em breve.';
        $mail->send();
    } catch (Exception $e) {
        error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
    }
}
?>
