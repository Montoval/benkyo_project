<?php
$mysqli = new PDO("mysql:host=localhost;dbname=benkyo_project", "root", "vertrigo");

// Verifica conexão
if (!$mysqli) {
    die("Connection failed: " . $mysqli->errorInfo());
}

$query = "SELECT * FROM events ORDER BY event_date DESC";
$result = $mysqli->query($query);
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
    <a href="index.php">Voltar ao Calendário</a>
    <table>
        <tr>
            <th>Data</th>
            <th>Título</th>
            <th>Descrição</th>
        </tr>
        <?php 
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data = htmlspecialchars($row['event_date']);
            $local = htmlspecialchars($row['event_local']);
            $hora = htmlspecialchars($row['event_hora']);

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
