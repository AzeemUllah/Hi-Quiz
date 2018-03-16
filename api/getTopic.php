<?php
include "config.php";
session_start();

$sql = "SELECT * FROM category where cat_id = " . $_POST['id'];

$result = $conn->query($sql);
$toReturn = "";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $toReturn .= $row['cat_topic'];
    }
} else {
    $toReturn = "0";
}

echo $toReturn;
$conn->close();
?>








