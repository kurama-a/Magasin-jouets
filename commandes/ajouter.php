<?php
include "../db.php";

// Récupération des clients pour le menu déroulant
$clients = [];
$client_stmt = $conn->query("SELECT ID_Client, Nom, Prenom FROM client");
while ($row = $client_stmt->fetch_assoc()) {
    $clients[] = $row;
}

// Récupération des jouets pour le menu déroulant
$jouets = [];
$jouet_stmt = $conn->query("SELECT ID_Jouet, Nom, Prix FROM jouet");
while ($row = $jouet_stmt->fetch_assoc()) {
    $jouets[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_commande = $_POST['date_commande'];
    $id_client = $_POST['id_client'];

    // Insertion de la commande
    $stmt = $conn->prepare("INSERT INTO commande (Date_Commande, ID_Client) VALUES (?, ?)");
    $stmt->bind_param("si", $date_commande, $id_client);
    if ($stmt->execute()) {
        $id_commande = $stmt->insert_id; // Récupération de l'ID de la commande créée

        // Traitement des articles commandés
        $total = 0;
        foreach ($_POST['id_jouet'] as $index => $id_jouet) {
            $quantite = $_POST['quantite'][$index];

            // Récupération du prix unitaire du jouet
            $prix_stmt = $conn->prepare("SELECT Prix FROM jouet WHERE ID_Jouet = ?");
            $prix_stmt->bind_param("i", $id_jouet);
            $prix_stmt->execute();
            $prix_result = $prix_stmt->get_result();
            $prix_row = $prix_result->fetch_assoc();
            $prix_unitaire = $prix_row['Prix'];

            // Calcul du montant pour cet article
            $montant = $prix_unitaire * $quantite;
            $total += $montant;

            // Insertion dans la table `detail_commande`
            $detail_stmt = $conn->prepare("INSERT INTO details_commande (ID_Commande, ID_Jouet, Quantite) VALUES (?, ?, ?)");
            $detail_stmt->bind_param("iii", $id_commande, $id_jouet, $quantite);
            $detail_stmt->execute();
        }

        // Mise à jour du total dans la commande
        $update_stmt = $conn->prepare("UPDATE commande SET Total = ? WHERE ID_Commande = ?");
        $update_stmt->bind_param("di", $total, $id_commande);
        $update_stmt->execute();

        echo "<p style='color:green;'>Commande ajoutée avec succès. Total : " . number_format($total, 2) . " €</p>";
        header("Location: liste.php");
        exit();
    } else {
        echo "<p style='color:red;'>Erreur lors de l'ajout de la commande.</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Commande</title>
    <link rel="stylesheet" href="../style.css">
    <script>
        function ajouterJouet() {
            var container = document.getElementById("jouets-container");
            var index = container.children.length;

            var div = document.createElement("div");
            div.classList.add("jouet-entry");

            div.innerHTML = `
                <label>Jouet :</label>
                <select name="id_jouet[]" required>
                    <?php foreach ($jouets as $jouet) { ?>
                        <option value="<?php echo $jouet['ID_Jouet']; ?>" data-prix="<?php echo $jouet['Prix']; ?>">
                            <?php echo htmlspecialchars($jouet['Nom']) . " - " . number_format($jouet['Prix'], 2) . " €"; ?>
                        </option>
                    <?php } ?>
                </select>

                <label>Quantité :</label>
                <input type="number" name="quantite[]" min="1" required>
                <button type="button" onclick="this.parentNode.remove()">Supprimer</button>
            `;
            container.appendChild(div);
        }
    </script>
</head>
<body>
    <?php include "../base/nav.php"; ?>

    <h1>Ajouter une Commande</h1>

    <div class="form-container">
        <form method="POST">
            <label>Date de commande :</label>
            <input type="date" name="date_commande" required>

            <label>Client :</label>
            <select name="id_client" required>
                <option value="">Sélectionner un client</option>
                <?php foreach ($clients as $client) { ?>
                    <option value="<?php echo $client['ID_Client']; ?>">
                        <?php echo htmlspecialchars($client['Prenom'])  . " " . htmlspecialchars($client['Nom']); ?>
                    </option>
                <?php } ?>
            </select>

            <h2>Jouets commandés</h2>
            <div id="jouets-container">
                <div class="jouet-entry">
                    <label>Jouet :</label>
                    <select name="id_jouet[]" required>
                        <?php foreach ($jouets as $jouet) { ?>
                            <option value="<?php echo $jouet['ID_Jouet']; ?>" data-prix="<?php echo $jouet['Prix']; ?>">
                                <?php echo htmlspecialchars($jouet['Nom']) . " - " . number_format($jouet['Prix'], 2) . " €"; ?>
                            </option>
                        <?php } ?>
                    </select>

                    <label>Quantité :</label>
                    <input type="number" name="quantite[]" min="1" required>
                    <button type="button" onclick="this.parentNode.remove()">Supprimer</button>
                </div>
            </div>

            <button style="background-color:#41dc54;" type="button" onclick="ajouterJouet()">Ajouter un Jouet</button>
            <button type="submit">Ajouter Commande</button>
            <a class='edit-btn-cancel' href="liste.php">Annuler</a>
        </form>
    </div>
</body>
</html>
