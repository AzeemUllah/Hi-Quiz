<?php 
session_start();
$_SESSION['id'] = null;
?>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <title>Login - Hi-Quiz</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="main-wrapper">
			<div class="account-page">
				<div class="container">
					<h3 class="account-title">User Login</h3>
					<div class="account-box">
						<div class="account-wrapper">
							<div class="account-logo">
								<a href="index-2.html"><img src="images/logo2.png" alt="Focus Technologies"></a>
							</div>
							<form>
								<div class="form-group form-focus">
									<label class="control-label">Email</label>
									<input id=email class="form-control floating" type="text">
								</div>
								<div class="form-group form-focus">
									<label class="control-label">Password</label>
									<input id=password class="form-control floating" type="password">
								</div>
								<div class="form-group text-center">
									<button id=submit class="btn btn-primary btn-block account-btn" type="button">Login</button>
								</div>
								<div class="text-center">
									<a href="forgot-password.html">Forgot your password?</a>
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
        <script type="text/javascript" src="js/app.js"></script>
		
		<script>


		$("#submit").click(function(){
			$.ajax({
					url: "api/login.php",
					type: "POST",
					data: {
						email: $("#email").val(),
						password: $("#password").val()
					},
					success: function (data) {
						if (data) {
							if(data == "1"){
								window.location.replace("./profile.php");
							}
							else{
								console.log(data);
								alert("Invalid Password");
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