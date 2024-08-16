<?php
include 'db.php';

$idAtividade = $_GET['id'];

$query = "SELECT * FROM Atividade WHERE idAtividade = :idAtividade";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':idAtividade', $idAtividade);
$stmt->execute();
$atividade = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricaoAtividade = $_POST['descricaoAtividade'];
    $tipoAtividade = $_POST['tipoAtividade'];

    $query = "UPDATE Atividade SET descricaoAtividade = :descricaoAtividade, tipoAtividade = :tipoAtividade WHERE idAtividade = :idAtividade";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':descricaoAtividade', $descricaoAtividade);
    $stmt->bindParam(':tipoAtividade', $tipoAtividade);
    $stmt->bindParam(':idAtividade', $idAtividade);
    $stmt->execute();

    header("Location: atividades.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Atividade</title>
</head>
<body>
    <h1>Editar Atividade</h1>
    <form method="post">
        <label for="descricaoAtividade">Descrição:</label>
        <input type="text" id="descricaoAtividade" name="descricaoAtividade" value="<?= htmlspecialchars($atividade['descricaoAtividade']) ?>" required>
        <label for="tipoAtividade">Tipo:</label>
        <select id="tipoAtividade" name="tipoAtividade" required>
            <option value="Comemorativa" <?= $atividade['tipoAtividade'] == 'Comemorativa' ? 'selected' : '' ?>>Comemorativa</option>
            <option value="Esportes" <?= $atividade['tipoAtividade'] == 'Esportes' ? 'selected' : '' ?>>Esportes</option>
            <option value="Estudos" <?= $atividade['tipoAtividade'] == 'Estudos' ? 'selected' : '' ?>>Estudos</option>
            <option value="Outros" <?= $atividade['tipoAtividade'] == 'Outros' ? 'selected' : '' ?>>Outros</option>
        </select>
        <button type="submit">Salvar</button>
    </form>
    <a href="atividades.php">Voltar</a>
</body>
</html>
