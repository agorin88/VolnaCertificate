<?php
if (!isset($_GET['page'])) {
    $page = 'main';
} else {
    $page = addslashes(strip_tags(trim($_GET['page'])));
}
?>
<?php session_start(); ?>
<?php
//cookie css switcher goes here
$default = 'default.css'; // define stylesheets
$darkcss = 'dark.css';
$lightcss = 'light.css';

$expire = time() + 60 * 60 * 24 * 30; // how long to remember css choice (60*60*24*30 = 30 days)

if ((isset($_GET['css'])) && ($_GET['css'] == $lightcss)) { // set cookie for light css
    $_SESSION['css'] = $_GET['css'];
    setcookie('css', $_GET['css'], $expire);
}

if ((isset($_GET['css'])) && ($_GET['css'] == $darkcss)) { // set cookie for dark css
    $_SESSION['css'] = $_GET['css'];
    setcookie('css', $_GET['css'], $expire);
}

if ((isset($_GET['css'])) && ($_GET['css'] == $default)) { // set cookie for default css
    $_SESSION['css'] = $_GET['css'];
    setcookie('css', $_GET['css'], $expire);
}

if (isset($_COOKIE['css'])) { // check for css stored in cookie
    $savedcss = $_COOKIE['css'];
} else {
    $savedcss = $default;
}

if ($_SESSION['css']) { // use session css else use cookie css
    $css = $_SESSION['css'];
} else {
    $css = $savedcss;
}
// the filename of the stylesheet is now stored in $css
echo '<link rel="stylesheet" href="/css/' . $css . '">';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--<link href="css/bootstrap.css" rel="stylesheet"> switch off for cookie css switcher-->
    <link href="css/normalize.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/hover-min.css"/>
    <link href="css/style.css" rel="stylesheet">
    <title>Certificate</title>
    <meta name="generator" content="Bootply"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
<?php
include('core.php');
include ('core/nav.php');
?>
<div class="center-block fnone content">
    <div id="queryRes"></div>
    <?php
    include('pages/' . $page . '.php');
    ?>
</div>
<button onclick="goBack()" class="btn-primary back-button fleft"><span class="fa fa-arrow-circle-o-down"></span>
    Назад
</button>

<div class="footer"><a href="http://agorin.ru">Горин Андрей</a> для ООО "Волна К" &copy; 2015</div>
<!-- "go back" script -->
<script src="js/back.js"></script>
<script src="js/pagination.js"></script>
<script src="js/alert.js"></script>
<!-- simple search script -->
<script src="js/search.js"></script>


</body>
</html>