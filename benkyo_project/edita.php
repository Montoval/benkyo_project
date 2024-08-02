<?php
    // Recebe o id pela URL
    $id = $_GET['id'];

    // Conecta com BD
    $ds = "mysql:host=localhost;dbname=benkyo_project";
    $con = new PDO($ds, 'root', 'vertrigo');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buscar dados do registro
    $sql = "SELECT * FROM usuario WHERE id=?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $id);

    // Executa o SQL
    $stm->execute();

    // Pega o resultado
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    $nome = $result['nome'];
    $email = $result['email'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Benkyo</title>
    <link rel="stylesheet" href="edita.css">
    <link rel="icon" type="image/x-icon" href="imagens/Benkyoicon2.jpg">
</head>
<body>
    <div class="box-center">
        <div class="box">
            <h3 align="center">Editar Usuário</h3>
            <div class="editar">
                <form method="post" action="atualiza.php">
                    <input type="hidden" name="id" value="<?php print $id ?>">
                    <label>Nome:</label>
                    <input name="nome" value="<?php print $nome ?>"><br>
                    <label>Email:</label>
                    <input name="email" value="<?php print $email ?>"><br>
                    <label>Senha Atual:</label>
                    <input type="password" name="senha_atual" required><br>
                    <label>Nova Senha:</label>
                    <input type="password"placeholder="Deixe em branco para não alterar"name="nova_senha"><br>
                    <button type="submit">Atualizar</button>
                </form>
            </div>    
        </div>
    </div>
</body>
</html>
