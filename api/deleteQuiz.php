<?php
include "config.php";
session_start();

$sql = "DELETE FROM `quiz` WHERE `quiz`.`quiz_id` = " . $_POST['id'];

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
