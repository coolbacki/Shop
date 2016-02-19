<?php

require_once ("./src/connection.php");

if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $user = User::RegisterUser($_POST['name'], $_POST['email'], $_POST['password1'], $_POST['password2'], $_POST['address']);
    if($user != false)
    {
        $_SESSION['userId'] = $user->getId();
        header("Location: showUser.php");
    }
    else
    {
        echo("Registration failed. Try again.");
    }
}
?>

<form action="register.php" method="post">
    <lable>
        email:
        <input type="email" name="email">
    </lable>
    <br>
    <lable>
        name:
        <input type="text" name="name">
    </lable>
    <br>
    <label>
        password 1:
        <input type="password" name="password1">
    </label>
    <br>
    <lable>
        password 2:
        <input type="password" name="password2">
    </lable>
    <br>
    <lable>
        description:
        <input type="text" name="address">
    </lable>
    <br>
    <lable>
        <input type="submit" value="Register">
    </lable>
</form>
