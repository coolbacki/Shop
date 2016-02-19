<?php
session_start();
require_once(dirname(__FILE__) . "/config.php");
require_once(dirname(__FILE__) . "/User.php");
require_once(dirname(__FILE__) . "/Item.php.php");

$conn = new mysqli($servername, $username, $password, $basename);
if ($conn->connect_errno) {
    die("Polaczenie nieudane. blad " . $conn->connect_error);
}

Item::SetConnection($conn);
User::SetConnection($conn);



require_once(dirname(__FILE__) . "/head.php");
/*if (isset($_SESSION['userId'])){ //pasek zalogowanego uzytkownika
    $onlineUser = User::GetUserById($_SESSION['userId']);
}*/
?>



