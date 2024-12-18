<?php
// Inicia a sessão.
session_start();

// Pegando os dados de login enviados.
$nome = $_POST['username'];
$senha = $_POST['usersenha'];

// Conectando com o banco de dados
$datasource = 'mysql:host=localhost;dbname=benkyo_project';
$user = 'root';
$pass = 'vertrigo';
$db = new PDO($datasource, $user, $pass);

// Consulta SQL para verificar o usuário
$query = "SELECT id, nome, senha FROM usuario WHERE nome = ?";
$stm = $db->prepare($query);
$stm->bindParam(1, $nome);
$stm->execute();

// Verifica se um usuário foi encontrado
$resultado = $stm->fetch(PDO::FETCH_ASSOC);

if ($resultado && password_verify($senha, $resultado['senha'])) {
    // Login efetuado com sucesso.

    // Armazenando o ID e o nome do usuário na sessão
    $_SESSION['user_id'] = $resultado['id'];  // ID do usuário
    $_SESSION['user_name'] = $resultado['nome'];  // Nome do usuário

    // Redirecionando para a página inicial.
    header("location:principal.html");
    exit();  // Garantir que o script pare após o redirecionamento
} else {
    // Caso usuário ou senha estejam incorretos.
    echo "<script language='javascript'>
    alert('Usuário ou Senha incorretos!');
    window.location.href = 'index.php';  // Redireciona para a página index após o OK
    </script>";
   
    echo "<a href='index.php'>Voltar</a>";
}
?>
