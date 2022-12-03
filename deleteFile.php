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

$parent = $_SESSION['path'];
$file = $_POST['file'];
$user = $_SESSION['user'];
$userdir = "media/" . $user . "/" . $file;
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
$result = mysqli_query($connection, "DELETE FROM uploads WHERE realName='".$file."' AND parent='".$parent."'");
$deletion = unlink($userdir);
mysqli_close($connection);
header('Location: index4.php');
exit();

?>