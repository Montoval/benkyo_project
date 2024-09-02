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
    <link rel="stylesheet" href="style_events.css">
    <link rel="icon" type="image/x-icon" href="imagens/Benkyoicon2.jpg">
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
    
  <nav class="menu-fixo">
        <a href="../calendario.php">Voltar</a>
  </nav>
  <main>
    <div class="container">
      <div class="box">
          <div class="evento">
            <h1>Todos os Eventos</h1>
    </div>
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