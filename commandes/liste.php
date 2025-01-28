<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des commandes</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <?php include "../base/nav.php"; ?>  

    <h1>Liste des commandes</h1>

    <div class="table-container">  
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Client</th>
                    <th>Jouets achetés</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../db.php";

                // Jointure pour afficher les détails des commandes avec les jouets et quantités
                $result = $conn->query("SELECT COMMANDE.ID_Commande, COMMANDE.Date_Commande, COMMANDE.Total, 
                                              CLIENT.Nom, CLIENT.Prenom, 
                                              GROUP_CONCAT(CONCAT(JOUET.Nom, ' (', DETAILS_COMMANDE.Quantite, ')') SEPARATOR ', ') AS JouetsAchetes
                                       FROM COMMANDE 
                                       INNER JOIN CLIENT ON COMMANDE.ID_Client = CLIENT.ID_Client
                                       INNER JOIN DETAILS_COMMANDE ON COMMANDE.ID_Commande = DETAILS_COMMANDE.ID_Commande
                                       INNER JOIN JOUET ON DETAILS_COMMANDE.ID_Jouet = JOUET.ID_Jouet
                                       GROUP BY COMMANDE.ID_Commande");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['ID_Commande']}</td>
                        <td>{$row['Date_Commande']}</td>
                        <td>{$row['Total']} €</td>
                        <td>{$row['Nom']} {$row['Prenom']}</td>
                        <td>{$row['JouetsAchetes']}</td>
                        <td><a class='delete-btn' href='supprimer.php?id={$row['ID_Commande']}'>Supprimer</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- Bouton pour ajouter un jouet -->
        <div class="button-container">
            <a class="add-btn" href="ajouter.php">Ajouter une commande</a>
        </div>
    </div>
</body>
</html>
