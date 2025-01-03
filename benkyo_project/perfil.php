<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redireciona para a página de login se não estiver logado
    exit();
}


    $image_directory = 'imagens/';
    
    // Lista de imagens disponíveis
    $images = [
        'image1.png', 
        'image2.png',    
        'image3.png', 
        'image5.png', 
        'image6.png', 
        'image7.png', 
    
    
    ];
    
    // Escolhe uma imagem aleatória
    $random_image = $images[array_rand($images)];
  
    // Salva a imagem escolhida na sessão (ou banco de dados, se preferir)
    $_SESSION['perfil_imagem'] = $random_image;
    
    // Caminho completo da imagem
    $image_path = $image_directory . $_SESSION['perfil_imagem'];
    
    // Exibe a imagem no perfil do usuário
 
    
    // Opcional: se você quiser armazenar no banco de dados
    // $pdo = new PDO('mysql:host=localhost;dbname=nome_do_banco', 'usuario', 'senha');
    // $query = "UPDATE usuarios SET perfil_imagem = :perfil_imagem WHERE id = :user_id";
    // $stmt = $pdo->prepare($query);
    // $stmt->execute(['perfil_imagem' => $random_image, 'user_id' => $_SESSION['user_id']]);




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
                    <div class='boxleft'>
                    <div class="perfil">
                        <h1>Perfil do Usuário</h1>
                        <div class="imgperfil1">  <img src="<?= $image_path ?>" alt="Imagem de Perfil"> </div>
                        
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
                            <button type="submit" >Atualizar</button>
                            <a href="logout.php" class="sair">Sair</a>
                        </form>
                    </div>
                </div>
                </div>
                                        <div class='geral'>
                           </div>
                                <script>
                                        function selectImage(imagens) {                                           
                                            document.getElementById('imagens').src = imagens/   ;
                                            document.getElementById('selected-imagens-input').value = imagens;
                                        }
                                </script>
                

                </div>
            
                <footer class="footer-fix">
                    <div class="waves">
                        <div class="wave" id="wave1"></div>
                        <div class="wave" id="wave2"></div>
                        <div class="wave" id="wave3"></div>
                        <div class="wave" id="wave4"></div>
                    </div>
                    <ul class="social-icon">
                        <li class="social-icon__item"><a class="social-icon__link" href="insta.php">
                                <ion-icon name="logo-instagram"></ion-icon>
                            </a></li>
                    </ul>
                    <ul class="menu">
                    </ul>
                </footer>
                <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            </div>
        </div>
    </main>
</body>
</html>
