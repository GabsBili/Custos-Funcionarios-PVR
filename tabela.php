<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpadaria";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Inicializar variáveis para filtro
$filtro_nome = '';

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nome"])) {
        $filtro_nome = $conn->real_escape_string($_POST["nome"]);
    }
}

// Criar a consulta SQL com base no filtro
$sql = "SELECT * FROM gastos";
if ($filtro_nome) {
    $sql .= " WHERE Nome_Func LIKE '%$filtro_nome%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tabela - Padaria</title>
    <style>
        @media (max-width:1120px){
  
}
body{
    background-image: url(logo.avif) ;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
    text-align: center;
}
        table {
            border-collapse: collapse;
            width: 100%;
            color: white;
        }
        th, td {
            border: 1px solid white;
            padding: 8px;
            text-align: left;
            background-color: #363636;
        }

        .formulario{
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        font-size: 24px;
        text-align: center;
 }

    .titulo{
        color: rgb(245, 245, 245);
        text-shadow: black 2px 2px 2px;
        background-color: black;
        text-align: center;
        margin-left: 600px;
        padding: 5px;
        border-style: solid;
        border-radius: 50%;
        width: 300px;
 }

 .voltar{
        color: rgb(245, 245, 245);
        text-shadow: black 2px 2px 2px;
        background-color: black;
        text-align: center;
        padding: 5px;
        border-style: solid;
        border-radius: 50%;
        width: 300px;
 }
 .table{
        color: rgb(245, 245, 245);
        text-shadow: black 2px 2px 2px;
        background-color: black;
        text-align: center;
        padding: 5px;
        border-style: solid;
        border-radius: 50%;
        width: 300px;
        margin-left: 600px;
 }
 button{
    font-size: 17px;
    font-family: Georgia, 'Times New Roman', Times, serif;
 }
 a{
   text-decoration: none;
   color:white;
 }
    </style>
    <!--Usando Jquery-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(function(){
            $(".baixar").click(function(){
                alert("Dowload iniciado");
            });
        });
    
    </script>
</head>
<body>



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <div class="table"> Nome:</div> <input class="formulario" type="text" name="nome" value="<?php echo htmlspecialchars($filtro_nome); ?>" onblur="letra(event)"><button type="submit" class="fas fa-search" value="Filtrar"></button> 
</form>

    <!--Tabela -->
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Gastos</th>
        <th>Data</th>
    </tr>
    <?php
    //tabela conctada com o banco
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["ID"]) .  "</td>" ;
            echo "<td>" . htmlspecialchars($row["Nome_Func"]) .  "</td>" ;
            echo "<td>" . htmlspecialchars($row["Gastos_Func"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["Data_Gasto"]) . "</td>";
            echo "<td><button onclick=\"excluirLinha(this,'" . $row['ID'] . "')\"><i class='fas fa-trash-alt'></i></button></td>";
            echo "<td> <a href='editar.php?id={$row['ID']}'><i class='fas fa-pencil-alt'</i></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Nenhum resultado encontrado</td></tr>";
    }
    ?>
</table>

<p class="titulo">Baixar Tabela </p><br>
 <form method="post" action="dowload.php">
        <button class="baixar" type="submit" name="export">Baixar Excel</button>
    </form>

   <form class="formulario" action="dowloadpdf.php" method="POST">
    <button id="submit"  class="baixar" type="submit" class="fas fa-download">Baixar PDF</button>
</form>
    
    
    <a href="index.html"><p class="voltar"> Voltar </p<br></a>
    
        
    
<?php
// Fechar a conexão
$conn->close();
?>
</body>
<script >
    //forma de exlusão usando JS
 function excluirLinha(button, ID) {
    console.log("Tentando excluir: " + ID); // Adicione log para depuração
            if (confirm("Tem certeza de que deseja excluir esta linha?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "excluir_linha.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log(xhr.responseText); // Adicione log para depuração
                        if (xhr.responseText === "Linha excluída com sucesso!") {
                            // Remover a linha da tabela HTML
                            var row = button.closest("tr");
                            row.parentNode.removeChild(row);
                        } else {
                            alert("Erro ao excluir a linha: " + xhr.responseText);
                        }
                    }
                };
                xhr.send("ID=" + encodeURIComponent(ID));
            }
        }
</script>
</html>