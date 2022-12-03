<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
header('Content-Type: text/html; charset=utf-8');
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku

if (!isset($_SESSION['loggedin']) && !isset($_POST['folderName']))
{
header('Location: index3.php');
exit();
}

//$_SESSION['path'];
$folderName = $_POST['folderName'];
$user = $_SESSION['user'];
if($_SESSION['path'] != "") {
  $userdir = "media/" . $user . "/" . $_SESSION['path'];
} else {
  $userdir = "media/" . $user;
}
$newFolder = $userdir . "/" . $folderName;

if (!file_exists($newFolder)) {
    mkdir($newFolder, 0777, true);
}  

// dotąd dobrze jest 
  
$dbhost="localhost"; $dbuser="adamazpl_z4"; $dbpassword="Marchewka0987"; $dbname="adamazpl_z4";
$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
if (!$connection)
{
echo " MySQL Connection error." . PHP_EOL;
echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
echo "Error: " . mysqli_connect_error() . PHP_EOL;
exit;
}

  $icon = '<img src="media/folder.png" style="height: auto; width: 30px;">';
  $deletion = '<form method="post" action="deleteFolder.php">
                    <button type="submit">
                        <img src="media/delete.png" style="height: auto; width: 30px;">
                    </button>
                    <input style="display: none;" type="text" name="folder" id="folder" value="' . $folderName . '">
                </form>';
  $parent = $_SESSION['path'];
		echo $user . " :user<br>";
		echo $icon . " :icon<br>";
		echo $folderName . " :folderName<br>";
		echo $deletion . " :deletion<br>";
		echo $parent . " :parent<br>";
  $folderNameDir = '<form method="post" action="changePath.php">
                    <button style="background-color: transparent;
                      background-repeat: no-repeat;
                      border: none;
                      cursor: pointer;
                      overflow: hidden;
                      outline: none;" type="submit">
                        <span style="color: purple;">' . $folderName . '</span>
                    </button>
                    <input style="display: none;" type="text" name="destination" id="destination" value="' . $folderName . '">
                	</form>';
  $sql = "INSERT INTO uploads (user, icon, name, realName, deletion, parent) 
  					   VALUES ('$user','$icon','$folderNameDir','$folderName','$deletion','$parent');";
  $result = mysqli_query($connection, $sql) or die ("DB error: $dbname");
  if(!$result) {echo "dupa";}
  mysqli_close($connection);
	header('Location: index4.php');
	exit();
?>