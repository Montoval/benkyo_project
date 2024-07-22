<?php

    # Recebe o ID
    $id = $_GET['id'];

    # Conecta com BD
    $ds = "mysql:host=10.150.0.24;dbname=benkyo_project";
    $con = new PDO($ds, 'root', 'vertrigo');

    # SQL remoção
    $sql = "DELETE FROM usuario WHERE id=?";
    $stm = $con->prepare($sql);
    $stm->execute(array($id));

    if($stm){
        header("location:index.php");
    }
    else {
        print "<p>Erro ao remover</p>";
    }
?>