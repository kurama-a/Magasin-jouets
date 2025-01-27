<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste jouets</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../base/nav.php"; ?>  <!-- Inclusion du menu -->

    <h1>Liste des Jouets</h1>

    <div class="table-container">  <!-- Ajout d'un conteneur pour centrer -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Stock</th>
                    <th>Nom fournisseur</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../db.php";

                $result = $conn->query("SELECT ID_Jouet, jouet.Nom AS nom_jouet, Prix, Categorie, Stock_disponible, fournisseur.Nom as fournisseur_nom FROM jouet INNER JOIN fournisseur ON jouet.ID_Fournisseur = fournisseur.ID_Fournisseur");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['ID_Jouet']}</td>
                        <td>{$row['nom_jouet']}</td>
                        <td>{$row['Prix']} €</td>
                        <td>{$row['Categorie']}</td>
                        <td>{$row['Stock_disponible']}</td>
                        <td>{$row['fournisseur_nom']}</td>
                        <td><a class='edit-btn' href='modifier.php?id={$row['ID_Jouet']}'>Modifier</a></td>
                        <td><a class='delete-btn' href='supprimer.php?id={$row['ID_Jouet']}'>Supprimer</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Bouton pour ajouter un jouet -->
        <div class="button-container">
            <a class="add-btn" href="ajouter.php">Ajouter un Jouet</a>
        </div>
    </div>
</body>
</html>
