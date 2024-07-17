<?php
require 'fpdf/fpdf.php'; // Inclui a biblioteca FPDF para gerar PDFs

function generatePDF($id) {
    $servername = "localhost"; // Nome do servidor de banco de dados
    $database = "u562265580_contact_form"; // Nome do banco de dados
    $username = "u562265580_contact_user"; // Nome de usuário do banco de dados
    $password = "N>UQhF8np5"; // Senha do banco de dados

    // Cria a conexão com o banco de dados
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Verifica se a conexão foi bem-sucedida
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Consulta os dados do contato com base no ID
    $sql = "SELECT * FROM contatos WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Verifica se houve resultados na consulta
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // Obtém os dados do contato

        $pdf = new FPDF(); // Cria um novo documento PDF
        $pdf->AddPage(); // Adiciona uma página ao documento
        $pdf->SetFont('Arial', 'B', 16); // Define a fonte do PDF
        $pdf->Cell(40, 10, 'Informacoes do Contato'); // Adiciona um título
        $pdf->Ln(); // Pula uma linha
        $pdf->SetFont('Arial', '', 12); // Define a fonte para os dados do contato
        foreach ($row as $key => $value) {
            $pdf->Cell(40, 10, ucfirst($key) . ': ' . $value); // Adiciona os dados do contato ao PDF
            $pdf->Ln(); // Pula uma linha
        }

        // Define o caminho absoluto para o diretório pdfs
        $file = '/contact-us/pdfs/contato_' . $id . '.pdf';
        $pdf->Output('F', $file); // Salva o PDF no caminho especificado

        mysqli_close($conn); // Fecha a conexão com o banco de dados
        return $file; // Retorna o caminho do arquivo PDF gerado
    } else {
        mysqli_close($conn); // Fecha a conexão com o banco de dados
        return false; // Retorna falso se não houver resultados na consulta
    }
}
?>
