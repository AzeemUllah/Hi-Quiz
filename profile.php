<?php 
	session_start();
	
	
include "./api/config.php";

	$name = "";
	$email = "";
	$id = "";
	$admin = "";
	$phone = "";
	$address = "";
	$gender = "";
	$dob = "";
	$active = "";

$sql = "";
if(isset($_GET['id'])){
	$sql = "SELECT * from user where user_id=" . $_GET["id"];
}else{
	$sql = "SELECT * from user where user_id=" . $_SESSION["id"];
}
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$name = $row["username"];
			$email = $row["user_email"];
			$id = $row["user_id"];
			$admin = $row["is_admin"];
			$phone = $row["phone"];
			$address = $row["address"];
			$gender = $row["gender"];
			$dob = $row["dob"];
			$active = $row["active"];
		}
	}else{
		echo '<script>alert("No such user exists"); window.location = \'./profile.php\' </script>';
	}


    $isFollowing = false;

	if(isset($_GET['id']) && $_GET['id'] != $_SESSION['id']){
        $sql = "SELECT * FROM `follow_friends` WHERE `user_id` = " . $_SESSION['id'];
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['follow_id'] == $_GET['id']){
                    $isFollowing = true;
                }
            }
        }else{
            $isFollowing = false;
        }
    }



	
?>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <title>Profile - Hi-Quiz</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/select2.min.css" type="text/css">
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="main-wrapper">
           
		   <?php include 'header.php'; ?>
		   
           <?php include 'sidebar.php'; ?>
            
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">My Profile</h4>
						</div>

						<div class="col-sm-4 text-right m-b-30">


                            <!-- only admin can have this -->
                            <?php
                            if(isset($_GET['id'])) {
                                if ($_SESSION['admin'] == "1" && $_GET['id'] != $_SESSION['id'] && $admin == "0") { ?>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm rounded dropdown-toggle" href="#"
                                           data-toggle="dropdown" aria-expanded="false">
                                            <?php
                                            if ($active == "1") {
                                                echo '<i class="fa fa-dot-circle-o text-success"></i> Active <i class="caret"></i>';
                                            } else {
                                                echo '<i class="fa fa-dot-circle-o text-danger"></i> Deactive <i class="caret"></i>';
                                            }
                                            ?>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a onclick="activateUser(<?php echo $_GET['id']; ?>);"><i
                                                            class="fa fa-dot-circle-o text-success"></i> Active</a></li>
                                            <li><a onclick="deactivateUser(<?php echo $_GET['id']; ?>);"><i
                                                            class="fa fa-dot-circle-o text-danger"></i> Deactive </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php
                                }
                            }
                            ?>









							<a href="edit-profile.php" class="btn btn-primary rounded"><i class="fa fa-plus"></i> Edit Profile</a>
						</div>
					</div>
					<div class="card-box">
						<div class="row">
							<div class="col-md-12">
								<div class="profile-view">
									<div class="profile-img-wrap">
										<div class="profile-img">
											<a href="#"><img class="avatar" src="images/user.jpg" alt=""></a>
										</div>
									</div>
									<div class="profile-basic">
										<div class="row">
											<div class="col-md-5">
												<div class="profile-info-left">
													<h3 class="user-name m-t-0 m-b-0"><?php echo $name; ?></h3>
													<small class="text-muted"> &nbsp  </small>
													<div class="staff-id">  &nbsp </div>

                                                    <?php

                                                        if(isset($_GET['id'])){
                                                            if($_GET['id'] != $_SESSION['id'] && $_SESSION['admin'] == "0"){
                                                                $text = "Follow";
                                                                $textCode = "0";
                                                                if($isFollowing == true){
                                                                    $text = "Unfollow";
                                                                    $textCode = "1";
                                                                }

                                                                echo '<div class="staff-msg"><a onclick="followUnfollow('.$_GET['id'].', '.$textCode.')" class="btn btn-custom">'.$text.'</a></div>';
                                                            }
                                                        }

                                                    ?>



                                                </div>
											</div>
											<div class="col-md-7">
												<ul class="personal-info">
													<li>
														<span class="title">Phone:</span>
														<span class="text"><a href="#"><?php echo $phone;?></a></span>
													</li>
													<li>
														<span class="title">Email:</span>
														<span class="text"><a href="#"><?php echo $email; ?></a></span>
													</li>
													<li>
														<span class="title">Date of Birth:</span>
														<span class="text"><?php echo $dob; ?></span>
													</li>
													<li>
														<span class="title">Address:</span>
														<span class="text"><?php echo $address; ?></span>
													</li>
													<li>
														<span class="title">Gender:</span>
														<span class="text"><?php echo $gender; ?></span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

                </div>

            </div>
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="js/select2.min.js"></script>
		<script type="text/javascript" src="js/moment.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
    
        <script>
            function activateUser(id) {
                $.ajax({
                    url: "api/activateUser.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data) {
                            if(data == "1"){
                                <?php if(isset($_GET['id'])){
                                echo 'window.location.replace("./profile.php?id='.$_GET['id'].'");';
                            }?>
                            }
                            else{
                                console.log(data);
                                alert("Error!");
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    }
                });
            }

            function deactivateUser(id) {
                $.ajax({
                    url: "api/deactivateUser.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data) {
                            if(data == "1"){
                                <?php if(isset($_GET['id'])){
                                echo 'window.location.replace("./profile.php?id='.$_GET['id'].'");';
                            }?>
                            }
                            else{
                                console.log(data);
                                alert("Error!");
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    }
                });
            }
            
            function followUnfollow(id,code) {
                $.ajax({
                    url: "api/followUnfollow.php",
                    type: "POST",
                    data: {
                        code: code,
                        id: id
                    },
                    success: function (data) {
                        if (data) {
                            if(data == "1"){
                                <?php if(isset($_GET['id'])){
                                    echo 'window.location.replace("./profile.php?id='.$_GET['id'].'");';
                            }?>
                            }
                            else{
                                console.log(data);
                                alert("Error!");
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    }
                });
            }
            
        </script>
    
    
    </body>

<!-- Mirrored from dreamguys.co.in/hrms/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Feb 2018 20:50:25 GMT -->
</html>