<?php
include "config.php";
session_start();
	
$sql = "SELECT * from user where user_email = '". $_POST["email"] ."' and password ='". $_POST["password"] ."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		$_SESSION["name"] = $row["username"];
		$_SESSION["email"] = $row["user_email"];
		$_SESSION["id"] = $row["user_id"];
		$_SESSION["admin"] = $row["is_admin"];
		$_SESSION["phone"] = $row["phone"];
		$_SESSION["address"] = $row["address"];
		$_SESSION["gender"] = $row["gender"];
		$_SESSION["dob"] = $row["dob"];
    }
	echo 1;
} else {
   echo 0;
}
$conn->close();
?>
