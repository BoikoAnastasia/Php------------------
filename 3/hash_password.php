<?php //332
$connect = new mysqli("localhost", "root", "mysql", 'library');

if($connect->connect_error) die("Fatal Error");


if(isset($_POST['username'])&& isset($_POST['password_user']))
{
    $forename = get_post($connect, 'forename');
    $surname = get_post($connect, 'surname');
    $username = get_post($connect, 'username');
    $password_user = get_post($connect, 'password_user');
    
    // $password_user = password_hash($password_user, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users (forename, surname, username, password_user)
    VALUES ('$forename', '$surname', '$username', '$password_user')";
    // echo "password_user - 3" . $password_user  . "<br>";
    $result = $connect->query($query);
    if(!$result) die("Fatal Error BD");
    else die("Успешно!");
}

echo <<< _END
<form action="hash_password.php" method="post"><pre>
Forename <input type="text" name="forename">
Surname <input type="text" name="surname">
Username <input type="text" name="username">
Password <input type="text" name="password_user">
<input type="submit" value="Registration">
</pre>
</form>
_END;

$connect->close();

function get_post($connect, $var){
    return $connect->real_escape_string($_POST[$var]);
}

// не работает!
// function add_user($connect, $fn, $sn, $un, $pw){
//     $stml = $connect->prepare('INSERT INTO usersHash VALUES(?,?,?,?)');
//     $stml->bind_param('ssss', $fn, $sn, $un, $pw);
//     $stml->execute();
//     $stml->close();
// }

?>