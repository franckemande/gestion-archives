<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
    <title>contact</title>
</head>
<body>
<section class="contact-section">
  <h2>Contactez-nous</h2>
  <form action="trait.php" method="POST" class="contact-form">
    <div class="form-group">
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom" required>
    </div>

    <div class="form-group">
      <label for="email">Email du services:</label>
      <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
      <label for="message">Message :</label>
      <textarea id="message" name="message" rows="5" required></textarea>
    </div>

    <button type="submit">📨 Envoyer le message</button>
  </form>
</section>

</body>
</html>