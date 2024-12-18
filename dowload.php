<?php
//conexao
if (isset($_POST['export'])) {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'dbpadaria';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    //busca
    $sql = "SELECT * FROM gastos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="dados.xls"');

        // Escrever os cabeçalhos
        $cabecalhos = $result->fetch_fields();
        foreach ($cabecalhos as $cabecalho) {
            echo $cabecalho->name . "\t";
        }
        echo "\n";

        // Escrever os dados
        while ($row = $result->fetch_assoc()) {
            echo implode("\t", $row) . "\n";
        }
    } else {
        echo "0 resultados";
    }

    $conn->close();
    exit();
}
