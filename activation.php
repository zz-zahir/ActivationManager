<?php

require_once("config.php");

if(isset($_POST['serial'])) {
  $serial = $_POST['serial'];
} else {
    die("Problem avec POST");
}

if(isset($_SERVER['REMOTE_ADDR'])) {
  $ip = $_SERVER['REMOTE_ADDR'];
} 

$mysqli = new mysqli($db_host,$db_username, $db_password, $db_name);

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

// Return name of current default database
$result = $mysqli -> query("SELECT code FROM Serial WHERE code = '" . $serial . "'" );
if(!$result) {
  echo "Problem";
} else {
  $resultActive1 = $mysqli -> query("SELECT code, etat FROM Serial WHERE code = '" . $serial . "' AND etat = 'active'");
  if($resultActive1) {
    $rows = $resultActive1 -> fetch_all();
    if ($rows[0][1] == 'active') {
      die("cette clé est deja utilisé!");
    } else {
      $result1 = $mysqli -> query("UPDATE Serial SET etat = 'active' WHERE code = '" . $serial . "'");
      $result2 = $mysqli -> query("UPDATE Serial SET adressIP = '". $ip ."' WHERE code = '" . $serial . "'");
      $result3 = $mysqli -> query("UPDATE Serial SET dateActivation = '" . date('d/m/Y') . "' WHERE code = '" . $serial . "'");
      $result4 = $mysqli -> query("UPDATE Serial SET icon = 'i/correct.png' WHERE code = '" . $serial . "'");
    }
} else {
  echo "Problem";
}
}

?>
