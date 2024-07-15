<?php
    #Recebe o id pela URL
    $id = $_GET['id'];

    #Conecta com BD
    $ds = "mysql:host=localhost;dbname=benkyo_project";
    $con = new PDO($ds, 'root', 'vertrigo');

    #Buscar dados do registro
    $sql = "SELECT * from usuario WHERE id=?";
    $stm = $con->prepare($sql);
    $stm ->bindParam(1,$id);

    #Executa o SQL
    $stm->execute();

    #Pega o resultado
    $result = $stm->fetch();
    $nome = $result['nome'];
    $email = $result['email'];
    $telefone = $result['telefone'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <title>Benkyo</title>
    <link rel="stylesheet" href="edita.css">
</head>
<body>
    <div class="box-center">
        <div class="box">
            <h3  align="center">Editar Usuário</h3>
            <div class="editar">
                <form method='post' action='atualiza.php'>
                    <input type='hidden' name='id' value='<?php print $id?>'>
                <label>Nome:</label>
                <input name='nome' value='<?php print $nome ?>'><br>
                <label>Email:</label>
                <input name='email' value='<?php print $email ?>'><br>
                <label>Telefone:</label>
                <input name='telefone' value='<?php print $telefone ?>'><br>
                <button tyoe='submint'>Atualizar</button>
            </div>    
        </div>
    </div>
</form>
</body>
</html>