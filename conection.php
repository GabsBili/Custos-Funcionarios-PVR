<!-- Conecção --> 

<?php
    //informações do banco, estou usando o local
     $usuario = 'root';
     $senha = '';
     //esse é o nome do banco salvo no mysql
     $dbname ='dbpadaria';
     $host ='localhost';

   //aqui ele faz a confirmação dos dados 
     try {
        $pdo = new PDO("mysql: host=$host; 
        dbname=$dbname", $usuario, $senha);
    
     } catch (PDOException $e){
        echo $e->getMessage();
        
     } 

?>
