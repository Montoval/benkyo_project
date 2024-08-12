<?php
// Inicia a sess�o.
session_start();

// Pegando os dados de login enviados.
$nome = $_POST['username'];
$senha = $_POST['usersenha'];

/* Conectando com o banco de dados para cadastrar registros */
$datasource = 'mysql:host=localhost;dbname=benkyo_project';
$user = 'root';
$pass = 'vertrigo';
$db = new PDO($datasource, $user, $pass);
	
$query = "SELECT * FROM usuario WHERE nome=? AND senha=?";
$stm = $db->prepare($query);
$stm->bindParam(1, $nome);
$stm->bindParam(2, $senha);
$stm->execute();

if ($stm -> fetch()) {
	// Login efetuado com sucesso.

	// Armazenando usu�rio na sess�o.
	$_SESSION['user'] = $nome;
	
	// Redirecionando para a p�gina inicial.
	header("location:principal.html");
} else {
	// Caso usu�rio ou senha estejam incorretos.
	print "<p>Usuário e/ou Senha Inválidos!</p>";
	print "<a href='index.php'>Voltar</a>";
}
?>
