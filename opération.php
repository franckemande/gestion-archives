

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="operation.css">
    <title>Gestion des Utilisateurs</title>
</head>
<body>
<h1 class="page-title"><i class="fa-solid fa-users-gear"></i> Gestion des Utilisateurs</h1>  
<div class="form-grid">
  <div class="form-card">
   <!-- Formulaire pour ajouter un utilisateur -->
<h2>Ajouter un utilisateur</h2>
<form method="POST">
    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" required>
    <br>
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required>
    <br>
    <label for="email">E-mail :</label>
    <input type="email" name="email" id="email" required>
    <br>
    <label for="age">Âge :</label>
    <input type="number" name="age" id="age" required>
    <br>
    <button type="submit" name="action" value="ajout">Ajouter</button>
</form>

  </div>

  <div class="form-card">
    <!-- Formulaire pour supprimer un utilisateur -->
<h2>Supprimer un utilisateur</h2>
<form method="POST">
    <label for="id_supprimer">ID de l'utilisateur :</label>
    <input type="number" name="id" id="id_supprimer" required>
    <br>
    <button type="submit" name="action" value="suppression">Supprimer</button>
</form>
  </div>

  <div class="form-card">
    <!-- Formulaire pour modifier un utilisateur -->
<h2>Modifier un utilisateur</h2>
<form method="POST">
    <label for="id_modifier">ID de l'utilisateur :</label>
    <input type="number" name="id" id="id_modifier" required>
    <br>
    <label for="prenom">Nouveau Prénom :</label>
    <input type="text" name="prenom" id="prenom_modifier">
    <br>
    <label for="nom">Nouveau Nom :</label>
    <input type="text" name="nom" id="nom_modifier">
    <br>
    <label for="email">Nouvel E-mail :</label>
    <input type="email" name="email" id="email_modifier">
    <br>
    <label for="age">Nouvel Âge :</label>
    <input type="number" name="age" id="age_modifier">
    <br>
    <button type="submit" name="action" value="modification">Modifier</button>
</form>
  </div>

  <div class="form-card">
    <!-- Formulaire pour rechercher un utilisateur -->
<h2>Rechercher un utilisateur</h2>
<form method="POST">
    <label for="search_field">Critère de recherche :</label>
    <select class="search" name="search_field" id="search_field" required>
        <option value="id">ID</option>
        <option value="prenom">Prénom</option>
        <option value="nom">Nom</option>
        <option value="age">Âge</option>
    </select>
    <br>
    <label for="search_value">Valeur :</label>
    <input type="text" name="search_value" id="search_value" required>
    <br>
    <button type="submit" name="action" value="recherche">Rechercher</button>
</form>

  </div>
</div>








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

        if ($action === "ajout") {
            // Ajout d'un utilisateur
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $age = $_POST['age'];

            $stmt = $pdo->prepare("INSERT INTO utilisateurs (prenom, nom, email, age, date_inscription) VALUES (:prenom, :nom, :email, :age, NOW())");
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':age', $age);
            $stmt->execute();

            ?><div class="r1"><?php echo "<p style='color: green;'>Utilisateur ajouté avec succès !</p>";?></div> <?php
           

        } elseif ($action === "suppression") {
            // Suppression d'un utilisateur
            $id = $_POST['id'];

            $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            ?><div class="r1"><?php echo "<p style='color: green;'>Utilisateur avec ID $id supprimé avec succès !</p>";?></div> <?php

        } elseif ($action === "modification") {
            // Modification d'un utilisateur
            $id = $_POST['id'];
            $fields = [];
            $params = [':id' => $id];

            if (!empty($_POST['prenom'])) {
                $fields[] = "prenom = :prenom";
                $params[':prenom'] = $_POST['prenom'];
            }
            if (!empty($_POST['nom'])) {
                $fields[] = "nom = :nom";
                $params[':nom'] = $_POST['nom'];
            }
            if (!empty($_POST['email'])) {
                $fields[] = "email = :email";
                $params[':email'] = $_POST['email'];
            }
            if (!empty($_POST['age'])) {
                $fields[] = "age = :age";
                $params[':age'] = $_POST['age'];
            }

            if (!empty($fields)) {
                $sql = "UPDATE utilisateurs SET " . implode(", ", $fields) . " WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);

                ?><div class="r1"><?php echo "<p style='color: green;'>Utilisateur avec ID $id modifié avec succès !</p>";?></div> <?php
            } else {
                ?><div class="r1"><?php echo "<p style='color: red;'>Aucun champ à modifier.</p>";?></div> <?php
            }

        } elseif ($action === "recherche") {
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
