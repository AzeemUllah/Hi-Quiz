<?php
include "config.php";
session_start();

$sql = "UPDATE `user` SET `active` = b'1' WHERE `user`.`user_id` = " . $_POST['id'];

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "0";
}

$conn->close();
?>
