
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
</head>
<body>
<?php
// Configuration de la connexion à la base de données
$host = 'localhost'; // Adresse du serveur MySQL
$user = 'root'; // Nom d'utilisateur MySQL
$database = 'monny'; // Nom de la base de données

// Création de la connexion MySQL
$conn = new mysqli($host, $user, '', $database); // Pas de mot de passe

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error); // Affiche un message d'erreur si la connexion échoue
}

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Échapper les caractères spéciaux pour éviter les injections SQL
    $query = $conn->real_escape_string($_POST['query']);
    
    // Requête SQL pour rechercher des utilisateurs par nom
    $sql = "SELECT * FROM utilisateurs WHERE nom LIKE '%$query%'";
    $result = $conn->query($sql); // Exécution de la requête

    // Vérification des résultats
    if ($result->num_rows > 0) {
        echo "<h1>Résultats de la recherche</h1>"; // Titre des résultats
        // Parcours des résultats et affichage
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Nom: " . $row["nom"] . " - Email: " . $row["email"] . "<br>";
        }
    } else {
        echo "Aucun résultat trouvé."; // Message si aucun utilisateur n'est trouvé
    }
}

// Fermeture de la connexion
$conn->close();
?>
</body>
</html>
