<?php
require_once 'login.php';
$conn = new mysqli($hm, $un, $pw, $db);

if ($conn->connect_error) die ("Fatal Error");

if(isset($_POST['delete']) && isset($_POST['name_animal']))
{
    $name_animal = get_post($conn, 'name_animal');
    $query = "DELETE FROM cats WHERE name_animal='$name_animal'";
    $result = $conn->query($query);
    if(!$result) echo "Сбой при удалении данных <br>";
    else echo "Успешно удалено! <br>"; 
}

if(isset($_POST['family']) &&
isset($_POST['name_animal']) &&
isset($_POST['age'])) // проверка заполненности полей
{
    $family = get_post($conn, 'family');
    $name_animal = get_post($conn, 'name_animal');
    $age = get_post($conn, 'age');

    $query = "INSERT INTO cats (family, name_animal, age) 
    VALUES ('$family', '$name_animal', '$age')";
    $result = $conn->query($query);
    if(!$result) echo "Сбой при вставке данных <br>";
    else echo "Успешно вставлено! <br>"; 
}

echo <<< _END
<form action="addAnimal.php" method="post"><pre>
Family <input type="text" name="family">
Name animal <input type="text" name="name_animal">
Age <input type="text" name="age">
<input type="submit" value="add animal">
</pre>
</form>
_END;

$query = "SELECT * FROM cats"; // запрос на выдачу всех записей
$result = $conn->query($query);
if(!$result) echo "Сбой при доступе к БД <br>";
// else echo "Успешно! <br>"; 

$rows = $result->num_rows; // присваивание rows значение = кол-ву строк в таблице
for($j=0; $j< $rows; ++$j){
    $row = $result-> fetch_array(MYSQLI_NUM); // возвращение числового массива

    $r1 = htmlspecialchars($row[1]);
    $r2 = htmlspecialchars($row[2]);
    $r3 = htmlspecialchars($row[3]);

    echo <<< _END
    <pre>
    Family: $r1
    Name: $r2
    Age: $r3
    </pre>
    <form action = 'addAnimal.php' method='post'>
    <input type="hidden" name="delete" value="yes">
    <input type="hidden" name="name_animal" value="$r2">
    <input type="submit" value="delete"></form>
    _END;
}
$result->close();
$conn->close();



function get_post($conn, $var){ // извлечение данных из браузера
    return $conn->real_escape_string($_POST[$var]);
}
?>