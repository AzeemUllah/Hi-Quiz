<?php
include "config.php";
session_start();

$sql = '';

if($_SESSION['admin'] == '0') {
    $sql = "SELECT * FROM `user` WHERE username like '%".$_POST['query']."%' and is_admin = 0 and user_id != " . $_SESSION['id'] . " and active = 1";
}
else{
    $sql = "SELECT * FROM `user` WHERE username like '%".$_POST['query']."%' and is_admin = 0 and user_id != " . $_SESSION['id'];
}

$result = $conn->query($sql);
$toReturn = "";

$conn2 = new mysqli("localhost", "root", "", "hi-quiz");


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $toReturn .= "<div class='col-md-4 col-sm-4 col-xs-6 col-lg-3'>
                        <div class='profile-widget'>
                            <div class='profile-img'>
                                <a href='profile.php?id=".$row['user_id']."'><img class='avatar' src='".$row['user_pic']."' alt=''></a>
                            </div>";

        if($_SESSION['admin'] == 1) {
            $toReturn .= "<div class='dropdown profile-action'>
                                <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                                <ul class='dropdown-menu pull-right'>";

            if($row['active'] == 1){
                $toReturn .= "<li><a onclick='deactivateUser(".$row['user_id'].")' data-toggle='modal' data-target='#edit_employee'><i class='fa fa-pencil m-r-5'></i> Deactivate </a></li>";
            }
            else{
                $toReturn .= "<li><a onclick='activateUser(".$row['user_id'].")' data-toggle='modal' data-target='#edit_employee'><i class='fa fa-pencil m-r-5'></i> Activate </a></li>";
            }

            $toReturn .= "
                                </ul>
                            </div>";
        }


        $sql2 = "SELECT * FROM `follow_friends` where user_id = " . $_SESSION['id'] . " and follow_id = " . $row['user_id'];
        $result2 = $conn2->query($sql2);
        if ($result2->num_rows > 0) {

            $toReturn .="<h4 class='user-name m-t-10 m-b-0 text-ellipsis'><a href='profile.html'>".$row['username']."</a></h4>
                            <a onclick='followUnfollow(".$row['user_id'].", 1)' style='border-radius: 18px !important; padding: 0px 7px !important; margin-top: 5px !important;' class='btn btn-custom'>UnFollow</a>
                        ";

        }
        else{
            $toReturn .="<h4 class='user-name m-t-10 m-b-0 text-ellipsis'><a href='profile.html'>".$row['username']."</a></h4>
                            <a onclick='followUnfollow(".$row['user_id'].", 0)' style='border-radius: 18px !important; padding: 0px 7px !important; margin-top: 5px !important;' class='btn btn-custom'>Follow</a>
                       ";
        }

        $toReturn .= " </div>
                    </div>";
    }
} else {
    $toReturn = "No users found.";
}

echo $toReturn;
$conn->close();
?>






