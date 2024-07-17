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
    // Não envia a mensagem de erro, apenas encerra
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
mysqli_query($conn, $sql);

// Fecha a conexão
mysqli_close($conn);
?>
