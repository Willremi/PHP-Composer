<?php

$date = '31/12/2017 23:50:50';

$valid = true;
$erreur = '';

$dateArray = explode(' ', $date);
var_dump($dateArray);

$dayArray = explode('/', $dateArray[0]);
var_dump($dayArray);

$timeArray = explode(':', $dateArray[1]);
var_dump($timeArray);

if (count($dayArray) != 3
  || !is_numeric($dayArray[0])
  || !is_numeric($dayArray[1])
  || !is_numeric($dayArray[2])
  || !checkdate($dayArray[1], $dayArray[0], $dayArray[2])
) {
    $valid = false;
    $erreur = 'date non valide';

    // ou
    // throw new Exception('date non valide');
}

if (count($timeArray) != 3
  || !is_numeric($timeArray[0])
  || !is_numeric($timeArray[1])
  || !is_numeric($timeArray[2])
  || $timeArray[0] >= 24
  || $timeArray[1] >= 60
  || $timeArray[2] >= 60
) {
  $valid = false;
  $erreur = 'heure non valide';

  // ou
  // throw new Exception('heure non valide');
}

if ($valid) {
  $format = 'd/m/Y H:i:s';
  $dt = DateTime::createFromFormat($format , $date, new DateTimeZone('Europe/Paris'));

  var_dump($dt);
  var_dump($dt instanceof DateTime);

  echo $dt->format('Y-m-d H:i:s'); // '2017-12-31 20:50:50'
  echo "\n";
} else {
  echo $erreur;
  echo "\n";
}
