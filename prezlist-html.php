<?php

// Créer une base de données nommée prezlist qui stock des présentations
// Insérer-y des présentations fictives
//Une présentation possède les champs suivants :
// - titre
// - durée en minutes
// - auteur
// - date (jour seulement, pas besoin de l'heure)

// Créer une page web qui affiche la liste des présentations
require('vendor/autoload.php');
require ('prezlist-connect.php');

$sql = "SELECT * FROM presentation";
$stmt = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    nombre de lignes : <?= $stmt->rowCount(); ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Date</th>
        <th>Durée (en minutes)</th>

      </tr>
     <?php while ($row = $stmt->fetch()) {
       echo "<tr>\n";

       echo "<td>" . $row['id'] . "</td>\n";
       echo "<td>" . $row['title'] . "</td>\n";
       echo "<td>" . $row['author'] . "</td>\n";
       echo "<td>" . $row['date'] . "</td>\n";
       echo "<td>" . $row['duration'] . "</td>\n";

       echo "</tr>\n";
     }?>
    </table>
  </body>
</html>
