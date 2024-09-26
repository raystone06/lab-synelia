<?php

$host = 'db';

$dbname = 'lab_db';

$username = 'root';

$password = 'rootpassword';


// Connexion à la base de données

$conn = new mysqli($host, $username, $password, $dbname);


// Vérifiez la connexion

if ($conn->connect_error) {

  die("Échec de la connexion : " . $conn->connect_error);

}


// Vérifier si le formulaire est soumis

if (isset($_POST['ajouter'])) {

  // Récupérer les valeurs soumises dans le formulaire

  $nom = $_POST['nom'];

  $numero = $_POST['numero'];


  // Vérifier que les champs ne sont pas vides

  if (!empty($nom) && !empty($numero)) {

    // Préparer une requête SQL pour insérer les données

    $requeteInsertion = $conn->prepare("INSERT INTO contacts (nom, numero) VALUES (?, ?)");

    $requeteInsertion->bind_param("ss", $nom, $numero); // "ss" signifie que les deux paramètres sont des chaînes


    // Exécuter la requête pour insérer les données dans la table

    if ($requeteInsertion->execute()) {

      echo "Contact ajouté avec succès.";

    } else {

      echo "Erreur lors de l'ajout du contact : " . $conn->error;

    }


    // Fermer la requête préparée

    $requeteInsertion->close();

  } else {

    echo "Veuillez remplir tous les champs.";

  }

}
?>


<!DOCTYPE html>

<html data-theme="dark" lang="fr">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Ajouter un contact</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.purple.min.css">

</head>

<body>

<main>

<h1>Ajouter un contact</h1>

<!-- Formulaire pour ajouter un contact -->

<form method="post" action="index.php">

  <label for="nom">Nom :</label>

  <input type="text" name="nom" id="nom" required>

  <br>

  <label for="numero">Numéro :</label>

  <input type="text" name="numero" id="numero" required>

  <br>

  <button type="submit" name="ajouter">Ajouter</button>

</form>

</main>

</body>

</html>

<?php
// Fermer la connexion à la base de données

$conn->close();

?>



