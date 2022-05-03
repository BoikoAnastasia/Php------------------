<?php //не работает
require_once 'login.php';
$connection = new mysqli ($hm, $un, $pw, $db);

if($connection->connect_error) die("Fatal Error");

$query = "SELECT * FROM classics";
$result = $connection->query($query);

if(!$result) die ("Fatal Error");
$rows = $result->num_rows;

for($j=0; $j<$rows; ++$j){
{
    $row = $result->fetch_array(MYSQLI_ASSOC);

    echo 'Author: ' .htmlspecialchars($row['author']) . '<br>';
    echo 'Titles: ' .htmlspecialchars($row['titles']) . '<br>';
    echo 'Category: ' .htmlspecialchars($row['category']) . '<br>';
    echo 'Year: ' .htmlspecialchars($row['year']) . '<br>';
    echo 'ISBN: ' .htmlspecialchars($row['isbn']) . '<br>';
}
$result->close();
$connection->close();
?>