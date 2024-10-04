<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Benkyo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="imagens/Benkyoicon2.jpg">
    <style>
        
    </style>
</head>
<body>
    
<div class="box">
    <div class="box-left"></div>
    <div class="box-left">
        <h1>Benkyo</h1>
    </div>

    <div class="box-right">
        <div class="box-center">
            <h3 align="center">Login de Usuário</h3>
            <form method="POST" action="confirmalogin.php">
                <label>Nome: </label>
                <input name="username" placeholder="Seu Username"><br>
                <label>Senha: </label>
                <input name="usersenha" type="password" id="usersenha" placeholder="Sua Senha">
                <input type="checkbox" class="show-password" id="showPassword" onclick="togglePassword()">
                <div class="botao">
                    <button type="submit">Logar</button>
                </div>
                <a href="cadastro.php">Não tem login? Cadastre-se.</a>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('usersenha');
    const showPasswordCheckbox = document.getElementById('showPassword');

    passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
}
</script>

</body>
</html>
