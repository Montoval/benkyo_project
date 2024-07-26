<?php
    # Recebe dados do FORM
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = MD5($_POST['senha']);

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=benkyo_project";
    $con = new PDO($ds, 'root', 'vertrigo');
   /* $query_select = "SELECT email FROM usuario WHERE email = "$email"";*/
    $select = mysql_query($query_select,$con);
    $array = mysql_fetch_array($select);
    $logarray = $array["email"];
    
      if($email == "" || $email == null){
       echo "<script>
        alert('O campo email deve ser preenchido');
        window.location.href='index.php';
        </script>";
    
        }else{
          if($logarray == $email){
    
            echo "<script>
            alert('Esse email já existe');window.location.href='
            index.php';</script>";
            die();
    
          }
    # Insere no BD
    $sql = "INSERT INTO usuario (nome, email, senha)
                VALUES(?,?,?)";
    $stm = $con->prepare($sql);
    $stm->execute(array($nome, $email, $senha));

    # Verificar inserção
    if($stm){
        header("location:index.php");
    }
    else {
        print "<p>Erro ao inserir</p>";
    }
?>