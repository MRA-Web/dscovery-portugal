<?php
// Informações de conexão com o banco de dados
$servername = "localhost"; // geralmente é 'localhost'
$username = "contact_user"; // seu nome de usuário do banco de dados
$password = "d>TDAf9[2I"; // sua senha do banco de dados
$dbname = "contact_form"; // nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Processa os dados do formulário se a requisição for do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contatos (name, tel, email, subject, message) VALUES ('$name', '$tel', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
}

// Fecha a conexão
$conn->close();
?>
