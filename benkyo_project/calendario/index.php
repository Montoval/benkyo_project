<?php
session_start();
$mysqli = new PDO("mysql:host=localhost;dbname=benkyo_project", "root", "vertrigo");

// Verifica a conexão
if (!$mysqli) {
    die("Connection failed: " . $mysqli->errorInfo());
}

// Função para obter eventos
function getEvents($mysqli, $month, $year, $user_id) {
    $start_date = "$year-$month-01";
    $end_date = date("Y-m-t", strtotime($start_date));
    $query = "SELECT * FROM evento WHERE dataEvento BETWEEN '$start_date' AND '$end_date' AND idUsuario = ?";
    
    $stm = $mysqli->prepare($query);
    $stm->bindParam(1, $user_id);
    $stm->execute();
    
    $events = [];
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
        $events[$row['dataEvento']][] = $row;
    }
    return $events;
}

// Define o mês e o ano atuais se não estiverem definidos na URL
$month = isset($_GET['month']) && is_numeric($_GET['month']) && $_GET['month'] >= 1 && $_GET['month'] <= 12 ? $_GET['month'] : date('m');
$year = isset($_GET['year']) && is_numeric($_GET['year']) ? $_GET['year'] : date('Y');
$user_id = $_SESSION['user_id'];  // Obtenha o ID do usuário da sessão

$events = getEvents($mysqli, $month, $year, $user_id);

// Array com os nomes dos meses em português
$months = [
    '01' => 'Janeiro',
    '02' => 'Fevereiro',
    '03' => 'Março',
    '04' => 'Abril',
    '05' => 'Maio',
    '06' => 'Junho',
    '07' => 'Julho',
    '08' => 'Agosto',
    '09' => 'Setembro',
    '10' => 'Outubro',
    '11' => 'Novembro',
    '12' => 'Dezembro',
];

// Certifique-se de que o mês seja uma string com dois dígitos
$month = str_pad($month, 2, '0', STR_PAD_LEFT);

// Definir o nome do mês em português
$monthName = isset($months[$month]) ? $months[$month] : "Mês Inválido";
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

        .calendar td:hover {
            background-color: darkgray;
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
            padding: 5px;
            border: 3px solid rgba(255,255,255,0.6);
            border-radius: 15px;
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
            height: fit-content;
            backdrop-filter: blur(6px);

            /* background-color: #AC99F2; */
            align-items: center;
            width: 80%;
        }

        label {
            display: block;
            float: left;
            width: 70px;
        }

        .input-eventos {
            padding: 5px;
            border-radius: 7px;
            width: 80%;
            height: 25px;
        }

        input {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .butao:hover {
            background-color: rgba(0,0,0,0.5);
            color: white;
        }

        h2 {
            color: #fff;
            text-align: center;
        }

        .butao {
            padding: 5px;
            width: fit-content;
            height: 25px;
            background-color: white;
            color: black;
            border: 2px solid black;
            border-radius: 10px;
            transition-duration: 0.4s;
        }

        #box-butao {
            padding: 5px;
            height: fit-content;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
        a{
            background-color: lightblue;
          color:black;
        }
        #prox{
            float:right;
        }
    </style>
</head>
<body>
    <h1>Calendário de Eventos</h1>
    <h2><?= $monthName ?> de <?= $year ?></h2> <!-- Exibe o mês e o ano atuais em português -->
    <a href="?month=<?= $month == 1 ? 12 : $month - 1 ?>&year=<?= $month == 1 ? $year - 1 : $year ?>">Anterior</a>
    <a id="prox" href="?month=<?= $month == 12 ? 1 : $month + 1 ?>&year=<?= $month == 12 ? $year + 1 : $year ?>">Próximo</a>
    
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
        <h2>Adicionar Evento</h2><br>
        <form action="calendario/add_event.php" method="post">
            <label class="box-label" for="event_date">Data:</label>
            <input type="date" id="event_date" class="input-eventos" name="event_date" required> <br><br>
            <label class="box-label" for="event_local">Local:</label>
            <input type="text" id="event_local" class="input-eventos" name="event_local" required><br><br>
            <label class="box-label" for="event_hora">Hora:</label>
            <input type="time" id="event_hora" class="input-eventos" name="event_hora" required><br><br>
            <label for="idAtividade">Atividade:</label>
            <select id="idAtividade" name="idAtividade" required>
                <?php
                // Filtrar atividades apenas do usuário logado
                $atividade_query = "SELECT * FROM atividade WHERE idUsuario = ?";
                $stm = $mysqli->prepare($atividade_query);
                $stm->bindParam(1, $user_id);
                $stm->execute();
                while ($atividade = $stm->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$atividade['idAtividade']}'>{$atividade['descricaoAtividade']}</option>";
                }
                ?>
            </select><br>
            <div id="box-butao">
                <button class="butao" type="submit">Adicionar Evento</button>
                <button class="butao" onclick="window.location.href='calendario/all_events.php'">Ver Todos os Eventos</button>
                </div>
        </form>
    </div>
</body>
</html>
