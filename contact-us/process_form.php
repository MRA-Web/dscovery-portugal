<?php
$servername = "162.159.25.42"; // O nome do servidor fornecido pela Hostinger
$database = "u562265580_contact_form"; // Nome do banco de dados
$username = "u562265580_contact_user"; // Nome de usuário do banco de dados
$password = "N>UQhF8np5"; // Senha do banco de dados

// Cria a conexão
$conn = mysqli_connect($servername, $username, $password, $database);

// Verifica a conexão
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Obtém os dados do formulário
$name = mysqli_real_escape_string($conn, $_POST['name']);
$tel = mysqli_real_escape_string($conn, $_POST['tel']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Cria a consulta SQL para inserir os dados
$sql = "INSERT INTO contatos (name, tel, email, subject, message) VALUES ('$name', '$tel', '$email', '$subject', '$message')";

<<<<<<< HEAD
// Executa a consulta
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
=======
        // Usa consulta preparada para evitar SQL Injection
        $stmt = $conn->prepare(`INSERT INTO contatos (name, tel, email, subject, message) VALUES (?, ?, ?, ?, ?)`);
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
>>>>>>> e1537010f4b090e31b13a125fbab152f8161e0d3
}

// Fecha a conexão
mysqli_close($conn);
?>
