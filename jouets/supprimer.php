<?php
include "../db.php"; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sécuriser l'ID en le convertissant en entier

    // Requête SQL pour supprimer le jouet
    $sql = "DELETE FROM jouet WHERE ID_Jouet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirection vers la liste après suppression
        header("Location: /Projet_magasin/jouets/liste.php?message=deleted");
        exit();
    } else {
        echo "Erreur lors de la suppression : " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID invalide.";
}
?>
