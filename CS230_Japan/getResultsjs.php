<?php

if(isset($_GET['update'])) {
    echo "Updating results... ".$username." is the user";
    $username = $_GET['username'];
    $userpassword = $_GET['userpassword'];
    $quizResults = $_POST['quizResults'];
   // UPDATE `hiraganaUsers` SET `id`=[value-1],`username`=[value-2],`userpassword`=[value-3],`quizResults`=[value-4] WHERE 1
    $ui = $database->prepare("UPDATE hiraganaUsers SET quizResults='".$quizResults."' WHERE username='".$username."' AND userpassword='".$userpassword."'");

    $ui->execute();

    echo $ui->affected_rows." UPDATE SUCCESSFUL".$username;
    $des = $quizResults;
    echo $des;
}
?>
