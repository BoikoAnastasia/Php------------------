<?php 
require_once 'login.php';
$conn = new mysqli($hm, $un, $pw, $db);
if($conn->connect_error) die ("Fatal Error");

$query = "CREATE TABLE cats(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    family VARCHAR(32) NOT NULL,
    name_animal VARCHAR(32) NOT NULL,
    age INT NOT NULL
)";

$result = $conn->query($query);
if(!$result) die ("Сбой при доступе к БД");
else die("Успешно!");
$conn->close();
?>