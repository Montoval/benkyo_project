<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redireciona para a página de login se não estiver logado
    exit();
}

$user_id = $_SESSION['user_id'];

$pdo = new PDO("mysql:host=localhost;dbname=benkyo_project", "root", "vertrigo");

// Verifique a conexão
if (!$pdo) {
    die("Connection failed: " . $pdo->errorInfo());
}

// Prepare e execute a consulta para buscar eventos do usuário
$query = "SELECT * FROM evento WHERE idUsuario = ? ORDER BY dataEvento DESC";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Todos os Eventos</title>
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
    <h1>Todos os Eventos</h1>
    <a href="../calendario.php">Voltar ao Calendário</a>
    <table>
        <tr>
            <th>Data</th>
            <th>Local</th>
            <th>Hora</th>
        </tr>
        <?php 
        foreach ($events as $event) {
            $data = htmlspecialchars($event['dataEvento']);
            $local = htmlspecialchars($event['localEvento']);
            $hora = htmlspecialchars($event['horaEvento']);

            echo "<tr>
                    <td>$data</td>
                    <td>$local</td>
                    <td>$hora</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
