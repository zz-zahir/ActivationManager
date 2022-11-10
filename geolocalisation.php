<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require_once("vendor/autoload.php");

use KHerGe\JSON\JSON;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$mysqli = new mysqli("localhost","adminer","pk-6-pght","CTIBSerial");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$result = $mysqli -> query("SELECT adressIP FROM Serial");
$rows = $result -> fetch_all();

for($i = 0; $i < count($rows); $i++) {
    if($rows[$i][0] == '127.0.0.1') {
      continue;
    }
    $url = "https://api.ipgeolocation.io/ipgeo?apiKey=7dc9e04a3aae44ed95a78e8c83f34051&ip=". $rows[$i][0] ."&fields=city&lang=fr";  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $res = curl_exec($ch);
    
    $f = fopen("dat/dat.json", "w");
    fwrite($f, $res);
    $json = new JSON();
    $decoded = $json->decodeFile('dat/dat.json');
    $mysqli -> query("UPDATE Serial SET geolocalisation = '" . $decoded->city . "' WHERE adressIP = '" . $rows[$i][0] . "'");
    curl_close($ch);
    fclose($f);
}
    unlink("dat/dat.json");
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/index.php");
?>