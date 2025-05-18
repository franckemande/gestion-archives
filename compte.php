<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="compte.css">
    <title>Recherche Utilisateurs</title>
</head>
<body>
<div class="registration-container">
  <h2> identification</h2>
  <form action="opération.php" method="post">
    <div class="form-group">
      <label for="username">Nom d'utilisateur :</label>
      <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required>
    </div>

    <div class="form-group">
      <label for="password">Mot de passe :</label>
      <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
    </div>

    <button type="submit"><i class="fa-solid fa-user-plus"></i> S'inscrire</button>
  </form>
</div>

</body>
</html>