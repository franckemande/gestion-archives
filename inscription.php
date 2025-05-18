<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
</head>
<body>
<h2>Inscription</h2>
<form action="enregistrer.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required><br><br>

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="motdepasse">Mot de passe :</label>
    <input type="password" name="motdepasse" id="motdepasse" required><br><br>

    <button type="submit">S'inscrire</button>
</form>


</body>
</html>