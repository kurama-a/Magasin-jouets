<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste clients</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../base/nav.php"; ?>  <!-- Inclusion du menu -->

    <h1>Liste des Clients</h1>

    <div class="table-container">  <!-- Conteneur pour centrer le tableau -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../db.php";

                $result = $conn->query("SELECT * FROM CLIENT");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['ID_Client']}</td>
                        <td>{$row['Nom']}</td>
                        <td>{$row['Prenom']}</td>
                        <td>{$row['Email']}</td>
                        <td>{$row['Adresse']}</td>
                        <td>{$row['Telephone']}</td>
                        <td><a class='edit-btn' href='modifier.php?id={$row['ID_Client']}'>Modifier</a></td>
                        <td><a class='delete-btn' href='supprimer.php?id={$row['ID_Client']}'>Supprimer</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>