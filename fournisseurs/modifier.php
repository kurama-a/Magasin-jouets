<?php
include "../db.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Récupération des infos du fournisseur sélectionné
    $stmt = $conn->prepare("SELECT * FROM fournisseur WHERE ID_Fournisseur = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $fournisseur = $result->fetch_assoc();
    } else {
        echo "<p>Fournisseur introuvable.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p>ID invalide.</p>";
    exit;
}

// Mise à jour du fournisseur si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $stmt = $conn->prepare("UPDATE fournisseur SET Nom = ?, Adresse = ?, Email = ?, Telephone = ? WHERE ID_Fournisseur = ?");
    $stmt->bind_param("ssssi", $nom, $adresse, $email, $telephone, $id);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Fournisseur mis à jour avec succès.</p>";
        header("Location: liste.php"); // Redirection après modification
        exit;
    } else {
        echo "<p style='color:red;'>Erreur lors de la mise à jour.</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Fournisseur</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../base/nav.php"; ?>

    <h1>Modifier le Fournisseur</h1>

    <div class="form-container">
        <form method="POST">
            <label>Nom :</label>
            <input type="text" name="nom" value="<?php echo htmlspecialchars($fournisseur['Nom']); ?>" required>

            <label>Adresse :</label>
            <input type="text" name="adresse" value="<?php echo htmlspecialchars($fournisseur['Adresse']); ?>" required>

            <label>Email :</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($fournisseur['Email']); ?>" required>

            <label>Téléphone :</label>
            <input type="text" name="telephone" value="<?php echo htmlspecialchars($fournisseur['Telephone']); ?>" required>

            <button type="submit">Modifier</button>
            <a class='edit-btn-cancel' href="liste.php">Retour</a>
        </form>
    </div>
</body>
</html>
