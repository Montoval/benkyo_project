<?php
session_start();
include "db.php";

// Obter o ID do usuário logado da sessão
$user_id = $_SESSION['user_id'];

// Modificar a consulta para filtrar atividades pelo usuário logado
$query = "SELECT * FROM Atividade WHERE idUsuario = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
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
        color: white;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        color: black;
    }

    .box-atividade {
        color: white;
        border: 1px solid white;
        height: 450px;
        width: 100%;
        /* background-color: rgba(43, 43, 43, 0.725); */
        box-shadow: 2px 2px 8px black;
        border-radius: 10px;
        margin-bottom: 10px;
    }
    </style>
</head>

<body>
    <h1>Gerenciar Atividades</h1>

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
                <a href="atividade/delete.php?id=<?= $atividade['idAtividade'] ?>"
                    onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>