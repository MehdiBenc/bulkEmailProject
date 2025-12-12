<?php
require 'connexion.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$userEmail = $_SESSION['email'];

$message = '';
$success = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destinataires = $_POST['emails'] ?? [];
    $contenu = trim($_POST['message']);

    if (empty($destinataires)) {
        $message = "Veuillez sélectionner au moins un utilisateur.";
    } elseif (empty($contenu)) {
        $message = "Le message ne peut pas être vide.";
    } else {
        $success = true;

        $expediteur_id = $_SESSION['user_id'];
        $stmt = $db->prepare("INSERT INTO message_envoye (contenu, email_destinataire, expediteur_id) VALUES (?, ?, ?)");

        foreach ($destinataires as $email) {
          $stmt->execute([$contenu, $email, $expediteur_id]);
        }
    }
}

$stmt = $db->query("SELECT * FROM utilisateur");
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>










<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bulk Email Service</title>
  <link rel="stylesheet" href="../CSS/index.css">
  <link rel="stylesheet" href="../bootstrap-5.3.6-dist/css/bootstrap.min.css">
  <script src="../bootstrap-5.3.6-dist/js/bootstrap.min.js"></script>
</head>
<body>
<section id="nav-bar">
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href=""><img src="../Images/mail2.png"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#banner">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">SERVICES</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about-us">ABOUT US</a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#footer">CONTACT</a>
          </li>
        </ul>
        <form action="logout.php" method="post" class="d-flex">
        <button type="submit" id="decc" class="btn btn-outline-danger">Déconnexion</button>
        </form>
      </div>
    </div>
  </nav>
</section>
<section id="banner">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p class="title1">Envoyer à plusieurs</p>
        <?php if (!empty($userEmail)): ?>
          <div>
            De: <?php echo htmlspecialchars($userEmail); ?> 
          </div>
        <?php endif; ?>
        <?php if (!empty($message)): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success">Message envoyé avec succès aux utilisateurs suivants :</div>
            <ul class="list-group mb-4">
                <?php foreach ($_POST['emails'] as $email): ?>
                    <li class="list-group-item"><?php echo htmlspecialchars($email); ?></li>
                <?php endforeach; ?>
            </ul>
            <p><strong>Contenu du message :</strong></p>
            <div class="border p-3 bg-light"><?php echo nl2br(htmlspecialchars($_POST['message'])); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="message" class="form-label">Message à envoyer :</label>
                <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Choisir les destinataires :</label>
                <?php foreach ($utilisateurs as $user): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="emails[]" value="<?php echo htmlspecialchars($user['email']); ?>" id="user_<?php echo $user['id']; ?>">
                        <label class="form-check-label" for="user_<?php echo $user['id']; ?>">
                            <?php echo htmlspecialchars($user['nom']) . " (" . htmlspecialchars($user['email']) . ")"; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        <input type="submit" class="btn-login" value="Envoyer">
        <a href="ajouterSupprimer.php" class="btn-signup">Ajouter/Supprimer utilisateur</a><br>
        <a href="historique.php" class="btn-signup">Historique</a>
      </div>
      <div class="col-md-6 text-center">
        <img src="../Images/Image_fx.png" class="img-fluid">
      </div>
    </div>
  </div>
  <img src="../Images/wave1.png" class="bottom-img">
</section>
<section id="services">
<div class="container text-center">
  <h1 class="title">WHAT WE DO ?</h1>
  <div class="row text-center">
    <div class="col-md-4 services">
      <img src="../Images/mail.png" class="service-img">
      <h4>Email Service</h4>
      <p>Easily Manage and Send group Emails with a single Click, reaching all your Contacts instantly through a clean and user-friendly interface.</p>
    </div>
    <div class="col-md-4 services">
      <img src="../Images/contact-mail.png" class="service-img">
      <h4>Contact Management</h4>
      <p>Keep your contacts organized with smart grouping, allowing for efficient targeting and seamless communication every time.</p>
    </div>
    <div class="col-md-4 services">
      <img src="../Images/business-report.png" class="service-img">
      <h4>Tracking & Analytics</h4>
      <p>Monitor email performance with real-time tracking, open rates, and delivery reports to optimize your campaigns.</p>
    </div>
  </div>
</div>
</section>
<section id="about-us">
  <div class="container">
    <h1 class="title text-center">WHY CHOOSE US ?</h1>
    <div class="row">
      <div class="col-md-6 about-us">
        <p class="about-title">Why we're different</p>
        <ul>
          <li>User-Friendly Interface</li>
          <li>Fast & Reliable Delivery</li>
          <li>Advanced Contact Management</li>
          <li>Real-Time Tracking & Analytics</li>
          <li>Secure & Confidential</li>
          <li>Affordable Plans</li>
          <li>Dedicated Support Team</li>
        </ul>
      </div>
      <div class="col-md-6">
        <img src="../Images/network.png" class="img-fluid">
      </div>
    </div>
  </div>
</section>
<section id="social-media">
  <div class="container text-center">
    <h1 class="title text-center">FIND US ON SOCIAL MEDIA</h1>
    <div class="social-icons">
      <a href="#"><img src="../Images/facebook-icon.png"></a>
      <a href="#"><img src="../Images/instagram-icon.png"></a>
      <a href="#"><img src="../Images/twitter-icon.png"></a>
      <a href="#"><img src="../Images/whatsapp-icon.png"></a>
      <a href="#"><img src="../Images/linkedin-icon.png"></a>
      <a href="#"><img src="../Images/snapchat-icon.png"></a>
    </div>
  </div>
</section>
<section id="footer">
  <img src="../Images/wave2.png" class="footer-img">
  <div class="container">
    <div class="row">
      <div class="col-md-4 footer-box">
        <img src="../Images/mail2.png">
        <p>Easily Manage and Send group Emails with a single Click, reaching all your Contacts instantly through a clean and user-friendly interface.</p>
      </div>
      <div class="col-md-4 footer-box">
        <p><b>CONTACT US</b></p>
        <p>Mehdi Benchekroun, Ilias Lhor</p>
        <p>+212 623744592</p>
        <p>mehdiilyass@gmail.com</p>
      </div>
      <div>
        <hr>
        <p class="c">Website Created by Mehdi & Ilias</p>
      </div>
    </div>
  </div>
</section>
</body>
</html>