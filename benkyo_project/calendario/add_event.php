<?php
  $mysqli= new PDO ('mysql:host=localhost;dbname=benkyo_project', 'root', 'vertrigo');

  $query = "SELECT evento.idAtividade, evento.idUsuario, evento.dataEvento, evento.localEvento, evento.horaEvento
  FROM evento
  INNER JOIN atividade ON atividade.idAtividade = evento.idAtividade";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_date = $_POST['dataEvento'];
    $event_local = $_POST['localEvento'];
    $event_hora = $_POST['horaEvento'];
    $id_atividade = $_POST['idAtividade'];
   /* session_start();
    $usuario= $_SESSION['id'];
    if(isset($usuario)){
      echo "<div class='bemvindo'>Bem Vindo! <strong>$usuario</strong> | Hoje é: ".date('d/m/Y')."</div>";
  }
  else{
      echo "Você não está logado!";
  }*/

    $stm = $mysqli->prepare("INSERT INTO evento (dataEvento, localEvento, horaEvento) VALUES (?, ?, ?)");
    $stm->bindParam(1, $id_atividade);
    $stm->bindParam(2, $id_atividade);
    $stm->bindParam(3, $event_date);
    $stm->bindParam(4, $event_local);
    $stm->bindParam(5, $event_hora);
    $stm->execute();
   /* $stm->close();*/

    header("Location: index.php?month=" . date('m', strtotime($event_date)) . "&year=" . date('Y', strtotime($event_date)));
}
?>
