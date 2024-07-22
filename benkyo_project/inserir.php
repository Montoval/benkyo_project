<?php
    # Recebe dados do FORM
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    # Conecta com BD
    $ds = "mysql:host=10.150.0.24;dbname=benkyo_project";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Insere no BD
    $sql = "INSERT INTO usuario (nome, email, telefone)
                VALUES(?,?,?)";
    $stm = $con->prepare($sql);
    $stm->execute(array($nome, $email, $telefone));

    # Verificar inserção
    if($stm){
        header("location:index.php");
    }
    else {
        print "<p>Erro ao inserir</p>";
    }
?>