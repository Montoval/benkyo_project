<!DOCTYPE html>
<html lang='pt-br'>
	<head>
		<meta charset='UTF-8'>
		<title>Benkyo</title>
		<link rel="stylesheet" href="pesquisa.css">
		<link rel="icon" type="image/x-icon" href="imagens/Benkyoicon2.jpg">
		<style>
			
		</style>
	</head>
	<body>
		<div class="box-center">
			<div class="box">
			<div id="link">
			<a href='index.php'>Inicial</a> 
			|
			<a href='pesquisa.php'>Pesquisa</a>
			</div>
			<br>
		<h2 align="center">Pesquisa de Usuários</h2>
		<div class="pesquisa">
			<form method="post" action="pesquisa.php">
				<label align="center">Nome parcial:</label>
				<input type="text" name="nome" />
				<button type="submit">Pesquisar</button>
			</form>
		</div>
		<h2 align="center">Listagem de Usuários</h2>
		<table border>
			<tr>
				<th>Nome</th>
				<th>Email</th>
				<th>Ações</th>
			</tr>
		<?php
			$nome = '';
			if (isset($_POST['nome'])){
				$nome = $_POST['nome'];
			}
		
			/* Conectando com o banco de dados para listar registros */
			$datasource = 'mysql:host=localhost;dbname=benkyo_project';
			$user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);
	
			$query = "SELECT * FROM usuario WHERE nome LIKE '%$nome%'";
			$stm = $db -> prepare($query);
			
			if ($stm -> execute()) {
				$result = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$id = $row['id'];
					$nome = $row['nome'];
					$email = $row['email'];
						
					print "<tr>
					<td>$nome</td>
					<td>$email</td>
					<td><a href='delete.php?id=$id'>Excluir</a> | 	
					<a href='edita.php?id=$id'>Editar</a></td>
					</tr>";					
				}				
			} else {
				print '<p>Erro ao listar usuários!</p>';
			}
		?>
		</table>
		</div>
		</div>
	</body>
</html>