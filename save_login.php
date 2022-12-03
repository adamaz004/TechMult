<script>
  //ciasteczka
  document.cookie = "js_var_value = " + localStorage.value;
  //skrypt na sprawdzenie przeglądarki i jej wersji
  var browser = '';
  var browserVersion = 0;
  if (/Opera[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Opera';
  } else if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
    browser = 'Explorer';
  } else if (/Navigator[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Netscape';
  } else if (/Chrome[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Chrome';
    //dopisane przeze mnie, bo operę gx i edge łapało jako chrome
    if (/OPR[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
      browser = 'Opera';
    }
	if (/Edg[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
      browser = 'Edge';
    }
  } else if (/Safari[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Safari';
    /Version[\/\s](\d+\.\d+)/.test(navigator.userAgent);
    browserVersion = new Number(RegExp.$1);
  } else if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Firefox';
  }
  if(browserVersion === 0){
    browserVersion = parseFloat(new Number(RegExp.$1));
  }
    var br = browser;
    var brv = browserVersion;
    var scrw = screen.width;
    var scrh = screen.height;
    var scraw = screen.availWidth;
    var scrah = screen.availHeight;
    var scrcolor = screen.colorDepth;
    var cookies = navigator.cookieEnabled;
    var java = navigator.javaEnabled();
    var lang = navigator.language;
    
    var pbrowser = br + ' ' + brv + ' | ';
    var pscreen = scrw + 'x' + scrh;
    var pwindow = scraw + 'x' + scrah;
  
  	//ciasteczka
  	document.cookie = "browser = " + pbrowser;
    document.cookie = "screen = " + pscreen;
    document.cookie = "window = " + pwindow;
    document.cookie = "colors = " + scrcolor;
    document.cookie = "cookies = " + cookies;
    document.cookie = "java = " + java;
    document.cookie = "language = " + lang;
</script>
<?php
//sesja dzięki czemu nie można wejść bezpośrednio
session_start();
$php_var_val= $_COOKIE['js_var_value'];
if (isset($_SESSION['confirm']))
{
//autorski skrypt żeby ciasteczka działały
if (!isset($_SESSION['repeat'])) {
  $_SESSION['repeat'] = 1;
  echo "Przetwarzam...";
  header('Refresh: 1; URL=save_login.php'); // tutaj nie zmieniłem i straciłem na tym 30 minut + 15 min z powodu papierosa
  exit();
}
//skrypt na wykrywanie systemu operacyjnego
$user_agent = $_SERVER['HTTP_USER_AGENT'];
function getOS() { 
    global $user_agent;
    $os_platform  = "Unknown OS Platform";
    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );
    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;
    return $os_platform;
}
$user_os = getOS();
//połączenie z bazą i dodanie rekordu
$link = mysqli_connect(localhost, adamazpl_z4, Marchewka0987, adamazpl_z4);
if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }
mysqli_query($link, "SET NAMES 'utf8'");
$ip = $_SERVER["REMOTE_ADDR"];
$browser = $_COOKIE['browser'] . " " . $user_os;
$screen = $_COOKIE['screen'];
$window = $_COOKIE['window'];
$colors = $_COOKIE['colors'];
$cookies = $_COOKIE['cookies'];
$java = $_COOKIE['java'];
$language = $_COOKIE['language'];
$sql = "INSERT INTO goscieportalu (ipaddress, browser, screen, window, colors, cookies, java, language)
        VALUES ('$ip','$browser','$screen','$window','$colors','$cookies','$java','$language');";
mysqli_query($link, $sql);
echo "Zapisano wejście!";
//session_unset();
mysqli_close($link);
header('Refresh: 1; URL=index4.php');
exit();
}
else
{
echo "Błąd weryfikacji!";
session_unset();
header('Refresh: 3; URL=index.php');
exit();
}
?>