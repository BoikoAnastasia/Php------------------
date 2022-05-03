<?php 
require_once 'login.php';
$conn = new mysqli($hm, $un, $pw, $db);

if ($conn->connect_error) die ("Fatal Error");

if (isset($_POST['delete']) && isset($_POST['isbn']))
{
    $isbn = get_post($conn, 'isbn');
    $query = "DELETE FROM classics WHERE isbn='$isbn'";
    $result = $conn->query($query);
    if(!$result) echo "Сбой при удалении данных <br>";
}
if (isset($_POST['author']) &&
isset($_POST['titles']) &&
isset($_POST['category']) &&
isset($_POST['year']) &&
isset($_POST['isbn']))
{
    $author = get_post($conn, 'author');
    $titles = get_post($conn, 'titles');
    $category = get_post($conn, 'category');
    $year = get_post($conn, 'year');
    $isbn = get_post($conn,'isbn');
    
    $query = "INSERT INTO classics (author, titles, category, year, isbn)
     VALUES ('$author', '$titles', '$category', '$year', '$isbn')";
    $result = $conn->query($query);
    if(!$result) echo "Сбой при вставке данных <br>";
}

echo <<< _END
<form action="newusersql.php" method="post"><pre>
Author <input type="text" name="author">
Titles <input type="text" name="titles">
Category <input type="text" name="category">
Year <input type="text" name="year">
Isbn <input type="text" name="isbn">
<input type="submit" value="Add value">
</pre></form>
_END;

$query = "SELECT * FROM classics";
$result = $conn->query($query);
if(!$result) die ("Сбой при доступе к БД");

$rows = $result->num_rows;

for($j=0; $j< $rows; ++$j)
{
    $row = $result-> fetch_array(MYSQLI_NUM);

    $r1 = htmlspecialchars($row[1]);
    $r2 = htmlspecialchars($row[2]);
    $r3 = htmlspecialchars($row[3]);
    $r4 = htmlspecialchars($row[4]);
    $r5 = htmlspecialchars($row[5]);

    echo <<< _END
    <pre>
        Author $r1
        Titles $r2
        Category $r3
        Year $r4
        Isbn $r5
    </pre>
    <form action = 'newusersql.php' method='post'>
    <input type="hidden" name="delete" value="yes">
    <input type="hidden" name="isbn" value="$r5">
    <input type="submit" value="delete"></form>
_END;
}

$result->close();
$conn->close();

function get_post($conn, $var){
    return $conn->real_escape_string($_POST[$var]);
}
?>