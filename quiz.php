<?php
session_start();
include "api/config.php";

$catname = '';
$cattopic = '';

if(!isset($_GET['id'])){
    //redirect page
}
else{
    $sql = "SELECT c.* FROM category c, quiz q where c.cat_id = q.cat_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $catname = $row['cat_topic'];
            $cattopic = $row['cat_name'];
        }
    } else {
        alert("No category associated with this quiz.");
        //refirect to all quiz page
    }
    $conn->close();
}


?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <title>Quiz - Hi-Quiz</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/select2.min.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.15.1/dist/sweetalert2.all.min.js"></script>

</head>
<body>
<div class="main-wrapper">

    <?php include 'header.php'; ?>

    <?php include 'sidebar.php'; ?>

    <div class="page-wrapper">
        <div class="content container-fluid">


            <div class="row">

                <div class="col-md-10 col-md-offset-1">
                    <div class="card-box m-b-0">
                        <h3 class="card-title">Quiz - <?php echo $catname; ?></h3>
                        <div class="experience-box">
                            <ul class="experience-list" id="questionsInjector">







                            </ul>
                        </div>




                    </div>

                    <button type='button' onclick="validateAndGoBack()"  class='btn btn-primary pull-right' style="margin-top: 15px;">Submit</button>

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
    $( document ).ready(function() {
        $.ajax({
            url: "api/getQuestions.php",
            type: "POST",
            dataType: 'json',
            data: {
                quiz_id: <?php echo $_GET['id'] ?>
            },
            success: function (data) {
                if (data) {
                    if(data == "0"){
                        alert("No Questions");
                    }
                    else{
                        $("#questionsInjector").html(data);
                    }
                }
            },
            error: function (request, status, error) {
                $("#questionsInjector").html(request.responseText);
            }

        });


    });

    function markAnswer(quiz_id,question_id,user_id,answer){
        console.log("got here!" + answer);
        $.ajax({
            url: "api/markAnswers.php",
            type: "POST",
            dataType: 'json',
            data: {
                quiz_id: <?php echo $_GET['id'] ?>,
                question_id: question_id,
                user_id: <?php echo $_SESSION['id'] ?>,
                answer: answer
            },
            success: function (data) {
                if (data) {
                    if(data == "1"){

                    }
                    else{
                       alert('Server Error!');
                    }
                }
            },
            error: function (request, status, error) {
                alert('Server Error!');
            }

        });
    }
    
    function validateAndGoBack() {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

            $.ajax({
                url: "api/calculateQuizScore.php",
                type: "POST",
                dataType: 'json',
                data: {
                    quiz_id: <?php echo $_GET['id']; ?>
                },
                success: function (data) {
                    if (data) {
                        if(data[0] == "-1"){
                            alert("Server Error!");
                        }
                        else{
                            swal(
                                'Results!',
                                'You have scored ' + data[0] + ' out of ' + data[2],
                                'success'
                            ).then(function () {
                                window.location = "./list-quizes.php";
                            })
                        }
                    }
                },
                error: function () {
                    alert("Server error.");
                }

            });


        } else if (
        result.dismiss === swal.DismissReason.cancel
        ) {

        }
    })


    }
    


</script>


</body>

<!-- Mirrored from dreamguys.co.in/hrms/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Feb 2018 20:50:25 GMT -->
</html>