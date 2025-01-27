<?php
include "../db.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Récupération des infos du client sélectionné
    $stmt = $conn->prepare("SELECT * FROM client WHERE ID_Client = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $client = $result->fetch_assoc();
    } else {
        echo "<p>Client introuvable.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p>ID invalide.</p>";
    exit;
}

// Mise à jour du client si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $stmt = $conn->prepare("UPDATE client SET Nom = ?, Adresse = ?, Email = ?, Telephone = ? WHERE ID_Client = ?");
    $stmt->bind_param("ssssi", $nom, $adresse, $email, $telephone, $id);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Client mis à jour avec succès.</p>";
        header("Location: liste.php"); // Redirection après modification
        exit();
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
    <title>Modifier Client</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../base/nav.php"; ?>

    <h1>Modifier le Client</h1>

    <div class="form-container">
        <form method="POST">
            <label>Nom :</label>
            <input type="text" name="nom" value="<?php echo htmlspecialchars($client['Nom']); ?>" required>

            <label>Adresse :</label>
            <input type="text" name="adresse" value="<?php echo htmlspecialchars($client['Adresse']); ?>" required>

            <label>Email :</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($client['Email']); ?>" required>

            <label>Téléphone :</label>
            <input type="text" name="telephone" value="<?php echo htmlspecialchars($client['Telephone']); ?>" required>

            <button type="submit">Modifier</button>
            <a class='edit-btn-cancel' href="liste.php">Retour</a>
        </form>
    </div>
</body>
</html>
