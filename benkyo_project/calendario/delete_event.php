<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idEvento'])) {
    $idEvento = $_POST['idEvento'];
    $user_id = $_SESSION['user_id'];

    $pdo = new PDO("mysql:host=localhost;dbname=benkyo_project", "root", "vertrigo");

    $query = "DELETE FROM evento WHERE idEvento = ? AND idUsuario = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$idEvento, $user_id]);

    header('Location: all_events.php');
    exit();
} else {
    header('Location: all_events.php');
    exit();
}
