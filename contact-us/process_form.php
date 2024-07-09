<?php
// Configuração do banco de dados
$servername = "localhost"; // ou o IP do servidor
$username = "root"; // usuário do banco de dados
$password = ""; // senha do banco de dados
$dbname = "contact_form"; // nome do banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $name = $conn->real_escape_string($_POST['name']);
    $tel = $conn->real_escape_string($_POST['tel']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    // Prepara a consulta SQL
    $sql = "INSERT INTO usuarios (name, tel, email, subject, message) VALUES ('$name', '$tel', '$email', '$subject', '$message')";

    // Executa a consulta
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fecha a conexão
$conn->close();
?>
