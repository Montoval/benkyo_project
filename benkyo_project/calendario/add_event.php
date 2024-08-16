<?php
  $mysqli= new PDO ('mysql:host=localhost;dbname=teste', 'root', 'vertrigo');



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_date = $_POST['event_date'];
    $event_title = $_POST['event_title'];
    $event_description = $_POST['event_description'];

    $stm = $mysqli->prepare("INSERT INTO events (event_date, event_title, event_description) VALUES (?, ?, ?)");
    $stm->bindParam(1, $event_date);
    $stm->bindParam(2, $event_title);
    $stm->bindParam(3, $event_description);
    $stm->execute();
   /* $stm->close();*/

    header("Location: index.php?month=" . date('m', strtotime($event_date)) . "&year=" . date('Y', strtotime($event_date)));
}
?>
