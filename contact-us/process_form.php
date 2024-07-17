<?php
// Exibir todos os erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Importar namespaces do Symfony Mailer
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

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
    require_once __DIR__ . '/vendor/autoload.php';

    // Gerar o PDF usando o TCPDF
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

// Função para gerar PDF usando TCPDF
function generate_pdf($name, $tel, $email, $subject, $message) {
    // Criar uma instância do TCPDF
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);
    
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

// Função para enviar e-mails usando Symfony Mailer
function send_emails($pdfPath, $clientEmail) {
    $bossEmail = 'dscoveryportugal@gmail.com';

    // Configurações do servidor SMTP
    $smtpHost = 'smtp.gmail.com';  // Servidor SMTP do Gmail
    $smtpUsername = 'dscoveryportugal@gmail.com'; // Seu e-mail
    $smtpPassword = 'R7p!O2x@mB9z&T4X'; // Senha do seu e-mail
    $smtpPort = 587; // Porta SMTP para TLS

    // Criar o transporte
    $transport = new EsmtpTransport($smtpHost, $smtpPort, 'tls');
    $transport->setUsername($smtpUsername);
    $transport->setPassword($smtpPassword);

    // Criar o mailer
    $mailer = new Mailer($transport);

    // Enviar e-mail para o chefe
    $email = (new Email())
        ->from($smtpUsername)
        ->to($bossEmail)
        ->subject('Novo formulário de contato')
        ->text('Um novo formulário de contato foi enviado. Veja o PDF em anexo.')
        ->attachFromPath($pdfPath);
    
    try {
        $mailer->send($email);

        // Enviar e-mail para o cliente
        $email = (new Email())
            ->from($smtpUsername)
            ->to($clientEmail)
            ->subject('Recebemos seu formulário')
            ->text('Obrigado por entrar em contato. Recebemos seu formulário e responderemos em breve.');
        
        $mailer->send($email);
    } catch (TransportExceptionInterface $e) {
        error_log("Erro ao enviar e-mail: " . $e->getMessage());
    }
}
?>
