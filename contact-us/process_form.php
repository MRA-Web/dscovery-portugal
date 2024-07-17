<?php
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

// Executa a consulta
if (mysqli_query($conn, $sql)) {
    // Obtém o ID do registro inserido
    $last_id = mysqli_insert_id($conn);

    // Chama o script para gerar o PDF
    require 'generate_pdf.php';
    $pdf_file = generatePDF($last_id);

    // Chama o script para enviar os e-mails
    require 'send_emails.php';
    sendEmails($pdf_file, $email);

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . mysqli_error($conn)]);
}

// Fecha a conexão
mysqli_close($conn);
?>
