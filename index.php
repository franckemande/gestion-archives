<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Archives - Entreprise</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="main.css">

</head>
<body>
    <header><div class="logo">
        <img src="menu.jpeg" alt="menu" width="40px">
        <figcaption>ARCHIVE D'ENTREPRISE</figcaption>
        
        <nav> 
            <ul>
                <li><a href="form2.php">Centre de gestion</a></li>
                <li><a href="document.php">Documents</a></li>
                <li><a href="services.php">Services</a></li>
            </ul>
        </nav>
        <aside class="sidebar">
  <h3>Navigation rapide</h3>
  <ul>
    <li><a href="form2.php">🏠 Espace d’archives</a></li>
    <li><a href="document.php">📄 Documents</a></li>
    <li><a href="ajout_doc.php">➕ Ajouter</a></li>
    <li><a href="services.php">🔧 Services</a></li>
    <li><a href="contact.php">✉️ Contact</a></li>
  </ul>
  </aside>
    </header>
    <section class="hero">
  
    <h1 class="titrebanniere">Systeme de gestion des archives</h1>
    <p class="titrebanner">
      Bienvenue sur notre système d'archives sécurisé – Gestion intelligente des documents, accès rapide et surveillance continue.
    </p>
</section>


    </div>
    <main>
    
    
        <?php
            include("main.php");
            
        ?>
    
    </main>
    <div>
    </div>

    <footer>
        <p>&copy; <?= date("Y") ?> Archive Entreprise. Tous droits réservés.</p>
        <?php
            include("footer.php");
            
        ?>
    </footer>
    
</body>
</html>
