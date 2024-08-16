<?php$mysqli = new PDO("mysql:host=localhost;dbname=benkyo_project", "root", "vertrigo");

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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atividades</title>
    <link rel="stylesheet" href="calendario.css">
    <link rel="icon" type="image/x-icon" href="imagens/Benkyoicon2.jpg">
</head>
<body>
    <nav class="menu-fixo">
        <a href="principal.html" class="active">Inicio</a>
        <a href="calendario.php">Calendário</a>
        <a href="atividades.php">Atividades</a>
        <a href="perfil.php">Perfil</a>
    </nav>
    <main>
        <div class="container">
            <div class="box">
                <div class="menuP">

                  <div class="sugestoes">
                    <h1>Sugestões</h1>
                    <p id="sugestoes_text">Vamo fazer uma parada para os usuarios criarem a sua atividade para depois adicionar no calendario </p>
                  </div>
                </div>

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
                            echo "<div class='event'>{$event['event_title']}
                                    <div class='event-details'>{$event['event_description']}</div>
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
    <form action="add_event.php" method="post">
        <label for="event_date">Data:</label>
        <input type="date" id="event_date" name="event_date" required>
        <label for="event_title">Título:</label>
        <input type="text" id="event_title" name="event_title" required>
        <label for="event_description">Descrição:</label>
        <textarea id="event_description" name="event_description" required></textarea>
        <button type="submit">Adicionar Evento</button>
    </form>
    <button onclick="window.location.href='all_events.php'">Ver Todos os Eventos</button>
                


                <footer class="footer-fix">
                    <div class="waves">
                      <div class="wave" id="wave1"></div>
                      <div class="wave" id="wave2"></div>
                      <div class="wave" id="wave3"></div>
                      <div class="wave" id="wave4"></div>
                    </div>
                    <ul class="social-icon">
                      <li class="social-icon__item"><a class="social-icon__link" href="#">
                          <ion-icon name="logo-facebook"></ion-icon>
                        </a></li>
                      <li class="social-icon__item"><a class="social-icon__link" href="#">
                          <ion-icon name="logo-twitter"></ion-icon>
                        </a></li>
                      <li class="social-icon__item"><a class="social-icon__link" href="#">
                          <ion-icon name="logo-linkedin"></ion-icon>
                        </a></li>
                      <li class="social-icon__item"><a class="social-icon__link" href="#">
                          <ion-icon name="logo-instagram"></ion-icon>
                        </a></li>
                    </ul>
                    <ul class="menu">
                      <li class="menu__item"><a class="menu__link" href="#">Home</a></li>
                      <li class="menu__item"><a class="menu__link" href="#">About</a></li>
                      <li class="menu__item"><a class="menu__link" href="#">Services</a></li>
                      <li class="menu__item"><a class="menu__link" href="#">Team</a></li>
                      <li class="menu__item"><a class="menu__link" href="#">Contact</a></li>
                
                    </ul>
                  </footer>
                  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            </div>
        </div>
       

    </main>
</body>
</html>