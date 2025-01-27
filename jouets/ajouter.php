<?php
include "../db.php";

// Récupération des fournisseurs pour le menu déroulant
$fournisseurs = [];
$fournisseur_stmt = $conn->query("SELECT ID_Fournisseur, Nom FROM fournisseur");
while ($row = $fournisseur_stmt->fetch_assoc()) {
    $fournisseurs[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];
    $stock = $_POST['stock'];
    $id_fournisseur = $_POST['id_fournisseur']; // Récupération du fournisseur sélectionné

    $stmt = $conn->prepare("INSERT INTO jouet (Nom, Prix, Categorie, Stock_disponible, ID_Fournisseur) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsii", $nom, $prix, $categorie, $stock, $id_fournisseur);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Jouet ajouté avec succès.</p>";
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
    <title>Ajouter Jouet</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../base/nav.php"; ?>

    <h1>Ajouter un Jouet</h1>

    <div class="form-container">
        <form method="POST">
            <label>Nom :</label>
            <input type="text" name="nom" required>

            <label>Prix (€) :</label>
            <input type="number" step="0.01" name="prix" required>

            <label>Catégorie :</label>
            <input type="text" name="categorie" required>

            <label>Stock :</label>
            <input type="number" name="stock" required>

            <label>Fournisseur :</label>
            <select name="id_fournisseur" required>
                <option value="">Sélectionner un fournisseur</option>
                <?php foreach ($fournisseurs as $fournisseur) { ?>
                    <option value="<?php echo $fournisseur['ID_Fournisseur']; ?>">
                        <?php echo htmlspecialchars($fournisseur['Nom']); ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit">Ajouter</button>
            <a class='edit-btn-cancel' href="liste.php">Annuler</a>
        </form>
    </div>
</body>
</html>
