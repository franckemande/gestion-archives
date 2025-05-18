<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="operation.css">
    <title>Document</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    
    $to = "franckemande@gmail.com";
    $subject = "Message de contact de $alex";
    $body = "Email : $email\n\nMessage :\n$message";

    if (mail($to, $subject, $body)) {
        echo "Message envoyé avec succès.";
    } else {
        ?><div class="r1">"le lien https://send.api.mailtrap.io/api/send  va me permettre de recevoir ton email merci !!!"</div><?php 
    }
}
?>

</body>
</html>
