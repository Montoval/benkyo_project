<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Benkyo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box-center">
    <div class="up-box">
    <a href='index.php'>Inicial</a> 
		|
		<a href='pesquisa.php'>Pesquisa</a>
		<br>
<h3 align="center">Cadastro de Usuário</h3>
<form method='POST' action='inserir.php'>
    <label>Nome: </label>
    <input name='nome' placeholder="Seu Nome"><br>
    <label>E-mail: </label>
    <input name='email'placeholder="Seu E-mail"><br>
    <label>Telefone: </label>
    <input name='telefone'placeholder="Seu Telefone"><br>
    <button type='submit' >Salvar</button>
</form>
</div>
<div class="box2">
<h3 align="center">Listagem de Usuário</h3>
<table border>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>Ações</th>
    </tr>
</div>
</div>
<?php
    # Conecta com BD
    $ds = "mysql:host=127.0.0.1;dbname=benkyo_project";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Seleciona todos os registros
    $sql = "SELECT * FROM usuario ORDER BY id DESC LIMIT 3";
    $stm = $con->prepare($sql);
    $stm->execute();
    // $sql = "SELECT * FROM id"
    // ORDER BY CustomerName DESC
    // LIMIT 3;
    # Percorre os registros
    foreach($stm as $row){
        $id = $row['id'];
        echo "<tr>";
        echo "<td>" . $id . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telefone'] . "</td>";
        echo "<td>
                <a href='delete.php?id=$id'>Deletar</a>
                |
                <a href='edita.php?id=$id'>Editar</a>
             </td>"; 
        echo "</tr>";
    }
?>
</table>
</body>
</html>