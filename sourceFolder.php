<?php 
declare(strict_types=1); // włączenie typowania zmiennych w PHP >=7
session_start();
if (!isset($_SESSION['loggedin']))
{
header('Location: index3.php');
exit();
} else {
$_SESSION['path'] = "";
header('Location: index4.php');
exit();
}
?>