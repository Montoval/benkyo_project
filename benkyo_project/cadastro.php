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
        <h3 align ="center">Cadastro de Usuário</h3>
        <form method='POST' action='inserir.php' onsubmit="return validarSenhas()">
            <label>Nome: </label>
            <input name='nome' placeholder="Seu Nome"><br>
            <label>Email: </label>
            <input name='email' type="text" id="email" placeholder="Seu E-mail"><br>
            <div class="senha1"> <label>Senha: </label>
                <input name='senha' type="password" id="senha" placeholder="Sua Senha">
                <input type="checkbox" id="password" onclick="togglePassword()"><div>
            <div class ="senha2"><label>Senha: </label> 
                <input name='csenha' type="password" id="csenha" placeholder="Confirme Senha">
                <input type="checkbox"  id="password1" onclick="togglePassword1()"><div>
            <button type='submit' >Salvar</button>
        </form>
        </div>
    </div>
    <script>
function togglePassword() {
    const passwordInput = document.getElementById('senha');
    const showPasswordCheckbox = document.getElementById('password');

    passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
}
function togglePassword1() {
    const passwordInput = document.getElementById('csenha');
    const showPasswordCheckbox = document.getElementById('password1');

    passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
}
function validarSenhas() {
            // Obtem os valores das senhas
            const senha = document.getElementById('senha').value;
            const csenha = document.getElementById('csenha').value;

            // Verifica se as senhas são iguais
            if (senha !== csenha) {
                alert('As senhas não conferem. Por favor, tente novamente.');
                return false; // Impede o envio do formulário
            }

            return true; // Permite o envio do formulário
        }
</script>
</body>
</html>