<?php
$servername = "localhost";
$username = "root";  // Change selon ton serveur
$password = "";
$database = "magasinjouets";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
?>
