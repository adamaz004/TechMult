<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
header('Content-Type: text/html; charset=utf-8');
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku

$user = $_SESSION['user'];
if($_SESSION['path'] != "") {
  $userdir = "media/" . $user . "/" . $_SESSION['path'];
} else {
  $userdir = "media/" . $user;
}


$target_file = $userdir . "/". basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file already exists
if (file_exists($target_file)) { echo "Sorry, file already exists."; $uploadOk = 0; }
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) { echo "Sorry, your file is too large."; $uploadOk = 0; }
// Autorskie instrukcje korygujące format wyświetlania
$source = "";
// img
if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) {
  	$source = "<img src=\"" . $target_file . "\">";
// audio
} else if($imageFileType == "mp3") {
  	$source = "<audio controls><source src=\"" . $target_file . "\" type=\"audio/mp3\"><a href=\"" . $target_file . "\">Download audio</a></audio>";
// video
} else if($imageFileType == "mp4") {
  	$source = "<video controls muted><source src=\"" . $target_file . "\" type=\"video/mp4\"><a href=\"" . $target_file . "\">Download the video</a></video>";
} else {
	$source = '<img src="media/file.png" style="height: auto; width: 30px;">';
}



if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
{ echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded."; }
else { echo "Sorry, there was an error uploading your file."; }

$dbhost="localhost"; $dbuser="adamazpl_z4"; $dbpassword="Marchewka0987"; $dbname="adamazpl_z4";
$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
if (!$connection)
{
echo " MySQL Connection error." . PHP_EOL;
echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
echo "Error: " . mysqli_connect_error() . PHP_EOL;
exit;
}

	$folderName = $_FILES["fileToUpload"]["name"];
	$folderNameSource = $userdir . "/" . $folderName;
	$folderNameDir = '<a href="'.$folderNameSource.'">'.$folderName.'</a>';
	$deletion = '<form method="post" action="deleteFile.php">
                    <button type="submit">
                        <img src="media/delete.png" style="height: auto; width: 30px;">
                    </button>
                    <input style="display: none;" type="text" name="file" id="file" value="' . $folderName . '">
                </form>';
	$parent = $_SESSION['path'];

  $sql = "INSERT INTO uploads (user, icon, name, realName, deletion, parent) 
  					   VALUES ('$user','$source','$folderNameDir','$folderName','$deletion','$parent');";
  $result = mysqli_query($connection, $sql) or die ("DB error: $dbname");
  if(!$result) {echo "dupa";}
  mysqli_close($connection);
	header('Location: index4.php');
	exit();





?>