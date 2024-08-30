<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$mysqli = new PDO('mysql:host=localhost;dbname=benkyo_project', 'root', 'vertrigo');

// Verifica se a conexão foi bem-sucedida
if (!$mysqli) {
    die("Connection failed: " . $mysqli->errorInfo());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtendo dados do formulário
    $event_date = $_POST['event_date'];
    $event_local = $_POST['event_local'];
    $event_hora = $_POST['event_hora'];
    $id_atividade = $_POST['idAtividade']; // Certifique-se de que este campo é enviado corretamente
    $id_usuario = $_SESSION['user_id']; // Obtém o ID do usuário da sessão

    // Debug: Exibir dados recebidos
    echo "Data do Evento: $event_date<br>";
    echo "Local do Evento: $event_local<br>";
    echo "Hora do Evento: $event_hora<br>";
    echo "ID da Atividade: $id_atividade<br>";
    echo "ID do Usuário: $id_usuario<br>";

    // Verifica se as variáveis foram recebidas
    if (empty($event_date) || empty($event_local) || empty($event_hora) || empty($id_atividade)) {
        die("Dados do evento não podem estar vazios.");
    }

    // Prepara e executa a consulta de inserção
    $stm = $mysqli->prepare("INSERT INTO evento (idAtividade, idUsuario, dataEvento, localEvento, horaEvento) VALUES (?, ?, ?, ?, ?)");
    $stm->bindParam(1, $id_atividade);
    $stm->bindParam(2, $id_usuario);
    $stm->bindParam(3, $event_date);
    $stm->bindParam(4, $event_local);
    $stm->bindParam(5, $event_hora);

    if ($stm->execute()) {
        // Redireciona após a inserção bem-sucedida
        header('Location: ../calendario.php'); // Corrija o caminho se necessário
        exit();
    } else {
        // Exibe mensagem de erro se a inserção falhar
        die("Erro ao adicionar o evento: " . implode(", ", $stm->errorInfo()));
    }
}
?>
