<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche d'utilisateur</title>
</head>
<body>

<h1>Recherche d'utilisateur</h1>

<!-- Formulaire de recherche -->
<form method="POST">
    <label for="critere">Rechercher par :</label>
    <select name="critere" id="critere" required>
        <option value="nom">Nom</option>
        <option value="prenom">Prénom</option>
        <option value="id">ID</option>
        <option value="age">Âge</option>
    </select>
    <br>
    <label for="valeur">Entrez la valeur :</label>
    <input type="text" name="valeur" id="valeur" required>
    <br>
    <button type="submit">Rechercher</button>
</form>

<?php
// Configuration de la connexion à la base de données
$host = 'localhost'; // Adresse du serveur MySQL
$user = 'root'; // Nom d'utilisateur MySQL
$password = ''; // Mot de passe MySQL
$database = 'monny'; // Nom de la base de données

// Création de la connexion MySQL
$conn = new mysqli($host, $user, $password, $database);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['critere']) && isset($_POST['valeur'])) {
    $critere = $conn->real_escape_string($_POST['critere']); // Échapper les caractères spéciaux pour éviter les injections SQL
    $valeur = $conn->real_escape_string($_POST['valeur']);   // Échapper les caractères spéciaux

    // Construction de la requête SQL en fonction du critère
    $sql = "";
    if ($critere === "nom") {
        $sql = "SELECT * FROM utilisateurs WHERE nom LIKE '%$valeur%'";
    } elseif ($critere === "prenom") {
        $sql = "SELECT * FROM utilisateurs WHERE prenom LIKE '%$valeur%'";
    } elseif ($critere === "id") {
        $sql = "SELECT * FROM utilisateurs WHERE id = '$valeur'";
    } elseif ($critere === "age") {
        $sql = "SELECT * FROM utilisateurs WHERE age = '$valeur'";
    }

    // Vérifier si la requête SQL a été construite
    if (!empty($sql)) {
        $result = $conn->query($sql); // Exécution de la requête

        // Vérification des résultats
        if ($result && $result->num_rows > 0) {
            echo "<h2>Résultats de la recherche</h2>";
            // Affichage des résultats dans un tableau HTML
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Âge</th>
                        <th>Date d'inscription</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['prenom']}</td>
                        <td>{$row['nom']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['date_inscription']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Aucun résultat trouvé pour le critère \"$critere\" avec la valeur \"$valeur\".</p>";
        }
    } else {
        echo "<p>Erreur : La requête SQL n'a pas pu être construite.</p>";
    }
} else {
    echo "<p>Veuillez sélectionner un critère et entrer une valeur pour effectuer la recherche.</p>";
}

// Fermeture de la connexion
$conn->close();
?>

</body>
</html>
