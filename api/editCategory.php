<?php
include "config.php";
session_start();

$sql = "UPDATE `category` SET `cat_name` = '".$_POST["categoryName"]."', `cat_topic` = '".$_POST["categoryDesc"]."' WHERE `category`.`cat_id` = ".$_POST["id"].";";

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "0";
}

$conn->close();
?>
