<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="promt.css">
    <title>Recherche Utilisateurs</title>
</head>
<body>
<h2>Formulaire d'Inscription</h2>
<form action="opération.php" method="post">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" value="S'inscrire">
</form>
   
</body>
</html>