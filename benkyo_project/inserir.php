<?php
    // Recebe dados do FORM
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        // Conecta com BD
        $ds = "mysql:host=localhost;dbname=benkyo_project";
        $con = new PDO($ds, 'root', 'vertrigo');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se o email já existe
        $query_select = "SELECT email FROM usuario WHERE email = :email";
        $stm = $con->prepare($query_select);
        $stm->bindParam(':email', $email);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);

        if ($email == "" || $email == null) {
            echo "<script>
                alert('O campo email deve ser preenchido');
                window.location.href='index.php';
                </script>";
        } else {
            if ($result) {
                echo "<script>
                alert('Esse email já existe');
                window.location.href='index.php';
                </script>";
                die();
            } 
        }
         // Verifica se o usuario já existe
         $query_select = "SELECT nome FROM usuario WHERE nome = :nome";
         $stm = $con->prepare($query_select);
         $stm->bindParam(':nome', $nome);
         $stm->execute();
         $result = $stm->fetch(PDO::FETCH_ASSOC);
 
         if ($nome == "" || $nome == null) {
             echo "<script>
                 alert('O campo nome deve ser preenchido');
                 window.location.href='index.php';
                 </script>";
         } else {
           
             if ($result) {
                 echo "<script>
                 alert('Esse nome já existe');
                 window.location.href='index.php';
                 </script>";
                 die();
             }
            }
                // Insere no BD
                $sql = "INSERT INTO usuario (nome, email, senha) VALUES(?, ?, ?)";
                $stm = $con->prepare($sql);
                $stm->execute(array($nome, $email, $senha));

                // Verificar inserção
                if ($stm) {
                    header("Location: index.php");
                } else {
                    echo "<p>Erro ao inserir</p>";                }
            }
    catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
?>
