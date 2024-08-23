<?php
include "db.php";

$query = "SELECT * FROM Atividade";
$stmt = $pdo->query($query);
$atividades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Atividades</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Gerenciar Atividades</h1>
    <a href="create.php">Adicionar Atividade</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($atividades as $atividade): ?>
        <tr>
            <td><?= htmlspecialchars($atividade['idAtividade']) ?></td>
            <td><?= htmlspecialchars($atividade['descricaoAtividade']) ?></td>
            <td><?= htmlspecialchars($atividade['tipoAtividade']) ?></td>
            <td>
                <a href="editavel.php?id=<?= $atividade['idAtividade'] ?>">Editar</a>
                <a href="atividade/delete.php?id=<?= $atividade['idAtividade'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>