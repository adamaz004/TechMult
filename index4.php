<?php 
declare(strict_types=1); // włączenie typowania zmiennych w PHP >=7
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
$loguser = $_SESSION['user'];
if (!isset($_SESSION['loggedin']))
{
header('Location: index3.php');
exit();
}
  echo "Zalogowany!<br>";
  echo "Witaj " . $loguser . "<br>";
?>
<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Mazurkiewicz</title>
      	<script>
          	document.cookie = "js_var_value = " + localStorage.value;
          	function showRecords() {
              	if (document.getElementById("log").style.display == "block") {
                  	document.getElementById("log").style.display = "none";
                } else {
                  	document.getElementById("log").style.display = "block";
                }
            }
          	function buttonAddFolder() {
              	document.getElementById("divUpload").style.display = "none";
              	document.getElementById("divAddFolder").style.display = "block";
            }
          	function buttonUpload() {
              	document.getElementById("divAddFolder").style.display = "none";
              	document.getElementById("divUpload").style.display = "block";
            }
      	</script>
        <style>
          	a:link { text-decoration: none; color: black; }
			a:visited { text-decoration: none; color: black; }
			a:hover { text-decoration: none; color: red; }
          	a:active { text-decoration: none; color: black; }
            #tabelka {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
            }
            #tabelka td, #tabelka th {
                border: 1px solid #ddd;
                padding: 8px;
            }
            #tabelka tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            #tabelka tr:hover {
                background-color: #ddd;
            }
            #tabelka th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: center;
                background-color: #04AA6D;
                color: white;
            }
          	#log {
              	display: none;
          	}
          	.mods {
              	width: 100%;
              	height: 40px;
          	}
          	#tableFile {
              	font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
          	}
          	#tableFile td, #tableFile th {
                border: 1px solid #ddd;
                padding: 8px;
            }
          	img, video {
                max-width: 200px;
                max-height: 200px;
                height: auto;
                width: auto;
            }
            audio {
                width: 200px;
            }
        </style>
    </head>
    <body>
      	<br><a href='logout.php'>Wyloguj</a><br><br>
      
      	<div class="mods">
            <div id="divAddFolder" style="display: none;">
                <form method="post" action="addFolder.php">
                Nowy folder: <input type="text" name="folderName" id="folderName">
                <input type="submit" value="Stwórz"/>
                </form>
            </div>
          	<div id="divUpload" style="display: none;">
                <form action="uploadFile.php" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Dodaj"/>
                </form>
            </div>
      	</div>
      
          <div style="float: left;"><button><img onclick="buttonAddFolder()" src="media/addFolder.png" style="height: auto; width: 30px;"></button></div>
          <div style="float: left;"><form method="post" action="sourceFolder.php">
              <button type="submit"><img src="media/backFolder.png" style="height: auto; width: 30px;"></button>
          </form></div>
      	  	<div>
              <button><img onclick="buttonUpload()" src="media/upload.png" style="height: auto; width: 30px;"></button>
              <span><?php echo "  " . $_SESSION['path']; ?></span><br>
      		</div><br>
             
      	
      	
          <?php
            $link = mysqli_connect(localhost, adamazpl_z4, Marchewka0987, adamazpl_z4);
            if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }
            $result = mysqli_query($link,"SELECT * FROM uploads");
      		echo "<table id='tableFile'>
                  <tr>
                    <th>Ikona</th>
                    <th>Nazwa</th>
                    <th>Data dodania</th>
                    <th style='border: 0px;'></th>
                  </tr>";
            while($row = mysqli_fetch_array($result))
            {
              if($row['user'] == $loguser && $row['parent'] == $_SESSION['path']) {
              echo "<tr>";
              echo "<td>" . $row['icon'] . "</td>";
              echo "<td>" . $row['name'] . "</td>";
              echo "<td>" . $row['date'] . "</td>";
              echo "<td>" . $row['deletion'] . "</td>";
              echo "</tr>";
              }
            }
            mysqli_close($link);
      		echo "</table>";
            ?>
      
      	<br><button onclick='showRecords()'>Historia logowania</button><br><br>
      	<div id="log">
        <table id="tabelka">
            <tr>
                <th>Data</th>
                <th>Adres IP</th>
                <th>Lokalizacja</th>
                <th>Współrzędne</th>
                <th>Mapy</th>
                <th>Przeglądarka</th>
                <th>Ekran</th>
                <th>Okno</th>
                <th>Kolory</th>
                <th>Cookies</th>
                <th>Java</th>
                <th>Język</th>
            </tr>
            <?php
            $link = mysqli_connect(localhost, adamazpl_z4, Marchewka0987, adamazpl_z4);
            if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }
            
            function ip_details($ip) {
            $json = file_get_contents ("http://ipinfo.io/{$ip}/geo");
            $details = json_decode ($json);
            return $details;
            }
            
            $result = mysqli_query($link,"SELECT * FROM goscieportalu");
            while($row = mysqli_fetch_array($result))
            {
            echo "<tr>";
            echo "<td>" . $row['datetime'] . "</td>";
            echo "<td>" . $row['ipaddress'] . "</td>";
            $ipaddress = $row['ipaddress'];
            $details = ip_details($ipaddress);
            $loc = $details -> loc;
            echo "<td>" . $details -> country . ", " . $details -> region . ", " . $details -> city . "</td>";
            echo "<td>" . $loc . "</td>";
            echo "<td>" . "<a href='https://www.google.pl/maps/place/$loc'>LINK</a>" . "</td>";
            echo "<td>" . $row['browser'] . "</td>";
            echo "<td>" . $row['screen'] . "</td>";
            echo "<td>" . $row['window'] . "</td>";
            echo "<td>" . $row['colors'] . "</td>";
            echo "<td>" . $row['cookies'] . "</td>";
            echo "<td>" . $row['java'] . "</td>";
            echo "<td>" . $row['language'] . "</td>";
            echo "</tr>";
            }
            mysqli_close($link);
            ?>
        </table>
      	</div>
    </body>
</html>