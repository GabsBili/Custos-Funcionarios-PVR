<?php
// Conectar ao banco de dados
$host = 'localhost';
$dbname = 'dbpadaria';
$user = 'root';
$senha = '';

$conn = new mysqli($host, $user, $senha, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter os dados do formulário
$id = $_POST['id'];
$nome = $_POST['nome'];
$gastos = $_POST['gasto'];
$data = $_POST['data'];

// Atualizar os dados no banco de dados
$sql = "UPDATE gastos SET Nome_Func = '$nome', Gastos_Func = '$gastos', Data_Gasto='$data' WHERE ID = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Registro atualizado com sucesso!'); window.location.href='tabela.php';</script>";
} else {
    echo "Erro ao atualizar registro: " . $conn->error;
}

// Fechar a conexão
$conn->close();
?>

