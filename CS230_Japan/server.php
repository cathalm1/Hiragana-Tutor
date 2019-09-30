<?php
session_start();

include_once ("databaseConnectionOnce.php");
$username = '';
$userpassword = '';
$quizResults = '';
$submit='';
$update='';
$des = "";
//let var username & password equal the user input fields

if(isset($_POST['submit'])) {
    $id = NULL;
    $username = $_POST['username'];
    $userpassword = $_POST['userpassword'];
    $quizResults = $_POST['quizResults'];
    //valid or not

    //echo ($quizResults);

    if (empty($username) || empty($userpassword)) {
        $des = "Please enter a valid username and password";

    } else {
        $r = $database->query("INSERT INTO hiraganaUsers (id, username, userpassword, quizResults) VALUES ('$id' ,'$username','$userpassword', '$quizResults') ");
        if($r){
            $des = "You are signed up";
        } else {
            $des = "There is already a user with this username";
        }
    }
    echo $des;

}

if(isset($_POST['update'])) {
    echo "Updating results... ";
    $username = $_POST['username'];
    $userpassword = $_POST['userpassword'];
    $quizResults = $_POST['quizResults'];
   // UPDATE `hiraganaUsers` SET `id`=[value-1],`username`=[value-2],`userpassword`=[value-3],`quizResults`=[value-4] WHERE 1
    $ui = $database->prepare("UPDATE hiraganaUsers SET quizResults='".$quizResults."' WHERE username='".$username."' AND userpassword='".$userpassword."'");

    $ui->execute();

    //echo $ui->affected_rows." UPDATE SUCCESSFUL".$username;
    $des = $quizResults;
    echo $des;
}
?>