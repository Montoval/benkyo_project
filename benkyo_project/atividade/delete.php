<?php
include 'db.php';

$idAtividade = $_GET['id'];

$query = "DELETE FROM Atividade WHERE idAtividade = :idAtividade";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':idAtividade', $idAtividade);
$stmt->execute();

header("Location: atividades.php");
exit();
?>