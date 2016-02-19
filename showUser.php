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



    if($userToShow->getId() === $_SESSION['userId'])
    {
        echo("
        <h3>New tweet:</h3>
        <form action='showUser.php' method='post'>
            <input type='text' name='tweet_text'>
            <input type='submit'>
        </form>
        ");
    }

    foreach($userToShow->loadAllTweets() as $tweet)
    {
        echo("<a href ='showTweet.php?id={$tweet->getId()}'>{$tweet->getTweetBody()}</a><br>");
        echo("{$tweet->getPostDate()}<br>");
        $commentsNumber = count($tweet->getAllComments());
        echo("Comments: $commentsNumber <br>");
        echo("<a href='editTweet.php?id={$tweet->getId()}'> Edit</a><br>");
        echo("<a href='deleteTweet.php?id={$tweet->getId()}'> Delete</a><br>");
    }
}
else
{
    echo("User doesn't exist.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    if(isset($_POST['tweet_text']) && strlen(trim($_POST['tweet_text'])) > 0)
    {
        $idUser = $_SESSION['userId'];
        $tweetBody = $_POST['tweet_text'];
        $tweet = Tweet::CreateTweet($idUser, $tweetBody);

    }
    else
    {
        echo("We couldn't save your tweet");
    }
}