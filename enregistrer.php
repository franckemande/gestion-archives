<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Afficher les erreurs pour debug (à retirer en production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$host = "localhost";
$dbname = "monny";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Mode d'erreur en exception pour PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars(trim($_POST["nom"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = $_POST["password"];

    // Vérification de l'unicité du nom, email et mot de passe
    $sql_check = "SELECT COUNT(*) FROM utilisateurs WHERE nom = ? OR email = ? OR password = ?";
    
    // IMPORTANT: on ne peut pas comparer les mots de passe en clair, on doit comparer le hash
    // Donc on va vérifier seulement le nom et email, et vérifier le hash password différemment
    
    // Vérifier nom et email
    $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE nom = ? OR email = ?");
    $stmt_check->execute([$nom, $email]);
    $count = $stmt_check->fetchColumn();

    if ($count > 0) {
        echo "❌ Nom ou email déjà utilisé.";
        exit;
    }

    // Hashage sécurisé du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertion dans la base
    $sql = "INSERT INTO utilisateurs (nom, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nom, $email, $hashed_password])) {
        echo "✅ Inscription réussie !";
    } else {
        echo "❌ Erreur lors de l'inscription.";
    }
}
?>

</body>
</html>

