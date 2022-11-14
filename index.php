<?php

require_once("config.php");

$mysqli = new mysqli($db_host,$db_username, $db_password, $db_name);

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$result = $mysqli -> query("SELECT id, code, etat, dateActivation, adressIP, geolocalisation, icon FROM Serial ORDER BY id DESC");

$duplique = $mysqli -> query("SELECT COUNT(code), code, id FROM Serial GROUP BY code HAVING COUNT(code) > 1");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!--<meta http-equiv="refresh" content="5">-->
  <meta charset="utf-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity=
  "sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Tableau</title>
</head>
<body>
  <div class="container">
    <form action="index.php" method="post" class="row" style="margin: 15px; border: 1px black solid; margin: 10px;">
      <div class="col">
        <input type="text" name="recherche" placeholder="recherche" style="width: 200px; margin: 15px;">
        <?php
          if(isset($_POST['recherche'])) {
          $result = $mysqli -> query("SELECT id, code, etat, dateActivation, adressIP, geolocalisation, icon FROM Serial WHERE code LIKE '%" . $_POST['recherche'] . "%' ORDER BY id DESC");
          }
          ?>
      </div>
      <div class="col">
        <input type="submit" value="recherche" class="btn btn-secondary" style="margin: 15px;">
      </div>
    </form>
    <form action="desactive.php" method="post" class="row" style="margin: 15px; border: 1px black solid; margin: 10px;">
      <div class="col">
        <input type="text" name="codeADesactive" placeholder="clé a rendre non-active" style="width: 200px; margin: 15px;">
        <?php
            if(isset($_GET['code'])) {
                echo "<h4 class='desactive-form'>La clé " . $_GET['code'] . " à etait desactivé</h4>";
              }
          ?>
      </div>
      <div class="col">
        <input type="submit" value="desactivé" class="btn btn-secondary" style="margin: 15px;">
      </div>
    </form>
    <form enctype="multipart/form-data" action="upload.php" method="post" class="row" style=
    "margin: 15px; border: 1px black solid; margin: 10px;">
      <div class="col">
        <input name="uploadfile" type="file" style="margin: 15px;">
      </div>
      <div class="col">
        <input type="submit" value="Upload" name="submit" class="btn btn-secondary" style="margin: 15px;">
      </div>
    </form>
    <div class="row" style="border: 1px black solid; margin: 10px;">
      <div class="col">
        <h3>Geolocaliser</h3>
      </div>
      <div class="col">
        <a href="geolocalisation.php" class="btn btn-secondary" style="margin: 15px;">GEOLOCALISE</a>
      </div>
    </div>
    <div class="row" style="margin: 15px; border: 1px black solid; margin: 10px;">
      <h3 class="col" style="margin: 15px;">les dupliques</h3>
      <div class="col">
        <?php
                $res = $duplique -> fetch_all();
                for($i = 0; $i < count($res); $i++) {
                echo "<p>". $res[$i][1] ."</p>";
                }
              ?>
      </div>
    </div>
    <div class="row" style="margin: 15px;">
      <div class="col">
        <a href="index.php" class="btn btn-info" style="margin-left: 15px; margin: 15px;">Rafraichir</a>
      </div>
    </div>
  </div>
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity=
  "sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity=
  "sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>