<?php 

$username = "admin";
$password = "1111";

if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
{
    if($_SERVER['PHP_AUTH_USER'] === $username &&
     $_SERVER['PHP_AUTH_PW'] === $password)
     {
        echo "Hello, admin!";
    }
    else{
        echo "User: " . htmlspecialchars($_SERVER['PHP_AUTH_USER']) . "<br>" .
        "Password: " . htmlspecialchars($_SERVER['PHP_AUTH_PW']);
    }
}
else
{
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    die("Please, enter username and password");
}

?>