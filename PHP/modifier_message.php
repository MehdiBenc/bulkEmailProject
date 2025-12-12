<?php
require 'connexion.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$message = '';
$success = false;

if (!isset($_GET['id'])) {
    header("Location: historique.php");
    exit();
}

$id = $_GET['id'];

// Récupère les infos du message
$stmt = $db->prepare("SELECT * FROM message_envoye WHERE id = ? AND expediteur_id = ?");
$stmt->execute([$id, $userId]);
$messageData = $stmt->fetch();

if (!$messageData) {
    echo "Message introuvable ou accès non autorisé.";
    exit();
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenu = trim($_POST['contenu']);

    if (empty($contenu)) {
        $message = "Le contenu du message ne peut pas être vide.";
    } else {
        $stmt = $db->prepare("UPDATE message_envoye SET contenu = ? WHERE id = ? AND expediteur_id = ?");
        $stmt->execute([$contenu, $id, $userId]);
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le message</title>
    <link rel="stylesheet" href="../bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <style>
        body{
            background-image: linear-gradient(to right, #e5eef7, #96b3d7);
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Modifier le message</h2>
    <a href="historique.php" class="btn btn-secondary mb-3">← Retour à l'historique</a>

    <?php if ($message): ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success">Message modifié avec succès.</div>
        <script>
            setTimeout(() => window.location.href = "historique.php", 1500);
        </script>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="contenu" class="form-label">Nouveau contenu :</label>
            <textarea name="contenu" id="contenu" class="form-control" rows="5"><?php echo htmlspecialchars($messageData['contenu']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="historique.php" class="btn btn-outline-secondary">Annuler</a>
    </form>
</div>
</body>
</html>
