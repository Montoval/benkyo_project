<?php
session_start();
$mysqli = new PDO("mysql:host=localhost;dbname=benkyo_project", "root", "vertrigo");

// Verifica a conexão
if (!$mysqli) {
    die("Connection failed: " . $mysqli->errorInfo());
}

// Função para obter eventos
function getEvents($mysqli, $month, $year) {
    $start_date = "$year-$month-01";
    $end_date = date("Y-m-t", strtotime($start_date));
    $query = "SELECT * FROM evento WHERE dataEvento BETWEEN '$start_date' AND '$end_date'";
    $result = $mysqli->query($query);
    $events = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $events[$row['dataEvento']][] = $row;
    }
    return $events;
}

$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$events = getEvents($mysqli, $month, $year);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Calendário de Eventos</title>
    <style>
        /* Estilos para o calendário */
        .calendar {
            display: table;
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255,255,255,0.8);
        }
        .calendar th, .calendar td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            vertical-align: top;
            position: relative;
        }
        .calendar th {
            background-color: #f2f2f2;
        }
        .event {
            background-color: #e6ffe6;
            cursor: pointer;
            margin-top: 5px;
            position: relative;
        }
        .event-details {
            display: none;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            z-index: 1000;
            width: 200px;
            top: 100%;
            left: 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        .event:hover .event-details {
            display: block;
        }
        .box-eventos {
            border-radius: 15px;
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
            height: fit-content;
            background-color: rgba(0,0,0,0.5);
            align-items: center;
            width: 80%;
        }
        .input-eventos {
            border-radius: 10px;
            width: 90%;
        }

        .butao{
            background-color: white;
            color: black;
            border: 2px solid #04AA6D;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <h1>Calendário de Eventos</h1>
    <a href="?month=<?= $month == 1 ? 12 : $month - 1 ?>&year=<?= $month == 1 ? $year - 1 : $year ?>">Anterior</a>
    <a href="?month=<?= $month == 12 ? 1 : $month + 1 ?>&year=<?= $month == 12 ? $year + 1 : $year ?>">Próximo</a>
    <table class="calendar">
        <tr>
            <th>Dom</th><th>Seg</th><th>Ter</th><th>Qua</th><th>Qui</th><th>Sex</th><th>Sáb</th>
        </tr>
        <?php
     
        
      
        
        $first_day = date('w', strtotime("$year-$month-01"));
        $days_in_month = date('t', strtotime("$year-$month-01"));
        $day_counter = 1;

        for ($week = 0; $week < 6; $week++) {
            echo '<tr>';
            for ($day = 0; $day < 7; $day++) {
                if ($week == 0 && $day < $first_day) {
                    echo '<td></td>';
                } elseif ($day_counter > $days_in_month) {
                    echo '<td></td>';
                } else {
                    $date = "$year-$month-" . str_pad($day_counter, 2, '0', STR_PAD_LEFT);
                    echo "<td>";
                    echo $day_counter;
                    if (isset($events[$date])) {
                        foreach ($events[$date] as $event) {
                            echo "<div class='event'>{$event['localEvento']}
                                    <div class='event-details'>{$event['horaEvento']}</div>
                                  </div>";
                        }
                    }
                    echo "</td>";
                    $day_counter++;
                }
            }
            echo '</tr>';
            if ($day_counter > $days_in_month) {
                break;
            }
        }
        ?>
    </table>
    <div class="box-eventos">
        <h2>Adicionar Evento</h2>
        <form action="calendario/add_event.php" method="post">
    <label for="event_date">Data:</label>
    <input type="date" id="event_date" class="input-eventos" name="event_date" required> <br>
    <label for="event_local">Local:</label>
    <input type="text" id="event_local" class="input-eventos" name="event_local" required><br>
    <label for="event_hora">Hora:</label>
    <input type="time" id="event_hora" class="input-eventos" name="event_hora" required><br>
    <label for="idAtividade">Atividade:</label>
    <select id="idAtividade" name="idAtividade" required>
        <?php
        $atividade_query = "SELECT * FROM atividade";
        $atividade_result = $mysqli->query($atividade_query);
        while ($atividade = $atividade_result->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$atividade['idAtividade']}'>{$atividade['descricaoAtividade']}</option>";
        }
        ?>
    </select><br>
    <button class="butao" type="submit">Adicionar Evento</button>
</form>

        <button class="butao" onclick="window.location.href='calendario/all_events.php'">Ver Todos os Eventos</button>
    </div>
</body>
</html>
