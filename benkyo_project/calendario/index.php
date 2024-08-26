<?php
$mysqli = new PDO("mysql:host=localhost;dbname=benkyo_project", "root", "vertrigo");

// Verifica conexão
/*if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}*/

function getEvents($mysqli, $month, $year) {
    $start_date = "$year-$month-01";
    $end_date = date("Y-m-t", strtotime($start_date));
    $query = "SELECT * FROM events WHERE event_date BETWEEN '$start_date' AND '$end_date'";
    $result = $mysqli->query($query);
    $events = [];
    /*while ($row = $result->fetch_assoc()) {
        $events[$row['event_date']][] = $row;
    }
    return $events;*/
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
        /* CSS para estilizar o calendário */
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
            position: relative; /* Para o posicionamento dos detalhes do evento */
        }
        .calendar th {
            background-color: #f2f2f2;
        }
        .event {
            background-color: #e6ffe6;
            cursor: pointer;
            margin-top: 5px;
            position: relative; /* Para o posicionamento dos detalhes do evento */
        }
        .event-details {
            display: none;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            z-index: 1000;
            width: 200px;
            top: 100%; /* Alinha a caixa de detalhes logo abaixo do evento */
            left: 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); /* Sombra para destaque */
        }
        .event:hover .event-details {
            display: block; /* Mostra os detalhes do evento ao passar o mouse */
        }
        tr{
            width: 40px;
            height: 15px;
        }
        td{
            width: 40px;
            height: 15px;
            transition: scale 1s;
            
        }
        
        td:hover{
            background-color: lightgrey;
            /*rotate: 360deg;*/
            /*width: 70px;
            height: 45px;*/
            scale: 1.2;
            /* box-shadow: 5px 5px 4px black; */
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const events = document.querySelectorAll('.event');
            events.forEach(event => {
                event.addEventListener('mouseenter', function () {
                    this.querySelector('.event-details').style.display = 'block';
                });
                event.addEventListener('mouseleave', function () {
                    this.querySelector('.event-details').style.display = 'none';
                });
            });
        });
    </script>
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
                            echo "<div class='event'>{$event['event_local']}
                                    <div class='event-details'>{$event['event_hora']}</div>
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
    <h2>Adicionar Evento</h2>
    <h2>Pesquisa de Contatos</h2>
		<form method="post" action="index.php">
			<label>Nome parcial:</label>
			<input type="text" name="nome" />
			<button type="submit">Pesquisar</button>
		</form>

		<h2>Listagem de Contatos</h2>
		<?php
			$nome = '';
			if (isset($_POST['nome'])){
				$nome = $_POST['nome'];
			}
		
			/* Conectando com o banco de dados para listar registros */
			$datasource = 'mysql:host=localhost;dbname=benkyo_project';
			$user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);
	
			$query = "SELECT * FROM atividade WHERE idAtividade LIKE '%$id%'";
			$stm = $db -> prepare($query);
			
			if ($stm -> execute()) {
				
							
				while ($row = $stm -> fetch()) {
					$id = $row['contatoid'];
					$nome = $row['nome'];
					
	
					print "<tr>
								<td>$nome</td>								
								<td><button>Selecionar<button></td>
							</tr>";				
				}
				print "</table>";
			} else {
				print '<p>Erro ao listar!</p>';
			}
		?>
    <form action="calendario/add_event.php" method="post">
        <input type="hidden" id="atividade_id" name="atividade_id">
        <label for="event_date">Data:</label>
        <input type="date" id="event_date" name="event_date" required>
        <label for="event_local">Local:</label>
        <input type="text" id="event_local" name="event_local" required>
        <label for="event_hora">Hora:</label>
        <input type="time" id="event_hora" name="event_hora" required></input>
        <button type="submit">Adicionar Evento</button>
    </form>
    <button onclick="window.location.href='calendario/all_events.php'">Ver Todos os Eventos</button>
</body>
</html>
