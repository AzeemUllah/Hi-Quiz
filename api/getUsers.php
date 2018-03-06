<?php
include "config.php";
session_start();

$sql = "SELECT * FROM `user` where is_admin = 0 and user_id != " . $_SESSION['id'];
$result = $conn->query($sql);
$toReturn = "";

$conn2 = new mysqli("localhost", "root", "", "hi-quiz");


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $toReturn .= "<div class='col-md-4 col-sm-4 col-xs-6 col-lg-3'>
                        <div class='profile-widget'>
                            <div class='profile-img'>
                                <a href='profile.html'><img class='avatar' src='images/user.jpg' alt=''></a>
                            </div>";

                    if($_SESSION['admin'] == 1) {
                        $toReturn .= "<div class='dropdown profile-action'>
                                <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                                <ul class='dropdown-menu pull-right'>
                                    <li><a href='#' data-toggle='modal' data-target='#edit_employee'><i class='fa fa-pencil m-r-5'></i> Edit</a></li>
                                    <li><a href='#' data-toggle='modal' data-target='#delete_employee'><i class='fa fa-trash-o m-r-5'></i> Delete</a></li>
                                </ul>
                            </div>";
                    }

        $sql2 = "SELECT * FROM `follow_friends` where user_id = " . $_SESSION['id'] . " and follow_id = " . $row['user_id'];
        $result2 = $conn2->query($sql2);
        if ($result2->num_rows > 0) {

            $toReturn .="<h4 class='user-name m-t-10 m-b-0 text-ellipsis'><a href='profile.html'>John Doe</a></h4>
                            <a onclick='followUnfollow(".$row['user_id'].", 1)' style='border-radius: 18px !important; padding: 0px 7px !important; margin-top: 5px !important;' class='btn btn-custom'>UnFollow</a>
                        </div>
                    </div>";

        }
        else{
            $toReturn .="<h4 class='user-name m-t-10 m-b-0 text-ellipsis'><a href='profile.html'>John Doe</a></h4>
                            <a onclick='followUnfollow(".$row['user_id'].", 0)' style='border-radius: 18px !important; padding: 0px 7px !important; margin-top: 5px !important;' class='btn btn-custom'>Follow</a>
                        </div>
                    </div>";
        }
    }
} else {
    $toReturn = 0;
}

echo $toReturn;
$conn->close();
?>






