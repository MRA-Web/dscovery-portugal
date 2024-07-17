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
    // Verificar se a biblioteca FPDF está disponível
    $fpdfPath = '/contact-us/composer/vendor/fpdf/src/Fpdf.php';
    if (!file_exists($fpdfPath)) {
        die("Erro: Biblioteca FPDF não encontrada em '$fpdfPath'.");
    }

    require_once $fpdfPath; // Inclua a biblioteca FPDF
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
    $pdf = new FPDF();
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
    
    // Enviar e-mail para o chefe
    $to = $bossEmail;
    $subject = "Novo formulário de contato";
    $body = "Um novo formulário de contato foi enviado. Veja o PDF em anexo.";
    $headers = "From: no-reply@seusite.com\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

    $mimeBoundary = "boundary";
    $message = "--" . $mimeBoundary . "\r\n";
    $message .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $message .= $body . "\r\n\r\n";
    $message .= "--" . $mimeBoundary . "\r\n";
    $message .= "Content-Type: application/pdf; name=\"" . basename($pdfPath) . "\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"" . basename($pdfPath) . "\"\r\n\r\n";
    $message .= chunk_split(base64_encode(file_get_contents($pdfPath))) . "\r\n\r\n";
    $message .= "--" . $mimeBoundary . "--";

    if (!mail($to, $subject, $message, $headers)) {
        error_log("Erro ao enviar e-mail para o chefe.");
    }

    // Enviar e-mail para o cliente
    $to = $clientEmail;
    $subject = "Recebemos seu formulário";
    $body = "Obrigado por entrar em contato. Recebemos seu formulário e responderemos em breve.";
    $headers = "From: no-reply@seusite.com\r\n";
    $headers .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
    
    if (!mail($to, $subject, $body, $headers)) {
        error_log("Erro ao enviar e-mail para o cliente.");
    }
}
?>
