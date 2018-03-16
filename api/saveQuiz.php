<?php
include "config.php";
session_start();
$last_id = 0;

$categoryId = $_POST['categoryId'];
$quizTime = $_POST['quizTime'];
$questions = $_POST['questions'];
$optionsA = $_POST['optionsA'];
$optionsB = $_POST['optionsB'];
$optionsC = $_POST['optionsC'];
$optionsD = $_POST['optionsD'];
$optionsCorrect = $_POST['optionsCorrect'];

$sql = "INSERT INTO `quiz` (`quiz_id`, `quiz_time`, `cat_id`) VALUES (NULL, '".$_POST['quizTime']."', '".$_POST['categoryId']."');";

$length = count($questions);

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;

    for ($i = 0; $i < $length; $i++) {
        $sql = "INSERT INTO `question_bank` (`ques_id`, `ques_name`, `c1`, `c2`, `c3`, `c4`, `correct`, `quiz_id`) 
VALUES (NULL, '".$questions[$i]."', '".$optionsA[$i]."', '".$optionsB[$i]."', '".$optionsC[$i]."', '".$optionsD[$i]."', '".$optionsCorrect[$i]."', '".$last_id."');";
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








