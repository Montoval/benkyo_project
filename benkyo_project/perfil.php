<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redireciona para a página de login se não estiver logado
    exit();
}

// Conecte-se ao banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=benkyo_project', 'root', 'vertrigo');

// Obtenha as informações do usuário
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM usuario WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="perfil.css">
    <link rel="icon" type="image/x-icon" href="imagens/Benkyoicon2.jpg">
</head>
<body>
    <nav class="menu-fixo">
        <a href="principal.html" class="active">Inicio</a>
        <a href="calendario.php">Calendário</a>
        <a href="atividades.php">Atividades</a>
        <a href="perfil.php">Perfil</a>
    </nav>
    <main>
        <div class="container">
            <div class="box">
                <div class="menuP">
                    <div class="perfil">
                        <h1>Perfil do Usuário</h1>
                        <div class="imgperfil"></div>
                        <h3 ><strong>Nome:</strong> <?php echo htmlspecialchars($user['nome']); ?></h3>
                        <h3><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></h3>
                        
                    
                    </div>
                <div class = "alterar">
                    <div class="editar">
                        <h1>Editar Perfil</h1>
                        <form action="updateperfil.php" method="post">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" required><br>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
                            <button type="submit">Atualizar</button>
                            <a href="logout.php">Sair</a>
                        </form>
                    </div>
                </div>
            </div>
                <footer class="footer-fix">
                    <div class="waves">
                        <div class="wave" id="wave1"></div>
                        <div class="wave" id="wave2"></div>
                        <div class="wave" id="wave3"></div>
                        <div class="wave" id="wave4"></div>
                    </div>
                    <ul class="social-icon">
                        <li class="social-icon__item"><a class="social-icon__link" href="#">
                            <ion-icon name="logo-facebook"></ion-icon>
                        </a></li>
                        <li class="social-icon__item"><a class="social-icon__link" href="#">
                            <ion-icon name="logo-twitter"></ion-icon>
                        </a></li>
                        <li class="social-icon__item"><a class="social-icon__link" href="#">
                            <ion-icon name="logo-linkedin"></ion-icon>
                        </a></li>
                        <li class="social-icon__item"><a class="social-icon__link" href="#">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a></li>
                    </ul>
                    <ul class="menu">
                        <li class="menu__item"><a class="menu__link" href="#">Home</a></li>
                        <li class="menu__item"><a class="menu__link" href="#">About</a></li>
                        <li class="menu__item"><a class="menu__link" href="#">Services</a></li>
                        <li class="menu__item"><a class="menu__link" href="#">Team</a></li>
                        <li class="menu__item"><a class="menu__link" href="#">Contact</a></li>
                    </ul>
                </footer>
                <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            </div>
        </div>
    </main>
</body>
</html>
