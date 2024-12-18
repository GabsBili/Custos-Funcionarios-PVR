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

// Receber o ID do registro
$id = $_GET['id'];

// Consultar dados do registro
$sql = "SELECT * FROM gastos WHERE ID = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <style>
        body{
            margin: 0px;
            text-align: center;
            background-image: url(logo.avif) ;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed; 
        }
        .container{
            width: 100vw;
            height: 80vh;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
 }
        .box{
        width: 350px;
        height: 350px;
        background-image:url(div.webp);
        background-size: 350px;
 }

 label{
   color: black;
   text-align: center;
   width: 300px;
   font-size: 20px;
 }

 button{
    font-size: 17px;
    font-family: Georgia, 'Times New Roman', Times, serif;
 }

 input{
    display: inline-block;
    font-size: 17px;
    font-family: 'Courier New', Courier, monospace;
 }
    </style>
</head>
<body>
    <div class="container">
    <div class="box">
    <h1>Editar Registro</h1>
    <form action="atualizar.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
        <label for="nome"> Nome:</label>
        <input type="text" name="nome" value="<?php echo $row['Nome_Func']; ?>" required><br><br>

        <label for="gasto">Gasto:</label>
        <input type="text" name="gasto" value="<?php echo $row['Gastos_Func']; ?>" required><br><br>

        <label for="data">Data:</label>
        <input type="text" name="data" value="<?php echo $row['Data_Gasto']; ?>" required><br><br>
        <input type="submit" value="Atualizar">
    </form>
    </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
