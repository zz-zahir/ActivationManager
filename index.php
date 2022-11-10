<?php

error_reporting(-1);
ini_set('display_errors', 'On');

$mysqli = new mysqli("localhost","adminer","pk-6-pght","CTIBSerial");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

// Return name of current default database
$result = $mysqli -> query("SELECT id, code, etat, dateActivation, adressIP, geolocalisation, icon FROM Serial ORDER BY id DESC");

$duplique = $mysqli -> query("SELECT COUNT(code), code, id FROM Serial GROUP BY code HAVING COUNT(code) > 1");

//if($duplique) {
//  $duplique2 = $mysqli -> query("")
//}

?>
<!doctype html>
<html lang="en">
  <head>
    <!--<meta http-equiv="refresh" content="5">-->
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Tableau</title>
  </head>
  <body>
<div class="container">
  <table class="table table-bordered">
    <tr>
      <form action="index.php" method="POST">
      <td><input type="text" name="recherche" placeholder="recherche"></td>
      <?php
        if(isset($_POST['recherche'])) {
          $result = $mysqli -> query("SELECT id, code, etat, dateActivation, adressIP, geolocalisation, icon FROM Serial WHERE code LIKE '%" . $_POST['recherche'] . "%' ORDER BY id DESC");
        }
      ?>
      <td>
      <input type="submit" value="recherche" class="btn btn-secondary">
      </td>
    </form>
    </tr>
    <tr>
      <td>
        <form action="desactive.php" method="post">
          <input type="text" name="codeADesactive" placeholder="clé a rendre non-active">
          <?php
            if(isset($_GET['code'])) {
                echo "<h4 class='desactive-form'>La clé " . $_GET['code'] . " à etait desactivé</h4>";
              }
          ?>
      </td>
      <td>
        <input type="submit" value="desactivé" class="btn btn-secondary">
      </td>
      </form>
    <tr>
<td>
            <form enctype="multipart/form-data" action="upload.php" method="POST">
            <input name="uploadfile" type="file"/>
              </td>
            <td><input type="submit" value="Upload" name="submit" class="btn btn-secondary"/>
            
            </td>
            </form>
            
    </tr>
    <tr>
<td><h3>Geolocaliser</h3></td>
    <td>
              <a href="geolocalisation.php" class="btn btn-secondary">GEOLOCALISE</a>
            </td>

    </tr>

    <tr>
      <td><h3>les dupliques</h3></td>
    <td>
              
              <?php
                $res = $duplique -> fetch_all();
                for($i = 0; $i < count($res); $i++) {
                echo "<p>". $res[$i][1] ."</p>";
                }
              ?>
            </td>
       
    </tr>
    <tr>
        <td>
          <a href="index.php" class="btn btn-info" style="margin-left: 15px;">Rafraichir</a>
      </td>
      </tr>
  </table>

<table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Clé</th>
            <th scope="col">Etat</th>
            <th scope="col">Date Activation</th>
            <th scope="col">Adresse IP</th>
            <th scope="col">Valide</th>
            <th scope="col">Geolocalisation</th>
          </tr>
        </thead>
        <tbody>
          


          <?php
      $rows = $result -> fetch_all();
      for($i = 0; $i < count($rows); $i++) {
          echo "<tr>";
          echo "<td>" . $rows[$i][0] . "</td>";
          echo "<td>" . $rows[$i][1] . "</td>";
          echo "<td>" . $rows[$i][2] . "</td>";
          echo "<td>" . $rows[$i][3] . "</td>";
          echo "<td>" . $rows[$i][4] . "</td>";
          echo "<td><img src='" . $rows[$i][6] . "'/></td>";
          echo "<td>" . $rows[$i][5] . "</td>";
          echo "</tr>";
        }
        
      $mysqli -> close();
    ?>
        </tbody>
      </table>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>