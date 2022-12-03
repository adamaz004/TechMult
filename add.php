<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mazurkiewicz</title>
</HEAD>
<BODY>
<?php
$user=$_POST['user']; // login z formularza
$user = htmlentities ($user, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
$pass=$_POST['pass']; // hasło z formularza
$pass = htmlentities ($pass, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $pass
$pass2=$_POST['pass2']; // hasło z formularza
$pass2 = htmlentities ($pass2, ENT_QUOTES, "UTF-8");
$link = mysqli_connect(localhost, adamazpl_z4, Marchewka0987, adamazpl_z4); // połączenie z BD – wpisać swoje dane
if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } // obsługa błędu połączenia z BD
  
if(strcmp($pass, $pass2) == 0) { // kiedy się zgadzają
  	$sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass');";
  	if(mysqli_query($link, $sql) && $user != "" && $pass != "") {
      	echo "Dodano nowego użytkownika!";
      	mysqli_close($link);
      
      	//# z4 dodanie folderu uzytkownika
      	$userdir = "media/" . $user;
      	if (!file_exists($userdir)) {
    	mkdir($userdir, 0777, true);
		}
      	
      
      	header('Refresh: 3; URL=index3.php');
		exit();
    } else {
      	echo "Błąd przy dodawaniu użytkownika";
     	mysqli_close($link);
      	header('Refresh: 3; URL=rejestruj.php');
		exit();
    }
} else {
  	mysqli_close($link);
  	echo "Hasła nie są takie same";
	header('Refresh: 3; URL=rejestruj.php');
	exit();
}
?>
</BODY>
</HTML>