
<?php require_once "controllerUserData.php";

// session_start();
if (isset($_SESSION['email'])) {
    session_destroy();
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    }

    header('Location: Loginpage_login.php');
}
// session_destroy();
// echo $_SESSION;
// header("Loction: Loginpage_login.php");

?>

