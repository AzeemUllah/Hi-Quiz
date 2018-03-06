<?php
include "config.php";
session_start();

$sql = '';

if($_POST['code'] == "0"){
    // insert here
    $sql = "INSERT INTO `follow_friends` (`follow_id`, `user_id`, `status`) VALUES ('".$_POST['id']."', '".$_SESSION['id']."', NULL);";
}
else{
    // delete here
    $sql = "DELETE FROM `follow_friends` WHERE `follow_friends`.`follow_id` = ".$_POST['id']." AND `follow_friends`.`user_id` = ".$_SESSION['id']."";
}

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "0";
}

$conn->close();
?>
