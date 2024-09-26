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


// Vérifiez si un contact doit être supprimé

if (isset($_GET['supprimer'])) {

  $id = $_GET['supprimer'];


  // Préparer une requête SQL pour supprimer le contact

  $requeteSuppression = $conn->prepare("DELETE FROM contacts WHERE id = ?");

  $requeteSuppression->bind_param("i", $id); // "i" signifie que le paramètre est un entier


  // Exécuter la requête pour supprimer le contact

  if ($requeteSuppression->execute()) {

    echo "Contact supprimé avec succès.";

  } else {

    echo "Erreur lors de la suppression du contact : " . $conn->error;

  }


  // Fermer la requête préparée

  $requeteSuppression->close();

}


// Récupérer tous les contacts de la base de données

$resultat = $conn->query("SELECT * FROM contacts");


?>


<!DOCTYPE html>

<html data-theme="dark" lang="fr">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Liste des contacts</title>
   <link rel="stylesheet" 
   href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.purple.min.css" >

</head>

<body>

<main>

<h1>Liste des contacts</h1>


<table>

  <thead data-theme="light">

    <tr>

      <th>Nom</th>

      <th>Numéro</th>

      <th>Action</th>

    </tr>

  </thead>

  <tbody>

    <?php

    // Vérifier si des contacts sont disponibles

    if ($resultat->num_rows > 0) {

      // Afficher chaque contact dans une ligne du tableau

      while ($row = $resultat->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . htmlspecialchars($row['nom']) . "</td>";

        echo "<td>" . htmlspecialchars($row['numero']) . "</td>";

        echo "<td><a href='?supprimer=" . $row['id'] . "' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?');\">Supprimer</a></td>";

        echo "</tr>";

      }

    } else {

      echo "<tr><td colspan='3'>Aucun contact trouvé.</td></tr>";

    }


    // Fermer le résultat

    $resultat->close();

    ?>

  </tbody>

</table>

</main>


<!-- Fermer la connexion à la base de données -->

<?php

$conn->close();

?>


</body>

</html>



