<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$pdo = new PDO('mysql:host=localhost;dbname=benkyo_project', 'root', 'vertrigo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $query = "UPDATE usuario SET nome = ?, email = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$nome, $email, $user_id]);

    header('Location: perfil.php');
    exit();
}
?>
