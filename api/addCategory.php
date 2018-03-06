<?php
include "config.php";
session_start();

$sql = "INSERT INTO `category` (`cat_id`, `cat_name`, `cat_topic`) VALUES (NULL, '".$_POST['categoryName']."', '".$_POST['categoryDesc']."');";

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
