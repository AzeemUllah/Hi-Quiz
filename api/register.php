<?php
include "config.php";
session_start();

$sql = "INSERT INTO `user` (`user_id`, `username`, `user_email`, `password`, `is_admin`) VALUES (NULL, '".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["password"]."', '1');";

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
