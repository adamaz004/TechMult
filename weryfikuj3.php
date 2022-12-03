<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mazurkiewicz</title>
<?php
session_start();
?>
</HEAD>
<BODY>
<?php
if(isset($_SESSION['num_login_fail']))
{
  if($_SESSION['num_login_fail'] == 1)
   {
     if(time() - $_SESSION['last_login_time'] < 1*60*60 ) 
      {
       	 $dataSession = $_SESSION['last_login_time'];
         $data = date('Y/m/d H:i:s', $dataSession);
         echo "<span style='color: red;'>Blokada: Spróbuj za chwilę</span><br>";
       	 echo "Ostatnia próba logowania: " . $data;
         $ip = $_SERVER["REMOTE_ADDR"];
       	 $connect = mysqli_connect(localhost, adamazpl_z4, Marchewka0987, adamazpl_z4);
       	 if(!$connect) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }
         $sql = "INSERT INTO break_ins (ip) VALUES ('$ip');";
         if (mysqli_query($connect, $sql)) {}; // tu powinno być zabezpieczenie ale już trudno
         mysqli_close($connect);
         header('Refresh: 3; URL=index3.php');
         exit();
      }
      else
      {
         $_SESSION['num_login_fail'] = 0;
      }
   }      
}

$user=$_POST['user']; // login z formularza
$user = htmlentities ($user, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
$pass=$_POST['pass']; // hasło z formularza
$pass = htmlentities ($pass, ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $pass
$link = mysqli_connect(localhost, adamazpl_z4, Marchewka0987, adamazpl_z4); // połączenie z BD – wpisać swoje dane
if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } // obsługa błędu połączenia z BD
mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$result = mysqli_query($link, "SELECT * FROM users WHERE username='$user'"); // wiersza, w którym login=login z formularza
$rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD
if(!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
{
mysqli_close($link); // zamknięcie połączenia z BD
echo "Brak użytkownika o takim loginie !"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów
$_SESSION['num_login_fail'] = 1;
$_SESSION['last_login_time'] = time();
header('Refresh: 3; URL=index3.php');
exit();
}
else
{ // jeśli $rekord istnieje
if($rekord['password']==$pass) // czy hasło zgadza się z BD
{
$_SESSION ['loggedin'] = true;
echo "Logowanie Ok. User: {$rekord['username']}. Hasło: {$rekord['password']}";
$_SESSION['num_login_fail'] = 0;
$_SESSION['confirm'] = 1;
$_SESSION['user'] = $user;
$_SESSION['path'] = "";
// dodatkowe zabezpieczenie przed nieutworzeniem folderu np gdy użytkownik został dodany przez bazę danych
$userdir = "media/" . $user;
if (!file_exists($userdir)) {
mkdir($userdir, 0777, true);
}
header('Refresh: 3; URL=save_login.php');
exit();
}
else
{
mysqli_close($link);
echo "Błąd w haśle !"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów
$_SESSION['num_login_fail'] = 1;
$_SESSION['last_login_time'] = time();
header('Refresh: 3; URL=index3.php');
exit();
}
}
?>
</BODY>
</HTML>