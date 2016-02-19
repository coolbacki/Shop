<?php
require_once ("./src/connection.php");
if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $user = User::LogInUser($_POST['email'], $_POST['password']);
    if($user != false)
    {
        $_SESSION['userId'] = $user->getId();
        header("Location: showUser.php");
    }
    else
    {
        echo("Log in failed. Wrong email or password. Try again.");
    }
}
?>

<form action="login.php" method="post">
    <lable>
        email:
        <input type="email" name="email">
    </lable>
    <br>
    <label>
        password:
        <input type="password" name="password">
    </label>
    <br>
    <lable>
        <input type="submit" value="Log in">
    </lable>
</form>