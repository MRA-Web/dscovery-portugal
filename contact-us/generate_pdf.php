<?php
require 'fpdf.php';

function generatePDF($id) {
    $servername = "localhost";
    $database = "u562265580_contact_form";
    $username = "u562265580_contact_user";
    $password = "N>UQhF8np5";

    // Cria a conexão
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Verifica a conexão
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Consulta os dados com base no ID
    $sql = "SELECT * FROM contatos WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Informacoes do Contato');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 12);
        foreach ($row as $key => $value) {
            $pdf->Cell(40, 10, ucfirst($key) . ': ' . $value);
            $pdf->Ln();
        }
        $file = 'pdfs/contato_' . $id . '.pdf';
        $pdf->Output('F', $file);

        mysqli_close($conn);
        return $file;
    } else {
        mysqli_close($conn);
        return false;
    }
}
?>
