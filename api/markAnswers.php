<?php
include "config.php";
session_start();

$sql = 'DELETE FROM `quiz_question_score` WHERE `quiz_question_score`.`quiz_id` = '.$_POST['quiz_id'].' AND 
            `quiz_question_score`.`ques_id` = '.$_POST['question_id'].' AND `quiz_question_score`.`user_id` = '.$_POST['user_id'].'';

if ($conn->query($sql) === TRUE) {
    $sql = "INSERT INTO `quiz_question_score` (`quiz_id`, `ques_id`, `time_stamp`, `user_id`, `answer`) VALUES ('".$_POST['quiz_id']."', '".$_POST['question_id']."'
    ,CURRENT_TIMESTAMP, '".$_POST['user_id']."', '".$_POST['answer']."');";

    if ($conn->query($sql) === TRUE) {
        echo "1";
    }
    else{
        echo "0";
    }
} else {
    echo "0";
}



$conn->close();
?>
