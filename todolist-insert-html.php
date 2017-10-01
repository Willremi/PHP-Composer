<?php

require('vendor/autoload.php');
require('todolist-connect.php');

$informations = [];
$errors = [];
$title = '';
$description = null;
$deadline = null;
$done = false;

if ($_POST) {
  $valid = true;

  if (isset($_POST['title']) && !empty(trim($_POST['title']))) {
    $title = $_POST['title'];
  } else {
    $valid = false;
    $errors['title'] = 'Vous devez spécifier un titre';
  }

  if (isset($_POST['description']) && !empty(trim($_POST['description']))) {
    $description = $_POST['description'];
  }

  if (isset($_POST['deadline']) && !empty(trim($_POST['deadline']))) {
    $deadline = $_POST['deadline'];
  }

  if (isset($_POST['done'])) {
    $done = true;
  }

  if ($valid) {
    try {
      $count = $conn->insert('todo', [
        'title' => $title,
        'description' => $description,
        'deadline' => $deadline,
        'done' => $done,
      ]);

      $lastInsertId = $conn->lastInsertId();
    } catch (Exception $e) {
      // echo $e->getMessage();
      header('Location: error500.html', true, 302);
      exit();
    }

    $informations['form'] = $count . ' tâche créée (id : ' . $lastInsertId . ')';
  }
}

require('header.php');
?>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div>
        <a class="btn btn-primary" href="todolist-select-html.php">Retour à la liste des tâches</a>
      </div>

      <h1>Création d'une tâche</h1>

      <div>
        <?php
        if (isset($informations['form'])) {
          echo $informations['form'];
        }
        ?>
      </div>

      <form action="<?= basename(__FILE__) ?>" method="post">

        <div>
          <?php
          if (isset($errors['title'])) {
            echo $errors['title'];
          }
          ?>
        </div>
        <input type="text" name="title" value="<?= htmlentities($title) ?>" placeholder="titre" /> *<br />

        <input type="text" name="description" value="<?= htmlentities($description) ?>" placeholder="description" /><br />

        <input type="datetime" name="deadline" value="<?= htmlentities($deadline) ?>" placeholder="date limite" /><br />

        <input type="checkbox" name="done" value="1" <?php if ($done) { echo 'checked'; } ?> /><br />

        <input type="submit" value="valider" class="btn btn-success" /><br />

      </form>
    </div><!-- /.col-xs-12 -->
  </div><!-- /.row -->
</div><!-- /.container -->
<?php
require('footer.php');
