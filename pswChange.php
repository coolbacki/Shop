<?php
require_once("./src/connection.php");

if (isset($_SESSION['userId']) != true)
{
    header("Location: login.php");
}


$user = User::GetUserById($_SESSION['userId']);
echo("
    <form method='POST'>

        <fieldset>
            <legend>Change password</legend>

            <p>
                <label>Old password
                    <input type='password' name='oldpassword'>
                </label>
            </p>
            <p>
                <label>New password
                    <input type='password' name='password1'>
                </label>
            </p>
            <p>
                <label>Repeat new password:
                    <input type='password' name='password2'>
                </label>
            </p>
            <p>
                <input type='submit' value='Change'>
            </p>

        </fieldset>
    </form>
    ");


if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $user->changePassword(($_POST['oldpassword']), ($_POST['password1']), ($_POST['password2']));//check
}