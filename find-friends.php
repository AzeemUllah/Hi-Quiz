<?php
session_start();
?>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <title>Find Friends - Hi Quiz</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/select2.min.css" type="text/css">
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
		<!--[if lt IE 9]>
			<script src="js/html5shiv.min.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
        <div class="main-wrapper">
            <?php include 'header.php'; ?>

            <?php include 'sidebar.php'; ?>

            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Users</h4>
						</div>

					</div>
					<div class="row filter-row">
                           <div class="col-sm-9 col-xs-9">
								<div class="form-group form-focus">
									<label class="control-label">User Name</label>
									<input id="searchTxtb" type="text" class="form-control floating" />
								</div>
                           </div>
                           <div class="col-sm-3 col-xs-6">  
                                <a onclick="searchUser()" class="btn btn-success btn-block"> Search </a>
                           </div>     
                    </div>
					<div id="usersInjector" class="row staff-grid-row">









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
        $( document ).ready(function() {
            $.ajax({
                url: "api/getUsers.php",
                type: "POST",
                dataType: 'json',
                data: {

                },
                success: function (data) {
                    if (data) {
                        if(data == "0"){
                            alert("No Users");
                        }
                        else{
                            $("#usersInjector").html(data);
                        }
                    }
                },
                error: function (request, status, error) {
                    $("#usersInjector").html(request.responseText);
                }

            });


        });

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
                            window.location.replace("./find-friends.php");
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
                            window.location.replace("./find-friends.php");
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
                            window.location.replace("./find-friends.php");
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

        function searchUser() {
            $.ajax({
                url: "api/searchUser.php",
                type: "POST",
                data: {
                    query: $("#searchTxtb").val()
                },
                success: function (data) {
                    if (data) {
                        if(data == "0"){
                            alert("No Users");
                        }
                        else{
                            $("#usersInjector").html(data);
                        }
                    }
                },
                error: function (xhr, status, error) {
                    $("#usersInjector").html(request.responseText);
                }
            });
        }


    </script>
    </body>

</html>