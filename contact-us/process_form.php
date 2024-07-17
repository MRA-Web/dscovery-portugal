<?php
// Habilita a exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON

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

// Cria a consulta SQL para inserir os dados
$sql = "INSERT INTO contatos (name, tel, email, subject, message) VALUES ('$name', '$tel', '$email', '$subject', '$message')";

// Executa a consulta e verifica se a inserção foi bem-sucedida
if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "SQL Error: " . mysqli_error($conn)]);
}

// Fecha a conexão
mysqli_close($conn);
?>
