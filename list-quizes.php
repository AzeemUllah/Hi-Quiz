<?php
session_start();


include "./api/config.php";

if(isset($_GET['id'])){
    $cat_id = $_GET['id'];
}
else {
    $cat_id = 0;
}

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
<style>
    .specialSelect{
        width: 25%;
    }

</style>


</head>
<body>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
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
                                <?php if($_SESSION['admin'] != 1){ ?>
                                    <th>Status</th>
                                <?php } ?>
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

                            if($_SESSION['admin'] != 1) {

                                if ($row['attempted'] == 0) {
                                    echo "<td><a class='btn btn-xs btn-primary' onclick='attemptQuiz(" . $row['quiz_id'] . ");'>Attempt Quiz</a></td>
                                           ";
                                } else {
                                    $conn5 = new mysqli("localhost", "root", "", "hi-quiz");
                                    $sql5 = "SELECT c.correct, i.incorrect, (Select count(*) as total from question_bank where quiz_id = 11) as total from 
(Select count(*) as incorrect from (SELECT qqs.ques_id,qqs.answer, (Select qb.correct from question_bank qb where qb.ques_id = qqs.ques_id ) as incorrect FROM `quiz_question_score` qqs where qqs.user_id = ".$_SESSION['id']." and qqs.quiz_id = ".$row['quiz_id'].") amalgum where amalgum.answer != amalgum.incorrect) i, 
(Select count(*) as correct from (SELECT qqs.ques_id,qqs.answer, (Select qb.correct from question_bank qb where qb.ques_id = qqs.ques_id ) as correct FROM `quiz_question_score` qqs where qqs.user_id = ".$_SESSION['id']." and qqs.quiz_id = ".$row['quiz_id'].") amalgum where amalgum.answer = amalgum.correct) as c";
                                    $result5 = $conn5->query($sql5);

                                    if ($result5->num_rows > 0) {
                                        while($row5 = $result5->fetch_assoc()) {
                                            echo "<td><a class='btn btn-xs btn-success' >Score ".$row5['correct']."/".$row5['total']."</a></td>";
                                        }
                                    }



                                }

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


    <?php if($_SESSION['admin'] == 1){ ?>
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
                            <h4 class="text-primary">Category Details</h4>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select  id="categorySelect" class="select">

                                    <?php
                                        $sql = "select * from category";
                                        $result = $conn->query($sql);


                                        $cat_topic2 = '';

                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                if($cat_topic2 == ''){
                                                    $cat_topic2 = $row['cat_topic'];
                                                }
                                                echo "<option value='".$row['cat_id']."'>".$row['cat_name']."</option>";
                                            }
                                        }
                                    ?>




                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Category Topic</label>
                                <input value="<?php echo $cat_topic2; ?>"  disabled id="categoryTopic" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quiz Time</label>
                                    <div class='input-group date' id='datetimepicker3'>
                                        <input id="timeQuiz" value="00:00:00" type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>

                        <div class="row">
                            <h4 class="text-primary">Questions</h4>
                        </div>



<div id="questionsInjector">

                        <div class="row">
                            <div class="col-md-12">
                                <label>Question 1</label>
                                <input id="q1" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Option 1</label>
                                <input id="q1o1" class="form-control" type="text">
                            </div>
                            <div class="col-md-6">
                                <label>Option 2</label>
                                <input id="q1o2" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Option 3</label>
                                <input id="q1o3" class="form-control" type="text">
                            </div>
                            <div class="col-md-6">
                                <label>Option 4</label>
                                <input id="q1o4" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Correct Answer</label>
                                    <br>
                                    <select id="q1correct" class="specialSelect">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </div>
                            <input value="1" id="count" style="    display: none;">
                        </div>

</div>

                        <div class="row">
                            <button type="button" class="close" onclick="addQuestion()">+</button>
                        </div>






                        <div class="m-t-20 text-center">
                            <button type="button" onclick="createQuiz();" class="btn btn-primary">Create Quiz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>





    <?php

     if($_SESSION['admin'] == 1) {


         $conn2 = new mysqli("localhost", "root", "", "hi-quiz");
         $conn3 = new mysqli("localhost", "root", "", "hi-quiz");

         if (isset($_GET['id'])) {
             $sql = "SELECT q.*, c.*, (select count(*) from quiz_question_score qqs where qqs.quiz_id = q.quiz_id ) as attempted, 
(select count(*) from question_bank qb where qb.quiz_id = q.quiz_id ) as numQues
 FROM `quiz` q, category c WHERE q.cat_id = c.cat_id and c.cat_id = " . $_GET['id'];
         } else {
             $sql = "SELECT q.*, c.*, (select count(*) from quiz_question_score qqs where qqs.quiz_id = q.quiz_id ) as attempted, 
(select count(*) from question_bank qb where qb.quiz_id = q.quiz_id ) as numQues
 FROM `quiz` q, category c WHERE q.cat_id = c.cat_id";
         }

         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {


                 echo " <div id='edit_salary" . $row['quiz_id'] . "' class='modal custom-modal fade' role='dialog'>
        <div class='modal-dialog'>
            <button type='button' class='close' data-dismiss='modal'>&times;</button>
            <div class='modal-content modal-lg'>
                <div class='modal-header'>
                    <h4 class='modal-title'>Edit Quiz</h4>
                </div>
                <div class='modal-body'>
                    <form>
                        <div class='row'>
                            <h4 class='text-primary'>Category Details</h4>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label>Select Category</label>
                                    <select id='categorySelect" . $row['quiz_id'] . "' class='select'>";

                 $sql2 = "select * from category";
                 $result2 = $conn2->query($sql2);
                 $cat_topic2 = '';
                 if ($result2->num_rows > 0) {
                     while ($row2 = $result2->fetch_assoc()) {
                         $selected = '';
                         if ($row['cat_id'] == $row2['cat_id']) {
                             $cat_topic2 = $row2['cat_topic'];
                             $selected = 'selected';
                         }
                         echo "<option " . $selected . " value='" . $row2['cat_id'] . "'>" . $row2['cat_name'] . "</option>";
                     }
                 }


                 echo " </select>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <label>Category Topic</label>
                                <input value='" . $cat_topic2 . "'  disabled id='categoryTopic" . $row['quiz_id'] . "' class='form-control' type='text'>
                            </div>
                        </div>";


                 echo "
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label>Quiz Time</label>
                                    <div class='input-group date' id='datetimepicker" . $row['quiz_id'] . "'>
                                        <input  id='timeQuiz" . $row['quiz_id'] . "' value='" . $row['quiz_time'] . "' type='text' class='form-control' />
                                        <span class='input-group-addon'>
                                            <span class='glyphicon glyphicon-time'></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-6'>
                            </div>
                        </div>";


                 echo "<div class='row'>
                            <h4 class='text-primary'>Questions</h4>
                        </div>";


                 $sql3 = "SELECT * FROM `question_bank` where quiz_id = " . $row['quiz_id'];
                 $result3 = $conn3->query($sql3);
                 $count_ = 1;
                 if ($result3->num_rows > 0) {
                     while ($row3 = $result3->fetch_assoc()) {
                         echo "         <div id=''>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <label>Question " . $count_ . "</label>
                                    <input id='q" . $count_ . "q" . $row['quiz_id'] . "' value='" . $row3['ques_name'] . "' class='form-control' type='text'>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <label>Option 1</label>
                                    <input value='" . $row3['c1'] . "' id='q" . $count_ . "o1q" . $row['quiz_id'] . "' class='form-control' type='text'>
                                </div>
                                <div class='col-md-6'>
                                    <label>Option 2</label>
                                    <input value='" . $row3['c2'] . "' id='q" . $count_ . "o2q" . $row['quiz_id'] . "' class='form-control' type='text'>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <label>Option 3</label>
                                    <input value='" . $row3['c3'] . "' id='q" . $count_ . "o3q" . $row['quiz_id'] . "' class='form-control' type='text'>
                                </div>
                                <div class='col-md-6'>
                                    <label>Option 4</label>
                                    <input value='" . $row3['c4'] . "' id='q" . $count_ . "o4q" . $row['quiz_id'] . "' class='form-control' type='text'>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label>Correct Answer</label>
                                        <br>
                                        <select id='q" . $count_ . "correctq" . $row['quiz_id'] . "' class='specialSelect'>
                                        ";


                         if ($row3['correct'] == "1") {
                             echo "<option selected>1</option>";
                         } else {
                             echo "<option>1</option>";
                         }
                         if ($row3['correct'] == "2") {
                             echo "<option selected>2</option>";
                         } else {
                             echo "<option>2</option>";
                         }
                         if ($row3['correct'] == "3") {
                             echo "<option selected>3</option>";
                         } else {
                             echo "<option>3</option>";
                         }
                         if ($row3['correct'] == "4") {
                             echo "<option selected>4</option>";
                         } else {
                             echo "<option>4</option>";
                         }

                         echo "</select>
                                    </div>
                                </div>
                                <input value='" . $row3['ques_id'] . "' id='q" . $count_ . "quesId" . $row['quiz_id'] . "' style='display: none;'>
                            </div>
                        </div>";

                         $count_++;
                     }
                     echo "<input value='" . $count_ . "' id='count" . $row['quiz_id'] . "' style='display: none;'>";
                 }


                 echo "            
                        <div class='m-t-20 text-center'>
                            <button type='button' onclick='saveEditQuiz(" . $row['quiz_id'] . ");' class='btn btn-primary'>Save</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>";


                 echo "
            <script>
            $('#categorySelect" . $row['quiz_id'] . "').on('change', function (e) {
        var optionSelected = $('option:selected', this);
        var valueSelected = $('#categorySelect" . $row['quiz_id'] . "').val();
       
       
        $.ajax({
            url: 'api/getTopic.php',
            type: 'POST',
            data: {
                id: valueSelected
            },
            success: function (data) {
                if (data) {
                    if(data == '0'){
                        alert('No such category!');
                    }
                    else{
                        $('#categoryTopic" . $row['quiz_id'] . "').val(data);
                    }
                }
            },
            error: function (xhr, status, error) {
                alert(request.responseText);
                               

            }
        });


    });
    
             $(function () {
        $('#datetimepicker" . $row['quiz_id'] . "').datetimepicker({
            format: 'HH:mm:ss'

        });
    });
            
            
    </script>
    ";
             }
         }
     }
        ?>

















<?php

if($_SESSION['admin'] == 1) {

    if (isset($_GET['id'])) {
        $sql = "SELECT q.*, c.*, (select count(*) from quiz_question_score qqs where qqs.quiz_id = q.quiz_id ) as attempted, 
    (select count(*) from question_bank qb where qb.quiz_id = q.quiz_id ) as numQues
     FROM `quiz` q, category c WHERE q.cat_id = c.cat_id and c.cat_id = " . $_GET['id'];
    } else {
        $sql = "SELECT q.*, c.*, (select count(*) from quiz_question_score qqs where qqs.quiz_id = q.quiz_id ) as attempted, 
    (select count(*) from question_bank qb where qb.quiz_id = q.quiz_id ) as numQues
     FROM `quiz` q, category c WHERE q.cat_id = c.cat_id";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
    <div id='delete_salary" . $row['quiz_id'] . "' class='modal custom-modal fade' role='dialog'>
        <div class='modal-dialog'>
            <div class='modal-content modal-md'>
                <div class='modal-header'>
                    <h4 class='modal-title'>Delete Salary</h4>
                </div>
                <form>
                    <div class='modal-body card-box'>
                        <p>Are you sure want to delete this?</p>
                        <div class='m-t-20 text-left'>
                            <a href='#' class='btn btn-default' data-dismiss='modal'>Close</a>
                            <button type='button' onclick='deleteQuiz(" . $row['quiz_id'] . ")' class='btn btn-danger'>Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>";
        }
    }
}
?>







</div>
<div class="sidebar-overlay" data-reff="#sidebar"></div>

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


    var questionNum = 1;

    function addQuestion(){
        questionNum++;
        $("#questionsInjector").append("\n" +
                "<div style='padding-top: 15px;'><div>" +
            "    <div class='row'>\n" +
            "        <div class='col-md-12'>\n" +
            "        <label>Question "+questionNum+"</label>\n" +
            "    <input id='q"+questionNum+"' class='form-control' type='text'>\n" +
            "        </div>\n" +
            "        </div>\n" +
            "        <div class='row'>\n" +
            "        <div class='col-md-6'>\n" +
            "        <label>Option 1</label>\n" +
            "    <input id='q"+questionNum+"o1' class='form-control' type='text'>\n" +
            "        </div>\n" +
            "        <div class='col-md-6'>\n" +
            "        <label>Option 2</label>\n" +
            "    <input id='q"+questionNum+"o2' class='form-control' type='text'>\n" +
            "        </div>\n" +
            "        </div>\n" +
            "        <div class='row'>\n" +
            "        <div class='col-md-6'>\n" +
            "        <label>Option 3</label>\n" +
            "    <input id='q"+questionNum+"o3' class='form-control' type='text'>\n" +
            "        </div>\n" +
            "        <div class='col-md-6'>\n" +
            "        <label>Option 4</label>\n" +
            "    <input id='q"+questionNum+"o4' class='form-control' type='text'>\n" +
            "        </div>\n" +
            "        </div>\n" +
            "        <div class='row'>\n" +
            "        <div class='col-md-6'>\n" +
            "        <div class='form-group'>\n" +
            "        <label>Correct Answer</label>\n<br>" +
            "    <select id='q"+questionNum+"correct' class='specialSelect'>\n" +
            "        <option>1</option>\n" +
            "        <option>2</option>\n" +
            "        <option>3</option>\n" +
            "        <option>4</option>\n" +
            "        </select>\n" +
            "        </div>\n" +
            "        </div>\n" +
            "        </div>");

        $('#count').val(questionNum);

    }

    
    
    function createQuiz() {
        var questions = [];
        var optionsA = [];
        var optionsB = [];
        var optionsC = [];
        var optionsD = [];
        var optionsCorrect = [];

        var categoryId = $('#categorySelect').val();
        var quizTime = $('#timeQuiz').val();

        var questionsNum = $('#count').val();




        for (i = 1; i<=questionsNum; i++){
            var handleQuestions ='#q'+i;
            var handleOptionsA ='#q'+i + 'o1';
            var handleOptionsB ='#q'+i + 'o2';
            var handleOptionsC ='#q'+i + 'o3';
            var handleOptionsD ='#q'+i+ 'o4';
            var handleOptionsCorrect ='#q'+i + 'correct';

            var temp1 = $(handleQuestions).val();
            var temp2 = $(handleOptionsA).val();
            var temp3 = $(handleOptionsB).val();
            var temp4 = $(handleOptionsC).val();
            var temp5 = $(handleOptionsD).val();
            var temp6 = $(handleOptionsCorrect).val();

            questions.push(temp1);
            optionsA.push(temp2);
            optionsB.push(temp3);
            optionsC.push(temp4);
            optionsD.push(temp5);
            optionsCorrect.push(temp6);

        }


        $.ajax({
            url: "api/saveQuiz.php",
            type: "POST",
            data: {
                categoryId: categoryId,
                quizTime: quizTime,
                questions: questions,
                optionsA: optionsA,
                optionsB: optionsB,
                optionsC: optionsC,
                optionsD: optionsD,
                optionsCorrect: optionsCorrect
            },
            success: function (data) {
                if (data) {
                    if(data === "0"){
                        alert("Error!" + data);
                    }
                    else{
                        location.reload();

                    }
                }
            },
            error: function (xhr, status, error) {
                alert(request.responseText);
            }
        });
    }


    function deleteQuiz(id){
        $.ajax({
            url: "api/deleteQuiz.php",
            type: "POST",
            data: {
              id: id
            },
            success: function (data) {
                if (data) {
                    if(data == "1"){
                        location.reload();
                    }
                    else{
                        alert("Error! \nCan't delete quiz already attempted by users or has questions in it." );
                    }
                }
            },
            error: function (xhr, status, error) {
                alert(request.responseText);
            }
        });
    }


    $('#categorySelect').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = $("#categorySelect").val();
        alert(valueSelected);

        $.ajax({
            url: "api/getTopic.php",
            type: "POST",
            data: {
                id: valueSelected
            },
            success: function (data) {
                if (data) {
                    if(data == "0"){
                        alert("No such category!");
                    }
                    else{
                        $("#categoryTopic").val(data);
                    }
                }
            },
            error: function (xhr, status, error) {
                alert(request.responseText);
            }
        });
    });




    function saveEditQuiz(id) {
        var questions = [];
        var optionsA = [];
        var optionsB = [];
        var optionsC = [];
        var optionsD = [];
        var optionsCorrect = [];

        var quesId = [];

        var categoryId = $('#categorySelect'+id).val();
        var quizTime = $('#timeQuiz'+id).val();

        var questionsNum = $('#count'+id).val() -1;



        for (i = 1; i<=questionsNum; i++){
            var handleQuestions ='#q'+i+"q"+id;
            var handleOptionsA ='#q'+i + 'o1q' + id;
            var handleOptionsB ='#q'+i + 'o2q' +id;
            var handleOptionsC ='#q'+i + 'o3q' + id;
            var handleOptionsD ='#q'+i+ 'o4q' + id;
            var handleOptionsCorrect ='#q'+i + 'correctq' + id;

            var handleQuesId ='#q'+i + 'quesId' + id;

            var temp1 = $(handleQuestions).val();
            var temp2 = $(handleOptionsA).val();
            var temp3 = $(handleOptionsB).val();
            var temp4 = $(handleOptionsC).val();
            var temp5 = $(handleOptionsD).val();
            var temp6 = $(handleOptionsCorrect).val();

            var temp7 = $(handleQuesId).val();

            questions.push(temp1);
            optionsA.push(temp2);
            optionsB.push(temp3);
            optionsC.push(temp4);
            optionsD.push(temp5);
            optionsCorrect.push(temp6);

            quesId.push(temp7);

        }

        console.log(questionsNum + " " + categoryId + " " + quizTime);
        console.log(questions);
        console.log(optionsA);
        console.log(optionsB);
        console.log(optionsC);
        console.log(optionsD);
        console.log(optionsCorrect);

        console.log(quesId);

        $.ajax({
            url: "api/EditSaveQuiz.php",
            type: "POST",
            data: {
                quesId: quesId,
                quizId: id,
                categoryId: categoryId,
                quizTime: quizTime,
                questions: questions,
                optionsA: optionsA,
                optionsB: optionsB,
                optionsC: optionsC,
                optionsD: optionsD,
                optionsCorrect: optionsCorrect
            },
            success: function (data) {
                if (data) {
                    if(data === "0"){
                        alert("Error!" + data);
                    }
                    else{
                        location.reload();
                    }
                }
            },
            error: function (xhr, status, error) {
                alert(request.responseText);
            }
        });
    }






</script>
</body>

</html>