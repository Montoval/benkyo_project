<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Calendário</title>
    <link rel="stylesheet" href="styleP.css">
    <link rel="icon" type="image/x-icon" href="imagens/Benkyoicon2.jpg">
</head>
<body>
    <nav class="menu-fixo">
        <a href="principal.html">Inicio</a>
        <a href="calendario.php" class="active">Calendário</a>
        <a href="atividades.php">Atividades</a>
        <a href="perfil.php">Perfil</a>
        

    </nav>
    <main>
        <div class="container">
            <div class="box">
                <div class="menuP">

                  
                </div>
                <?php
                    include "calendario/index.php";
              
                ?>
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
