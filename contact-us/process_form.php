<?php
// Habilita a exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Informações de conexão com o banco de dados
$servername = "server1423"; // geralmente é 'localhost'
$username = "u562265580_contact_user"; // seu nome de usuário do banco de dados
$password = "d>TDAf9[2I"; // sua senha do banco de dados
$dbname = "u562265580_contact_form"; // nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Conexão falhou: " . $conn->connect_error]));
}

// Processa os dados do formulário se a requisição for do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos estão presentes
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        $name = $_POST['name'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // Sanitiza o email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["status" => "error", "message" => "O email fornecido é inválido."]);
            exit;
        }

        // Usa consulta preparada para evitar SQL Injection
        $stmt = $conn->prepare("INSERT INTO contatos (name, tel, email, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $tel, $email, $subject, $message);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Erro ao inserir dados: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Os campos 'Name', 'E-mail' e 'Message' são obrigatórios."]);
    }
}

// Fecha a conexão
$conn->close();
?>
