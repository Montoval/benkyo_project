<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atividades</title>
    <link rel="stylesheet" href="styleP.css">
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

                  <div class="box-atividade">
                   
                    <?php
                    include "atividade/atividade.php";
                    ?>
                  </div>
                  
              <?php
           
              include "atividade/create.php";
      
              
              ?>
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