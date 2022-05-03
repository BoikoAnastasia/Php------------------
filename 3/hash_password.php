<?php 
$connect = new mysqli("localhost", "root", "mysql", 'library');

if($connect->connect_error) die("Fatal Error");

// $query = "CREATE TABLE users (
//     forename VARCHAR(32) NOT NULL,
//     surname VARCHAR(32) NOT NULL,
//     username VARCHAR(32) NOT NULL UNIQUE,
//     password_user VARCHAR(32) NOT NULL
// )";

// $result = $connect->query($query);
// if(!$result) die("Fatal Error BD");
// else die("Успешно!");

$forename = 'Bill';
$surname = 'Smith';
$username = 'bsmith';
$password_user = 'mysecret';
$hash = password_hash($password_user, PASSWORD_DEFAULT);

add_user($connect, $forename, $surname, $username, $hash);

$forename = 'Pauline';
$surname = 'Jones';
$username = 'pjones';
$password_user = 'acrobat';
$hash = password_hash($password_user, PASSWORD_DEFAULT);

add_user($connect, $forename, $surname, $username, $hash);

function add_user($connect, $fn, $sn, $un, $pw){
    $stml = $connect->prepare('INSERT INTO users (forename, surname, username, password_user) VALUES(?,?,?,?)');
    $stml->bind_param('ssss', $fn, $sn, $un, $pw);
    $stml->execute();
    $stml->close();
}

?>