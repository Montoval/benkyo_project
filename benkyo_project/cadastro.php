<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Benkyo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="imagens/Benkyoicon2.jpg">
</head>
<body>
    <div class="box-right1"></div>
    <div class="box-left2">
    <div class="up-box">

                <a href='index.php'>Voltar</a>
                <br>
        <h3 align="center">Cadastro de Usuário</h3>
        <form method='POST' action='inserir.php'>
            <label>Nome: </label>
            <input name='nome' placeholder="Seu Nome"><br>
            <label>Email: </label>
            <input name='email' type="text" id="email" placeholder="Seu E-mail"><br>
            <label>Senha: </label>
            <input name='senha' type="password" id="senha" placeholder="Sua Senha"><br>
            <input type="checkbox" class="show-password" id="showPassword" onclick="togglePassword()">
            <label>Senha: </label>
            <input name='csenha' type="password" id="csenha" placeholder="Confirme Senha"><br>
            <input type="checkbox" class="show-password" id="showPassword" onclick="togglePassword1()">
            <button type='submit' >Salvar</button>
        </form>
        </div>
    </div>
    <script>
function togglePassword() {
    const passwordInput = document.getElementById('senha');
    const showPasswordCheckbox = document.getElementById('showPassword');

    passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
}
function togglePassword1() {
    const passwordInput = document.getElementById('csenha');
    const showPasswordCheckbox = document.getElementById('showPassword');

    passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
}
</script>
</body>
</html>