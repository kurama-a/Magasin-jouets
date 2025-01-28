<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des fournisseurs</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <?php include "../base/nav.php"; ?>  

    <h1>Liste des fournisseurs</h1>

    <div class="table-container">  
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../db.php";

                $result = $conn->query("SELECT * FROM FOURNISSEUR");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['ID_Fournisseur']}</td>
                        <td>{$row['Nom']}</td>
                        <td>{$row['Adresse']}</td>
                        <td>{$row['Telephone']}</td>
                        <td>{$row['Email']}</td>                        
                        <td><a class='edit-btn' href='modifier.php?id={$row['ID_Fournisseur']}'>Modifier</a></td>
                        <td><a class='delete-btn' href='supprimer.php?id={$row['ID_Fournisseur']}'>Supprimer</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- Bouton pour ajouter un jouet -->
        <div class="button-container">
            <a class="add-btn" href="ajouter.php">Ajouter un fournisseur</a>
        </div>
    </div>
</body>
</html>
