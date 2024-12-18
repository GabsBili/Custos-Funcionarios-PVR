<?php
    //Faz a liguação com o banco mysql
    require("conection.php");

    //fazendo teste de verificação
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['funcio'];
    $gastos = $_POST['gasto'];
    $errors = [];

    // Verificar se os campos estão vazios
    if (empty($nome)) {
        header("Location: index.html");
        exit();
        $errors[] = alert( "O campo nome não pode estar vazio.");
    }

    if (empty($gastos)) {
        header("Location: index.html");
        exit();
        $errors[] = "O campo gastos não pode estar vazio.";
    }

} if (empty($errors)) {
    //salva os dados obtidos pelo formulario
    if(isset($_POST)){

        $nome = $_POST['funcio'];
        $gastos = $_POST['gasto'];
        $data_atual = date("d-m-Y H:i:s"); // Formato YYYY-MM-DD HH:MM:SS
        

        $query = "INSERT INTO gastos (Nome_Func, 
       Gastos_Func, Data_Gasto) VALUES ('$nome','$gastos','$data_atual')";

        
        //execução
        $stmt = $pdo->prepare($query);
        $stmt -> execute();
       
        
     //vai ou volta para outra pagina
        header("Location: index.html");
    exit();
}
}
?>