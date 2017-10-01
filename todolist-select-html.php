<?php

require('vendor/autoload.php');
require('todolist-connect.php');

$done = 0;
$sql = "SELECT * FROM todo WHERE done = " . $conn->quote($done);

$stmt = $conn->query($sql);

require('header.php');
?>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div>
        <a class="btn btn-primary" href="sommaire.php">Menu</a>
        <a class="btn btn-primary" href="todolist-insert-html.php">Ajouter une nouvelle tâche</a>
      </div>

      <div>
        nombre de lignes : <?= $stmt->rowCount() ?>
      </div>

      <table class="table table-striped table-hover">
        <tr>
          <th>id</th>
          <th>titre</th>
          <th>description</th>
          <th>limite</th>
          <th>statut</th>
          <th>action</th>
        </tr>
      <?php
      while ($row = $stmt->fetch()) {
        echo "<tr>\n";

        echo "<td>" . $row['id'] . "</td>\n";
        echo "<td><a href=\"todolist-update-html.php?id=" . $row['id'] . "\">" . $row['title'] . "</a></td>\n";
        echo "<td>" . $row['description'] . "</td>\n";
        echo "<td>" . $row['deadline'] . "</td>\n";
        echo "<td>" . $row['done'] . "</td>\n";
        echo "<td>\n";
        echo "<a class=\"btn btn-primary\" href=\"todolist-update-html.php?id=" . $row['id'] . "\">éditer</a>\n";
        echo "<a class=\"btn btn-danger\" href=\"todolist-delete-html.php?id=" . $row['id'] . "\" onclick=\"return window.confirm(&quot;Voulez vraiment supprimer cet élément ?&quot;);\">supprimer</a>\n";
        echo "</td>\n";

        echo "</tr>\n";
      }
      ?>
      </table>
    </div><!-- /.col-xs-12 -->
  </div><!-- /.row -->
</div><!-- /.container -->
<?php
require('footer.php');
