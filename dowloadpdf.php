<?php
// Incluir a biblioteca FPDF
require('fpdf.php');

// Conectar ao banco de dados
$host = 'localhost';
$dbname = 'dbpadaria';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultar dados
$sql = "SELECT * FROM gastos";
$result = $conn->query($sql);

// Criar um novo PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Adicionar um título
$pdf->Cell(0, 10, 'Tabela de Gastos', 0, 1, 'C');

// Definir fonte para o corpo do PDF
$pdf->SetFont('Arial', '', 12);

// Adicionar os dados da tabela
if ($result->num_rows > 0) {
    // Cabeçalho da tabela
    $pdf->Cell(40, 10, 'ID', 1);
    $pdf->Cell(40, 10, 'Nome Funcionario', 1);
    $pdf->Cell(40, 10, 'Gastos Funcionario', 1);
    $pdf->Cell(40, 10, 'Data dos Gasto', 1);
    $pdf->Ln();

    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, $row['ID'], 1);
        $pdf->Cell(40, 10, $row['Nome_Func'], 1);
        $pdf->Cell(40, 10, $row['Gastos_Func'], 1);
        $pdf->Cell(40, 10, $row['Data_Gasto'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'Nenhum dado encontrado.', 0, 1);
}

// Fechar a conexão com o banco
$conn->close();

// Gerar o PDF
$pdf->Output('D', 'gastos.pdf'); // 'D' força o download do arquivo
?>
