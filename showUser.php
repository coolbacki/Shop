<?php
require_once ("./src/connection.php");

if(isset($_SESSION['userId']) != true)
{
    header("location: login.php");
}

if(isset($_GET["userId"])){
    $userId = $_GET["userId"];
}
else
{
    $userId = $_SESSION['userId'];
}

$userToShow = User::GetUserById($userId);

if($userToShow != false)
{
    echo("<a href='logOut.php'>Log out</a><br>");
    echo("<h1>{$userToShow->getName()}</h1>");
    echo("{$userToShow->getAddress()}<br>");
    echo("<a href='addressChange.php'>Edit address</a><br>");
    echo("<a href='pswChange.php'>Password change</a><br>");
    echo("<a href='showAllOrders.php?id={$userId}'>Orders</a><br>");
    echo("<a href='showAllMsg.php'>Show messages</a><br>");



    foreach($userToShow->loadAllOrders() as $order)
    {
        echo("<a href ='xxxx.php?id={$order->getId()}'>{$order->getTweetBody()}</a><br>");
        echo("{$order->getPostDate()}<br>");

    }
}
else
{
    echo("User doesn't exist.");
}
