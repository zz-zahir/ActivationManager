<?php

require_once("config.php");

$mysqli = new mysqli($db_host,$db_username, $db_password, $db_name);

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

require_once("vendor/autoload.php");
use Shuchkin\SimpleXLSX;

if(isset($_POST['submit'])) {
    if (is_uploaded_file($_FILES['uploadfile']['tmp_name'])) {
        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], '/var/www/uploads/'.$_FILES['uploadfile']['name'])) {
            echo "Fichier uploadé.<br />";
            
            $excelFile = '/var/www/uploads/'.$_FILES['uploadfile']['name'];
            if ( $xlsx = SimpleXLSX::parse($excelFile) ) {
//                echo count($xlsx->rows());
                for($i = 1; $i < count($xlsx->rows()); $i++ ) {
                    $code = strval($xlsx->rows()[$i][0]);
                    $etat = $xlsx->rows()[$i][1];
                    $mysqli -> query("INSERT INTO Serial (code) VALUES ('{$code}')");
                }
            }
        } else {
            echo "Erreur de deplacement du fichier!<br />";
        }    
    } else {
        echo "Erreur d'upload du fichier!<br />";
    }
} else {
    echo "Erreur de submit du fichier!<br />!";
}

$host  = $_SERVER['HTTP_HOST'];
header("Location: http://".$host."/index.php");

?>