<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des commandes</title>
    <link rel="stylesheet" href="../style.css"> <!-- Lien vers le CSS -->
</head>
<body>
    <?php include "../base/nav.php"; ?>  <!-- Inclusion du menu -->

    <h1>Liste des Commandes</h1>

    <div class="table-container">  <!-- Conteneur pour centrer le tableau -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Client</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../db.php";

                // Jointure pour afficher le nom du client associé à chaque commande
                $result = $conn->query("
                    SELECT COMMANDE.ID_Commande, COMMANDE.Date_Commande, COMMANDE.Total, 
                           CLIENT.Nom, CLIENT.Prenom 
                    FROM COMMANDE 
                    INNER JOIN CLIENT ON COMMANDE.ID_Client = CLIENT.ID_Client
                ");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['ID_Commande']}</td>
                        <td>{$row['Date_Commande']}</td>
                        <td>{$row['Total']} €</td>
                        <td>{$row['Nom']} {$row['Prenom']}</td>
                        <td><a class='edit-btn'>Modifier</a>
                        <td><a class='delete-btn' href='supprimer.php?id={$row['ID_Commande']}'>Supprimer</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
