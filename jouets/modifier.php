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

// Récupération des fournisseurs pour le menu déroulant
$fournisseurs = [];
$fournisseur_stmt = $conn->query("SELECT ID_Fournisseur, Nom FROM fournisseur");
while ($row = $fournisseur_stmt->fetch_assoc()) {
    $fournisseurs[] = $row;
}

// Mise à jour du jouet si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];
    $stock = $_POST['stock'];
    $id_fournisseur = $_POST['id_fournisseur']; // Récupération du fournisseur sélectionné

    $stmt = $conn->prepare("UPDATE jouet SET Nom = ?, Prix = ?, Categorie = ?, Stock_disponible = ?, ID_Fournisseur = ? WHERE ID_Jouet = ?");
    $stmt->bind_param("sdsiii", $nom, $prix, $categorie, $stock, $id_fournisseur, $id);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Jouet mis à jour avec succès.</p>";
        header("Location: liste.php");
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

            <label>Fournisseur :</label>
            <select name="id_fournisseur" required>
                <option value="">Sélectionner un fournisseur</option>
                <?php foreach ($fournisseurs as $fournisseur) { ?>
                    <option value="<?php echo $fournisseur['ID_Fournisseur']; ?>"
                        <?php echo ($jouet['ID_Fournisseur'] == $fournisseur['ID_Fournisseur']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($fournisseur['Nom']); ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit">Modifier</button>
            <a class='edit-btn-cancel' href="liste.php">Retour</a>
        </form>
    </div>
</body>
</html>
