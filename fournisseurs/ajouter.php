<?php
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $stmt = $conn->prepare("INSERT INTO fournisseur (Nom, Adresse, Email, Telephone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $adresse, $email, $telephone);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Fournisseur ajouté avec succès.</p>";
        header("Location: liste.php");
        exit();
    } else {
        echo "<p style='color:red;'>Erreur lors de l'ajout.</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Fournisseur</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../base/nav.php"; ?>

    <h1>Ajouter un Fournisseur</h1>

    <div class="form-container">
        <form method="POST">
            <label>Nom :</label>
            <input type="text" name="nom" required>

            <label>Adresse :</label>
            <input type="text" name="adresse" required>
            
            <label>Téléphone :</label>
            <input type="text" name="telephone" required>

            <label>Email :</label>
            <input type="email" name="email" required>

            <button type="submit">Ajouter</button>
            <a class='edit-btn-cancel' href="liste.php">Annuler</a>
        </form>
    </div>
</body>
</html>
