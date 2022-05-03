<?php 
require_once 'login.php';
$conn = new mysqli ($hm, $un, $pw, $db);
if($conn->connect_error) die ("Fatal Error");

$query = "DESCRIBE cats";
$result = $conn->query($query);
if(!$result) die ("Fatal Error BD");

$rows = $result->num_rows;

echo "<table><tr> <th>Column</th> <th>Type</th><th>Null</th> <th>Key</th> </tr>";

for($j=0;$j<$rows;++$j){

    $row = $result->fetch_array(MYSQLI_NUM);

    echo "<tr>";
    for($i=0;$i<4;++$i){
        echo "<td>" . htmlspecialchars($row[$i]) . "</td>";
        
    }
    echo "</tr>";
}
echo "</table>";


// обновление данных
$query = "UPDATE cats SET name_animal='Ярик' WHERE id=1";
$result = $conn->query($query);
if(!$result) die ("Fatal Error BD");



// вывод данных из таблицы
$query = "SELECT * FROM cats";
$result = $conn->query($query);
if(!$result) die ("Fatal Error BD");

$rows = $result->num_rows;
    echo "<table><tr> <th>Id</th> <th>Family</th> <th>Name</th> <th>Age</th> </tr>";
    
    for($j=0;$j<$rows;++$j){
        $row = $result->fetch_array(MYSQLI_NUM);
        echo "<tr>";
        for($i=0;$i<4;++$i){
            echo "<td>" . htmlspecialchars($row[$i]) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    

?>