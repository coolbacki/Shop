<?php
require_once("./src/connection.php");

if (isset($_SESSION['userId']) != true)
{
    header("Location: login.php");
}

$user = User::GetUserById($_SESSION['userId']);

echo("
    <form method='POST'>Edit your address:
    <p>
        <label>
            <textarea name='address' rows='4'>Type your new address</textarea>
        </label>
    </p>
    <input type='submit' value='change'>
    </form>");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $newAddress = $_POST['address'];
    $user->changeAddress($newAddress);
    header("Location: showUser.php");
}