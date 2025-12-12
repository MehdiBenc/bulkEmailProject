<?php
require 'connexion.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = 'DELETE FROM message_envoye WHERE id=:id';
    $stmt = $db -> prepare($sql);
    if($stmt -> execute([':id' => $id])){
    header("Location: historique.php");
}
}

$stmt = $db->prepare("SELECT * FROM message_envoye WHERE expediteur_id = ? ORDER BY date_envoi DESC");
$stmt->execute([$userId]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des messages</title>
    <link rel="stylesheet" href="../bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <style>
        body{
            background-image: linear-gradient(to right, #e5eef7, #96b3d7);
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Historique des messages envoyés</h2>
    <a href="main.php" class="btn btn-primary mb-3">← Retour</a>
    <?php if (count($messages) === 0): ?>
        <div class="alert alert-info">Aucun message envoyé pour l’instant.</div>
    <?php else: ?>
    <table class="table table-bordered table-custom">
        <thead>
            <tr>
                <th>Destinataire</th>
                <th>Contenu</th>
                <th>Date d’envoi</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $msg): ?>
                <tr>
                    <td><?php echo htmlspecialchars($msg['email_destinataire']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($msg['contenu'])); ?></td>
                    <td><?php echo $msg['date_envoi']; ?></td>
                    <td>
                        <a href="modifier_message.php?id=<?php echo $msg['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="historique.php?delete_id=<?php echo $msg['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce message ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
</body>
</html>
