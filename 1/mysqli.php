<?php //поэлементное извлечение результатов
require_once 'login.php';
$connection = new mysqli ($hm, $un, $pw, $db);

if($connection->connect_error) die ('Fatal Error');

$query = "SELECT * FROM classics";
$result = $connection->query($query);

if(!$result) die ("Fatal Error");
$rows = $result->num_rows;

for($j=0;$j<$rows;$j++){
    $result->data_seek($j);
    echo 'Author: ' .htmlspecialchars($result->fetch_assoc()['author']) . '<br>';
    $result->data_seek($j);
    echo 'Titles: ' .htmlspecialchars($result->fetch_assoc()['titles']) . '<br>';
    $result->data_seek($j);
    echo 'Category: ' .htmlspecialchars($result->fetch_assoc()['category']) . '<br>';
    $result->data_seek($j);
    echo 'Year: ' .htmlspecialchars($result->fetch_assoc()['year']) . '<br>';
    $result->data_seek($j);
    echo 'ISBN: ' .htmlspecialchars($result->fetch_assoc()['isbn']) . '<br>';
}
$result->close();
$connection->close();
?>