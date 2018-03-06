<?php
include "config.php";
session_start();
	
$sql = "SELECT * FROM `category`";
$result = $conn->query($sql);
$toReturn = "";
$toReturn2= "";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		$toReturn .= "<tr>
					   <td>".$row['cat_id']."</td>
					   <td>".$row['cat_name']."</td>
					   <td>".$row['cat_topic']."</td>
					   <td class='text-right'>
						  <div class='dropdown'>
							 <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
							 <ul class='dropdown-menu pull-right'>
								<li><a  href='#' data-toggle='modal' data-target='#edit_department".$row['cat_id']."' title='Edit'><i class='fa fa-pencil m-r-5'></i> Edit</a></li>
								<li><a  href='#' data-toggle='modal' data-target='#delete_department".$row['cat_id']."' title='Delete'><i class='fa fa-trash-o m-r-5'></i> Delete</a></li>
							 </ul>
						  </div>
					   </td>
					</tr>";





		$toReturn2 .= "<div id='edit_department".$row['cat_id']."' class='modal custom-modal fade' role='dialog'>
						   <div class='modal-dialog'>
							  <button type='button' class='close' data-dismiss='modal'>&times;</button>
							  <div class='modal-content modal-md'>
								 <div class='modal-header'>
									<h4 class='modal-title'>Edit Category</h4>
								 </div>
								 <div class='modal-body'>
									<form>
									   <div class='form-group'>
										  <label>Category Name <span class='text-danger'>*</span></label>
										  <input class='form-control' id=editCategoryName".$row['cat_id']." value='".$row['cat_name']."' type='text'>
									   </div>
									   <div class='form-group'>
										  <label>Category Description <span class='text-danger'>*</span></label>
										  <input class='form-control' id=editCategoryDesc".$row['cat_id']." value='".$row['cat_topic']."' type='text'>
									   </div>
									   <div class='m-t-20 text-center'>
										  <button class='btn btn-primary' onclick='editCategory(".$row['cat_id'].")'>Save Changes</button>
									   </div>
									</form>
								 </div>
							  </div>
						   </div>
						</div>
						
						
						
						
						<div id='delete_department".$row['cat_id']."' class='modal custom-modal fade' role='dialog'>
						   <div class='modal-dialog'>
							  <div class='modal-content modal-md'>
								 <div class='modal-header'>
									<h4 class='modal-title'>Delete Category</h4>
								 </div>
								 <div class='modal-body card-box'>
									<p>Are you sure want to delete this?</p>
									<div class='m-t-20 text-left'>
									   <a href='#' class='btn btn-default' data-dismiss='modal'>Close</a>
									   <button onclick='deleteCategory(".$row['cat_id'].")' type='button' class='btn btn-danger'>Delete</button>
									</div>
								 </div>
							  </div>
						   </div>
						</div>
						
						"; 
    }
} else {
   $toReturn = 0;
}
$returnVal = array();
array_push($returnVal, $toReturn, $toReturn2);
echo json_encode($returnVal);
$conn->close();
?>
