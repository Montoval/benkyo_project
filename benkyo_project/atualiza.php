<?php

    #Recebendo os dados
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    # Conecta com BD
    $ds = "mysql:host=127.0.0.1;dbname=benkyo_project";
    $con = new PDO($ds, 'root', 'vertrigo');
    
    #SQL para update
    $sql= "UPDATE usuario SET nome=?, email=?, telefone=? WHERE id=?";
    $stm = $con->prepare($sql);
    $stm -> bindParam(1, $nome);
    $stm -> bindParam(2, $email);
    $stm -> bindParam(3, $telefone);
    $stm -> bindParam(4, $id);
    
    #Executa SQL
    if($stm->execute()){
        header('location:index.php');
    }
    else{
        print"<p>Erro ao atualizar</p>";
    }

?>
