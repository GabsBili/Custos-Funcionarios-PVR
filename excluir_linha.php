<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID'])) {
    // Configurações do banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbpadaria";

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Obter o nome da linha a ser excluída
    $ID = $conn->real_escape_string($_POST['ID']);

     // Adicionar log para depuração
     error_log("Tentando excluir ID: $ID");

    // Excluir a linha do banco de dados
    $sql = "DELETE FROM gastos WHERE ID='$ID'";

    if ($conn->query($sql) === TRUE) {
        echo "Linha excluída com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
          // Adicionar log para depuração
          error_log("Erro ao excluir: " . $conn->error);
    }

    // Fechar conexão
    $conn->close();
}
else {
    error_log("Requisição POST não recebida ou ID não definido.");
}
?>
