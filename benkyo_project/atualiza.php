<?php
    // Recebe dados do FORM
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha_atual = MD5($_POST['senha_atual']);
    $nova_senha = $_POST['nova_senha'];

    try {
        // Conecta com BD
        $ds = "mysql:host=localhost;dbname=benkyo_project";
        $con = new PDO($ds, 'root', 'vertrigo');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se a senha atual está correta
        $query_select = "SELECT senha FROM usuario WHERE id = :id";
        $stm = $con->prepare($query_select);
        $stm->bindParam(':id', $id);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);

        if ($result['senha'] != $senha_atual) {
            echo "<script>
                alert('Senha atual incorreta');
                window.location.href='edita.php?id=$id';
                </script>";
            die();
        }

        // Atualiza os dados do usuário
        if (empty($nova_senha)) {
            // Se a nova senha estiver em branco, não altera a senha
            $sql = "UPDATE usuario SET nome = ?, email = ? WHERE id = ?";
            $stm = $con->prepare($sql);
            $stm->execute(array($nome, $email, $id));
        } else {
            // Caso contrário, altera a senha também
            $nova_senha = MD5($nova_senha);
            $sql = "UPDATE usuario SET nome = ?, email = ?, senha = ? WHERE id = ?";
            $stm = $con->prepare($sql);
            $stm->execute(array($nome, $email, $nova_senha, $id));
        }

        // Verificar atualização
        if ($stm) {
            header("Location: index.php");
        } else {
            echo "<p>Erro ao atualizar</p>";
        }
    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
?>
