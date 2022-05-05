<?php
session_start();

if(isset($_SESSION['forename']))
{
    $forename = $_SESSION['forename'];
    $surname = $_SESSION['surname'];

    echo "С возвращением, $forename . <br>
    Ваше полное имя $forename $surname . <br>";
}
else echo "Please, for aythentificate <a href='session.php'>Щелкните здесь</a>";
?>