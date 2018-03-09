<?php
session_start();


include "./api/config.php";

$cat_id = $_GET['id'];
$cat_name = '';
$cat_topic = 'All';
if(isset($_GET['id'])){

    $sql = "SELECT * FROM `category` WHERE `cat_id` = " . $_GET['id'];

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $cat_name = $row['cat_name'];
            $cat_topic =  $row['cat_topic'];
        }
    }else{
       echo '<script> alert("No quiz associated with this category!") </script> ';
    }
}


?>



<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <title>Hi-Quiz - Quiz List</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
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
                <div class="col-xs-8">
                    <h4 class="page-title">List of Quizes - From topic: <?php echo $cat_topic; ?></h4>
                </div>
                <?php if($_SESSION['admin']  == 1) { ?>
                <div class="col-xs-4 text-right m-b-30">
                    <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_salary"><i class="fa fa-plus"></i> Add Quiz</a>
                </div>
                <?php } ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>

                            <tr>
                                <th>Quiz ID</th>
                                <th>Catgory Name</th>
                                <th>Category Topic</th>
                                <th># of Questions</th>
                                <th>Time</th>
                                <th>Status</th>

                                <?php if($_SESSION['admin'] == 1){ ?>
                                    <th class="text-right">Action</th>
                                <?php } ?>

                            </tr>
                            </thead>
                            <tbody>



                            <?php
                            if(isset($_GET['id'])){
                                $sql = "SELECT q.*, c.*, (select count(*) from quiz_question_score qqs where qqs.quiz_id = q.quiz_id ) as attempted, 
(select count(*) from question_bank qb where qb.quiz_id = q.quiz_id ) as numQues
 FROM `quiz` q, category c WHERE q.cat_id = c.cat_id and c.cat_id = " . $_GET['id'];
                            }
                            else{
                                $sql = "SELECT q.*, c.*, (select count(*) from quiz_question_score qqs where qqs.quiz_id = q.quiz_id ) as attempted, 
(select count(*) from question_bank qb where qb.quiz_id = q.quiz_id ) as numQues
 FROM `quiz` q, category c WHERE q.cat_id = c.cat_id";
                            }

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {


                                    echo " <tr>
                                            <td>".$row['quiz_id']."</td>
                                            <td>".$row['cat_name']."</td>
                                            <td>".$row['cat_topic']."</td>
                                            <td>".$row['numQues']."</td>
                                            <td>".$row['quiz_time']."</td>";

                                    if($row['attempted'] == 0){
                                        echo "<td><a class='btn btn-xs btn-primary' onclick='attemptQuiz(".$row['quiz_id'].");'>Attempt Quiz</a></td>
                                           ";
                                    }
                                    else{
                                        echo  "<td><a class='btn btn-xs btn-success' >Attempted</a></td>";
                                    }


                                            
                                            if($_SESSION['admin'] == 1) {
                                                echo " <td class='text-right'>
                                                    <div class='dropdown'>
                                                        <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                                                        <ul class='dropdown-menu pull-right'>
                                                            <li><a href='#' data-toggle='modal' data-target='#edit_salary".$row['quiz_id']."' title='Edit'><i class='fa fa-pencil m-r-5'></i> Edit</a></li>
                                                            <li><a href='#' data-toggle='modal' data-target='#delete_salary".$row['quiz_id']."' title='Delete'><i class='fa fa-trash-o m-r-5'></i> Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>";
                                            }
                                            
                                            
                                            echo"
                                        </tr>";




                                }
                            }

                            ?>













                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="add_salary" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h4 class="modal-title">Add Quiz</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select class="select">
                                        <option>Cat 1</option>
                                        <option>Cat 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Category Topic</label>
                                <input disabled class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quiz Time</label>
                                    <div class='input-group date' id='datetimepicker3'>
                                        <input value="00:00:00" type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>

<!---->
<!--                        <div class="row">-->
<!--                            <h4 class="text-primary">Questions</h4>-->
<!--                            <div class="col-md-6">-->
<!--                                <div class="form-group">-->
<!--                                    <label>Select Category</label>-->
<!--                                    <select class="select">-->
<!--                                        <option>John Doe</option>-->
<!--                                        <option>Richard Miles</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <label>Category Topic</label>-->
<!--                                <input disabled class="form-control" type="text">-->
<!--                            </div>-->
<!--                        </div>-->



                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary">Create Quiz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<!---->
<!--    <div id="edit_salary" class="modal custom-modal fade" role="dialog">-->
<!--        <div class="modal-dialog">-->
<!--            <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--            <div class="modal-content modal-lg">-->
<!--                <div class="modal-header">-->
<!--                    <h4 class="modal-title">Add Staff Salary</h4>-->
<!--                </div>-->
<!--                <div class="modal-body">-->
<!--                    <form>-->
<!--                        <div class="row">-->
<!--                            <div class="col-md-6">-->
<!--                                <div class="form-group">-->
<!--                                    <label>Select Staff</label>-->
<!--                                    <select class="select">-->
<!--                                        <option>John Doe</option>-->
<!--                                        <option>Richard Miles</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <label>Net Salary</label>-->
<!--                                <input class="form-control" type="text" value="$4000">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="row">-->
<!--                            <div class="col-md-6">-->
<!--                                <h4 class="text-primary">Earnings</h4>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Basic</label>-->
<!--                                    <input class="form-control" type="text" value="$6500">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>DA(40%)</label>-->
<!--                                    <input class="form-control" type="text" value="$2000">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>HRA(15%)</label>-->
<!--                                    <input class="form-control" type="text" value="$700">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Conveyance</label>-->
<!--                                    <input class="form-control" type="text" value="$70">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Allowance</label>-->
<!--                                    <input class="form-control" type="text" value="$30">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Medical  Allowance</label>-->
<!--                                    <input class="form-control" type="text" value="$20">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Others</label>-->
<!--                                    <input class="form-control" type="text">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-6">-->
<!--                                <h4 class="text-primary">Deductions</h4>-->
<!--                                <div class="form-group">-->
<!--                                    <label>TDS</label>-->
<!--                                    <input class="form-control" type="text" value="$300">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>ESI</label>-->
<!--                                    <input class="form-control" type="text" value="$20">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>PF</label>-->
<!--                                    <input class="form-control" type="text" value="$20">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Leave</label>-->
<!--                                    <input class="form-control" type="text" value="$250">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Prof. Tax</label>-->
<!--                                    <input class="form-control" type="text" value="$110">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Labour Welfare</label>-->
<!--                                    <input class="form-control" type="text" value="$10">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Fund</label>-->
<!--                                    <input class="form-control" type="text" value="$40">-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label>Others</label>-->
<!--                                    <input class="form-control" type="text" value="$15">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="m-t-20 text-center">-->
<!--                            <button class="btn btn-primary">Save & Update</button>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!---->




<!--    <div id="delete_salary" class="modal custom-modal fade" role="dialog">-->
<!--        <div class="modal-dialog">-->
<!--            <div class="modal-content modal-md">-->
<!--                <div class="modal-header">-->
<!--                    <h4 class="modal-title">Delete Salary</h4>-->
<!--                </div>-->
<!--                <form>-->
<!--                    <div class="modal-body card-box">-->
<!--                        <p>Are you sure want to delete this?</p>-->
<!--                        <div class="m-t-20 text-left">-->
<!--                            <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>-->
<!--                            <button type="submit" class="btn btn-danger">Delete</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->





</div>
<div class="sidebar-overlay" data-reff="#sidebar"></div>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="js/select2.min.js"></script>
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker3').datetimepicker({
            format: 'HH:mm:ss'

        });
    });
    
    
    function attemptQuiz(id) {
        window.location = "quiz.php?id="+id;
        
    }
</script>
</body>

</html>