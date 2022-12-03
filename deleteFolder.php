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
$folder = $_POST['folder'];
$user = $_SESSION['user'];
$userdir = "media/" . $user . "/" . $folder;
// sprawdzenie czy nie zawiera czegos -> alert
// usuniecie z bazy
// usuniecie z dysku

$dbhost="localhost"; $dbuser="adamazpl_z4"; $dbpassword="Marchewka0987"; $dbname="adamazpl_z4";
$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
if (!$connection)
{
echo " MySQL Connection error." . PHP_EOL;
echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
echo "Error: " . mysqli_connect_error() . PHP_EOL;
exit;
}
$result = mysqli_query($connection, "SELECT * FROM uploads WHERE parent='".$folder."'");
$rekord = mysqli_fetch_array($result);
//echo "Total rows: " . $rekord[0];
if($rekord[0] == NULL) //Jeśli brak danych
{
  echo "brak<br>";
  echo $folder;
  if (file_exists($userdir)) { rmdir($userdir); }
  $deletion = mysqli_query($connection, "DELETE FROM uploads WHERE realName =  '".$folder."'"); // nienawidzę sql/php
  mysqli_close($connection);
  header('Location: index4.php');
  exit();
} else {
  echo '<script>alert("Folder zawiera pliki")</script>';
  mysqli_close($connection);
  header('Refresh: 1; URL=index4.php');
  exit();
}
?>