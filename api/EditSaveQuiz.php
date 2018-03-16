<?php
include "config.php";
session_start();
$last_id = 0;

$quizId = $_POST['quizId'];

$categoryId = $_POST['categoryId'];
$quizTime = $_POST['quizTime'];
$questions = $_POST['questions'];
$optionsA = $_POST['optionsA'];
$optionsB = $_POST['optionsB'];
$optionsC = $_POST['optionsC'];
$optionsD = $_POST['optionsD'];
$optionsCorrect = $_POST['optionsCorrect'];
$quesId = $_POST['quesId'];


    $sql = "UPDATE `quiz` SET  `quiz_time` = '".$_POST['quizTime']."', `cat_id` = '".$_POST['categoryId']."' where `quiz_id` = " . $quizId;

    $length = count($questions);

    if ($conn->query($sql) === TRUE) {
        for ($i = 0; $i < $length; $i++) {
           $sql = "UPDATE `question_bank` SET 
`ques_name`='".$questions[$i]."',
`c1`='".$optionsA[$i]."',
`c2`='".$optionsB[$i]."',
`c3`='".$optionsC[$i]."',
`c4`='".$optionsD[$i]."',
`correct`='".$optionsCorrect[$i]."',
`quiz_id`='".$quizId."' 
WHERE ques_id = '".$quesId[$i]."'";

            if ($conn->query($sql) != TRUE) {
                exit;
            }
        }
        echo "0";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


$conn->close();
?>








