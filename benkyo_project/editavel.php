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

                 
                  
              
           <?php
           include 'atividade/db.php';
           
           $idAtividade = $_GET['id'];
           
           $query = "SELECT * FROM atividade WHERE idAtividade = :idAtividade";
           $stmt = $pdo->prepare($query);
           $stmt->bindParam(':idAtividade', $idAtividade);
           $stmt->execute();
           $atividade = $stmt->fetch(PDO::FETCH_ASSOC);
           
           if ($_SERVER["REQUEST_METHOD"] == "POST") {
               $descricaoAtividade = $_POST['descricaoAtividade'];
               $tipoAtividade = $_POST['tipoAtividade'];
           
               $query = "UPDATE Atividade SET descricaoAtividade = :descricaoAtividade, tipoAtividade = :tipoAtividade WHERE idAtividade = :idAtividade";
               $stmt = $pdo->prepare($query);
               $stmt->bindParam(':descricaoAtividade', $descricaoAtividade);
               $stmt->bindParam(':tipoAtividade', $tipoAtividade);
               $stmt->bindParam(':idAtividade', $idAtividade);
               $stmt->execute();
           
               header("Location: atividades.php");
               exit();
           }
           ?>
           
          
               <form method="post">
                   <label for="descricaoAtividade">Descrição:</label>
                   <input type="text" id="descricaoAtividade" name="descricaoAtividade" value="<?= htmlspecialchars($atividade['descricaoAtividade']) ?>" required>
                   <label for="tipoAtividade">Tipo:</label>
                   <select id="tipoAtividade" name="tipoAtividade" required>
                       <option value="Comemorativa" <?= $atividade['tipoAtividade'] == 'Comemorativa' ? 'selected' : '' ?>>Comemorativa</option>
                       <option value="Esportes" <?= $atividade['tipoAtividade'] == 'Esportes' ? 'selected' : '' ?>>Esportes</option>
                       <option value="Estudos" <?= $atividade['tipoAtividade'] == 'Estudos' ? 'selected' : '' ?>>Estudos</option>
                       <option value="Outros" <?= $atividade['tipoAtividade'] == 'Outros' ? 'selected' : '' ?>>Outros</option>
                   </select>
                   <button type="submit">Salvar</button>
               </form>
               <a href="atividades.php">Voltar</a>
           </body>
           </html>
           
      
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