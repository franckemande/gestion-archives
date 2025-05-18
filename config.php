
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="operation.css">
    <title>Liste des utilisateurs</title>
</head>
<body>
<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    try {


        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=monny', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($action === "recherche") {
            // Recherche d'un utilisateur
            $search_field = $_POST['search_field'];
            $search_value = '%' . $_POST['search_value'] . '%';

            $sql = "SELECT * FROM utilisateurs WHERE $search_field LIKE :search_value";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':search_value', $search_value);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                ?><div class="r2"><?php
                echo "<h2>Résultats de la recherche :</h2>";
                echo "<table border='1'>
                        <tr>
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Âge</th>
                            <th>Date d'inscription</th>
                        </tr>";
                foreach ($results as $row) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['prenom']}</td>
                            <td>{$row['nom']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['age']}</td>
                            <td>{$row['date_inscription']}</td>
                          </tr>";?></div> <?php
                }
                ?><div class="r2"><?php echo "</table>"; ?></div> <?php
            } else {
                ?><div class="r1"><?php echo "<p>Aucun résultat trouvé.</p>"; ?></div> <?php
            }
        } else {
            ?><div class="r2"><?php echo "<p style='color: red;'>Action non reconnue.</p>"; ?></div><?php 
        }
    } catch (PDOException $e) {
        ?><div class="r1"><?php echo "<p style='color: red;'>Erreur SQL : " . $e->getMessage() . "</p>"; ?><div class="r1"><?php
    }
}
?>

</body>
</html>

