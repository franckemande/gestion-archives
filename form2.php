<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="head.css">
    <link rel="stylesheet" href="mai.css">
    <title>Document</title>
</head>
<body>
<?php
   include("head.php");
   ?>
  <main>
    <h1> Encore la bienvenue dans notre système de gestion des archives</h1>
    <h3><strong>Notre solution vous offre une gestion simplifiée et efficace de vos documents et archives, optimisant ainsi l'organisation de votre entreprise.</strong></h3>
    <ul >
        
        <li><i>📅</i><a href="compte.php">mon compte </a></li>
        
    </ul>
    <h3><strong>Pour commencer, veuillez vous connecter à votre compte </strong></h3>
    <div class="ai">
        <div class="mai">
        <?php
        include("mai.php");
        ?>
        </div>
        <div class="ma">
        <?php
        include("mai.php");
        ?>
        </div>
    </main>


<?php
   include("footer.php");
   ?>
</body>
</html>