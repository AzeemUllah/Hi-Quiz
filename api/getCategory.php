<?php
include "config.php";
session_start();
	
$sql = "SELECT * FROM `category`";
$result = $conn->query($sql);
$toReturn = "";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		$toReturn .= ""; 
    }
	echo 1;
} else {
   echo 0;
}
$conn->close();
?>
