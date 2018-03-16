<?php
include "config.php";
session_start();

$sql = "SELECT c.correct, i.incorrect, (Select count(*) as total from question_bank where quiz_id = 11) as total from 
(Select count(*) as incorrect from (SELECT qqs.ques_id,qqs.answer, (Select qb.correct from question_bank qb where qb.ques_id = qqs.ques_id ) as incorrect FROM `quiz_question_score` qqs where qqs.user_id = ".$_SESSION['id']." and qqs.quiz_id = ".$_POST['quiz_id'].") amalgum where amalgum.answer != amalgum.incorrect) i, 
(Select count(*) as correct from (SELECT qqs.ques_id,qqs.answer, (Select qb.correct from question_bank qb where qb.ques_id = qqs.ques_id ) as correct FROM `quiz_question_score` qqs where qqs.user_id = ".$_SESSION['id']." and qqs.quiz_id = ".$_POST['quiz_id'].") amalgum where amalgum.answer = amalgum.correct) as c";
$result = $conn->query($sql);

$answers = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($answers, $row['correct']);
        array_push($answers, $row['incorrect']);
        array_push($answers, $row['total']);
    }
} else {
    array_push($answers, -1);
    array_push($answers, -1);
    array_push($answers, -1);
}

echo json_encode($answers);
$conn->close();
?>
