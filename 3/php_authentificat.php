<?php
$connect = new mysqli("localhost", "root", "mysql", 'library');

if($connect->connect_error) die("Fatal Error");

if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
{
    $un_temp = mysql_entities_fix_string($connect, $_SERVER['PHP_AUTH_USER']);
    $pw_temp = mysql_entities_fix_string($connect, $_SERVER['PHP_AUTH_PW']);
    $query = "SELECT * FROM users WHERE username = '$un_temp' and password_user = '$pw_temp'";
    $result = $connect->query($query);

if(!$result) die("User not found");
elseif($result->num_rows){
    $row = $result->fetch_array(MYSQLI_NUM);

    $result->close();

    if($pw_temp === $row[3]) echo
        htmlspecialchars("$row[0] $row[1] : 
        Hi $row[0], you are now  logger in as '$row[2]'");
    else die("Incorrect password 1");    
}
else die ("Incorrect password 2");  
}
else{
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    die("Please, enter username and password");
}
$connect->close();

function mysql_entities_fix_string($connect, $string){
    if(get_magic_quotes_gpc()) $string = stripcslashes($string);
        return $connect->real_escape_string($string);
    }
?>