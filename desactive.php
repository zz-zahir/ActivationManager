<?php

$mysqli = new mysqli("localhost","adminer","pk-6-pght","CTIBSerial");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

if(isset($_POST['codeADesactive'])) {
  $code = $_POST['codeADesactive'];
  $desactive = $mysqli -> query("UPDATE Serial SET etat = 'non-active', dateActivation = '01/01/2000', adressIP = '127.0.0.1', geolocalisation = 'internet', icon = 'i/incorrect.png' WHERE code = '" . $code . "'");
  if($desactive == true) {
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/index.php?code=" . $code);
  } elseif($desactive == false) {
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/index.php");
  }
} else {
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/index.php");    
}

?>