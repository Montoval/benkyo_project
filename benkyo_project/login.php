<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Benkyo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="imagens/Benkyoicon2.jpg">
</head>
<body>
    <div class="box-center">
    <div class="up-box">
    
<h3 align="center">Login de Usuário</h3>
<form method='POST' action='inserir.php'>
    <label>Nome: </label>
    <input name='username' placeholder="Seu Username"><br>
    <label>Senha: </label>
    <input name='usersenha' type="password" id="senha" placeholder="Sua Senha"><br>
    <button type='submit' >Logar</button>
    <a href='index.php'>Não tem login? Cadastre-se.</a>
</form>
</div>
</div>
<?php
    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=benkyo_project";
    $con = new PDO($ds, 'root', 'vertrigo');

    
?>
</table>
</body>
</html>