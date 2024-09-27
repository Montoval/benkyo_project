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

// Consulta SQL para verificar o usuário e senha
$query = "SELECT id, nome FROM usuario WHERE nome = ? AND senha = ?";
$stm = $db->prepare($query);
$stm->bindParam(1, $nome);
$stm->bindParam(2, $senha);
$stm->execute();

// Verifica se um usuário foi encontrado
$resultado = $stm->fetch(PDO::FETCH_ASSOC);
if ($resultado) {
    // Login efetuado com sucesso.

    // Armazenando o ID e o nome do usuário na sessão
    $_SESSION['user_id'] = $resultado['id'];  // ID do usuário
    $_SESSION['user_name'] = $resultado['nome'];  // Nome do usuário

    // Redirecionando para a página inicial.
    header("location:principal.html");
    exit();  // Garantir que o script pare após o redirecionamento
} else {
    // Caso usuário ou senha estejam incorretos.
    echo "<p>Usuário e/ou Senha Inválidos!</p>";
    echo "<a href='index.php'>Voltar</a>";
}

?>
