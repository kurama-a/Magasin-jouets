<?php
include "../db.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Récupération des infos du jouet sélectionné
    $stmt = $conn->prepare("SELECT * FROM jouet WHERE ID_Jouet = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $jouet = $result->fetch_assoc();
    } else {
        echo "<p>Jouet introuvable.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p>ID invalide.</p>";
    exit;
}

// Mise à jour du jouet si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("UPDATE jouet SET Nom = ?, Prix = ?, Categorie = ?, Stock_disponible = ? WHERE ID_Jouet = ?");
    $stmt->bind_param("sdssi", $nom, $prix, $categorie, $stock, $id);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Jouet mis à jour avec succès.</p>";
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
    <title>Modifier Jouet</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../base/nav.php"; ?>

    <h1>Modifier le Jouet</h1>

    <div class="form-container">
        <form method="POST">
            <label>Nom :</label>
            <input type="text" name="nom" value="<?php echo htmlspecialchars($jouet['Nom']); ?>" required>

            <label>Prix (€) :</label>
            <input type="number" step="0.01" name="prix" value="<?php echo $jouet['Prix']; ?>" required>

            <label>Catégorie :</label>
            <input type="text" name="categorie" value="<?php echo htmlspecialchars($jouet['Categorie']); ?>" required>

            <label>Stock :</label>
            <input type="number" name="stock" value="<?php echo $jouet['Stock_disponible']; ?>" required>

            <button type="submit">Modifier</button>
            <a class='edit-btn-cancel' href="liste.php">Retour</a>
        </form>
    </div>
</body>
</html>
