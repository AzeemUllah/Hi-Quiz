<?php
include "config.php";
session_start();

$sql = "UPDATE `user` SET `username` = '".$_POST['name']."', `user_email` = '".$_POST['email']."', 
`phone` = '".$_POST['phoneNumber']."', 
`address` = '".$_POST['address']."', `gender` = '".$_POST['gender']."', `dob` = '".$_POST['birthDate']."' WHERE `user`.`user_id` = " . $_SESSION['id'];

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>





