<?php 
	session_start();
	?>
<html>

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <title>Profile - Hi-Quiz</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
							<h4 class="page-title">Category</h4>
						</div>
						<div class="col-sm-4 text-right m-b-30">
							<a href="#" class="btn btn-primary rounded" data-toggle="modal" data-target="#add_department"><i class="fa fa-plus"></i> Add New Category</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div>
								<table id=datatable class="table table-striped custom-table m-b-0 datatable">
									<thead>
										<tr>
											<th>#</th>
											<th>Category Name</th>
											<th>Category Desc</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody id=categoryInjector>
									
									
						
										
										
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				
				
				
				<div class="notification-box">
					<div class="msg-sidebar notifications msg-noti">
						<div class="topnav-dropdown-header">
							<span>Messages</span>
						</div>
						<div class="drop-scroll msg-list-scroll">
							<ul class="list-box">
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author">Richard Miles </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item new-message">
											<div class="list-left">
												<span class="avatar">J</span>
											</div>
											<div class="list-body">
												<span class="message-author">John Doe</span>
												<span class="message-time">1 Aug</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">T</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Tarah Shropshire </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">M</span>
											</div>
											<div class="list-body">
												<span class="message-author">Mike Litorus</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">C</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Catherine Manseau </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">D</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Domenic Houston </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">B</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Buster Wigton </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Rolland Webber </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">C</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Claire Mapes </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">M</span>
											</div>
											<div class="list-body">
												<span class="message-author">Melita Faucher</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">J</span>
											</div>
											<div class="list-body">
												<span class="message-author">Jeffery Lalor</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">L</span>
											</div>
											<div class="list-body">
												<span class="message-author">Loren Gatlin</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">T</span>
											</div>
											<div class="list-body">
												<span class="message-author">Tarah Shropshire</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer">
							<a href="chat.html">See all messages</a>
						</div>
					</div>
				</div>
            </div>
			
			
			
			
			
			
			
			<div id="add_department" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Add Category</h4>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label>Category Name <span class="text-danger">*</span></label>
									<input id=newCategoryName class="form-control" required="" type="text">
								</div>
								<div class="form-group">
									<label>Category Description <span class="text-danger"></span></label>
									<input id=newCategoryDesc class="form-control"  type="text">
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" id="addCategory">Create Category</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			
			<div id=editDeleteInjector>
			</div>
			
			
			
			
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="js/moment.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
		
		<script>
		$( document ).ready(function() {
			$.ajax({
					url: "api/getCategory.php",
					type: "POST",
					dataType: 'json',
					data: {
						categoryName: $("#newCategoryName").val(),
						categoryDesc: $("#newCategoryDesc").val()
					},
					success: function (data) {
						if (data) {
							if(data == "0"){
								alert("No category in table");
							}
							else{
								
								$("#datatable").DataTable().destroy();
								$("#categoryInjector").html(data[0]);
								$('.datatable').DataTable({
									"bdestroy": true,
									"bFilter": false,
								});
								
								$("#editDeleteInjector").html(data[1]);
							}
						}
					},
					error: function () {
						alert("Server error.");
					}

				});
			
			
		});
		
		
		$("#submit").click(function(){
			$.ajax({
					url: "api/addCategory.php",
					type: "POST",
					data: {
						categoryName: $("#newCategoryName").val(),
						categoryDesc: $("#newCategoryDesc").val()
					},
					success: function (data) {
						if (data) {
							if(data == "1"){
								window.location.replace("./category-list.php");
							}
							else{
								console.log(data);
								alert("Error!");
							}
						}
					},
					error: function () {
						alert("Server error.");
					}

				});
		});
		
		
		function editCategory(id){
			
		}
		
		function deleteCategory(id){
			
		}
		
		</script>
		
		
    </body>

<!-- Mirrored from dreamguys.co.in/hrms/departments.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Feb 2018 20:50:31 GMT -->
</html>