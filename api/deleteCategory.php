<?php
include "config.php";
session_start();

$sql = "DELETE FROM `category` WHERE `category`.`cat_id` = " . $_POST['id'];

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
