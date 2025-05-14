<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "client";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $age = intval($_POST['age']);
    $wilaya = $conn->real_escape_string($_POST['wilaya']);
    $telephone = $conn->real_escape_string($_POST['telephone']);
    $adresse = $conn->real_escape_string($_POST['adresse']);
    $sexe = $conn->real_escape_string($_POST['sexe']);

    $sql = "INSERT INTO compte (nom, prenom, age, wilaya, telephone, adresse, sexe)
            VALUES ('$nom', '$prenom', $age, '$wilaya', '$telephone', '$adresse', '$sexe')";

    if ($conn->query($sql) === TRUE) {
        header("Location: cinquimeme.html");
        exit();
    } else {
        echo "Erreur : " . $conn->error;
    }
}

$conn->close();
?>
