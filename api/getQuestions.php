<?php
include "config.php";
session_start();

$sql = "SELECT * FROM `question_bank` WHERE quiz_id=" . $_POST['quiz_id'];

$result = $conn->query($sql);
$toReturn = "";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       $toReturn .= "<li>
                        <div class='experience-user'> 
                            <div class='before-circle'></div>
                        </div>
                        <div class='experience-content'>
                            <div class='timeline-content'>
                                <a class='name'>".$row['ques_name']."</a>
                                <span class='time'  style='margin-top: 5px; margin-left: 20px;'><input onclick='markAnswer(".$row['quiz_id'].", ".$row['ques_id'].",".$_SESSION['id'].",1)'   name='question".$row['ques_id']."' style='margin-right: 10px;'  type='radio'>".$row['c1']."</span>
                                <span class='time' style='margin-top: 3px; margin-left: 20px;'><input onclick='markAnswer(".$row['quiz_id'].", ".$row['ques_id'].",".$_SESSION['id'].",2)' name='question".$row['ques_id']."' style='margin-right: 10px;'  type='radio'>".$row['c2']."</span>
                                <span class='time' style='margin-top: 3px; margin-left: 20px;'><input onclick='markAnswer(".$row['quiz_id'].", ".$row['ques_id'].",".$_SESSION['id'].",3)'  name='question".$row['ques_id']."'  style='margin-right: 10px;'  type='radio'>".$row['c3']."</span>
                                <span class='time' style='margin-top: 3px; margin-left: 20px;'><input onclick='markAnswer(".$row['quiz_id'].", ".$row['ques_id'].",".$_SESSION['id'].",4)'  name='question".$row['ques_id']."' style='margin-right: 10px;'  type='radio'>".$row['c4']."</span>
                            </div>
                        </div>
                    </li>
                    ";
    }
} else {
    $toReturn = "No questions found.";
}

echo $toReturn;
$conn->close();
?>








