<?php
include 'db.php';

if (isset($_SESSION['user_id'])) {
    $idUsuario = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $descricaoAtividade = $_POST['descricaoAtividade'];
        $tipoAtividade = $_POST['tipoAtividade'];

        $query = "INSERT INTO Atividade (idUsuario, descricaoAtividade, tipoAtividade) VALUES (:idUsuario, :descricaoAtividade, :tipoAtividade)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->bindParam(':descricaoAtividade', $descricaoAtividade);
        $stmt->bindParam(':tipoAtividade', $tipoAtividade);
        $stmt->execute();

        header("Location: atividades.php");
        exit();
    }
} else {
    // Redirecionar para a página de login se o usuário não estiver logado
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Atividade</title>
    <style>
        
        /*h1{
            color: black;
        }*/
        input {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            border-radius: 7px;
        }

        

        select{ 
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            border-radius: 7px;

        }
        button{
            display: block; /* Necessário para o margin funcionar */
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;
            border-radius: 10px;
            border: black solid;
            width: 100px;
        }
        label{
            display: block;
            float: left;
            width: 70px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="box-atividades">
        <h1>Adicionar Atividade</h1>
        <form method="post">
            <label for="descricaoAtividade">Descrição:</label>
            <input type="text" id="descricaoAtividade" name="descricaoAtividade" required><br><br>
            <label for="tipoAtividade">Tipo:</label>
            <select id="tipoAtividade" name="tipoAtividade" required>
                <option value="Comemorativa">Comemorativa</option>
                <option value="Esportes">Esportes</option>
                <option value="Estudos">Estudos</option>
                <option value="Outros">Outros</option>
            </select><br><br>
            <button type="submit">Adicionar</button>
        </form>
    </div>
</body>
</html>
