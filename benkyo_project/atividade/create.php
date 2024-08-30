<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $idUsuario = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $descricaoAtividade = $_POST['descricaoAtividade'];
        $tipoAtividade = $_POST['tipoAtividade'];

        $query = "INSERT INTO Atividade (idUsuario, descricaoAtividade, tipoAtividade) VALUES (:idUsuario, :descricaoAtividade, :tipoAtividade)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->bindParam(':descricaoAtividade', $descricaoAtividade);
        $stmt->bindParam(':tipoAtividade', $tipoAtividade);
        $stmt->execute();

        header("Location: atividades.php");
        exit();
    }
} else {
    // Redirecionar para a página de login se o usuário não estiver logado
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Atividade</title>
    <style>
        .box-atividades{   
            height:fit-content;
            width:fit-content;
            background-color: rgba(0, 0, 0, 0.4);
        }
    </style>
</head>
<body>
    <div class="box-atividades">
        <h1>Adicionar Atividade</h1>
        <form method="post">
            <label for="descricaoAtividade">Descrição:</label>
            <input type="text" id="descricaoAtividade" name="descricaoAtividade" required><br>
            <label for="tipoAtividade">Tipo:</label>
            <select id="tipoAtividade" name="tipoAtividade" required>
                <option value="Comemorativa">Comemorativa</option>
                <option value="Esportes">Esportes</option>
                <option value="Estudos">Estudos</option>
                <option value="Outros">Outros</option>
            </select>
            <button type="submit">Adicionar</button>
        </form>
        <a href="atividades.php">Voltar</a>
    </div>
</body>
</html>
