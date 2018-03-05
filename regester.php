<?php
session_start();
?>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <title>Hi-Quiz</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="css/fullcalendar.min.css" rel="stylesheet" />
		<link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/select2.min.css" type="text/css">
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" type="text/css">
		<link rel="stylesheet" href="plugins/morris/morris.css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
		
    </head>
    <body>
        
		
		<div class="main-wrapper">
          
			<div class="account-page" style="margin-bottom: 30px;">
				<div class="container">
					<h3 class="account-title">User Regestration</h3>
					<div class="account-box">
						<div class="account-wrapper">
							<div class="account-logo">
								<a href="index.php"><img src="images/logo2.png" alt="Hi-Quiz"></a>
							</div>
							<form>
								<div class="form-group form-focus">
									<label class="control-label">Username</label>
									<input id=name class="form-control floating" type="text">
								</div>
								<div class="form-group form-focus">
									<label class="control-label">Email</label>
									<input id=email class="form-control floating" type="email">
								</div>
								<div class="form-group form-focus">
									<label class="control-label">Password</label>
									<input id=password class="form-control floating" type="password">
								</div>
								<div class="form-group form-focus">
									<label class="control-label">Repeat Password</label>
									<input class="form-control floating" type="password">
								</div>
								<div class="form-group text-center">
									<button id=submit class="btn btn-primary btn-block account-btn" type="button">Register</button>
								</div>
								<div class="text-center">
									<a href="login.php">Already have an account?</a>
								</div>
							</form>
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
		<script type="text/javascript" src="plugins/morris/morris.min.js"></script>
		<script type="text/javascript" src="plugins/raphael/raphael-min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
		<script>
		$("#submit").click(function(){
			$.ajax({
					url: "api/register.php",
					type: "POST",
					data: {
						name: $("#name").val(),
						email: $("#email").val(),
						password: $("#password").val()
					},
					success: function (data) {
						if (data) {
							if(data == "1"){
								window.location.replace("./login.php");
							}
							else{
								console.log(data);
							}
						}
					},
					error: function () {
						alert("Server error.");
					}

				});
		});
		 
		
		
		</script>
    </body>
</html>