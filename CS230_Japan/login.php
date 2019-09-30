<?php
session_start();
$username='';
$userpassword='';
$quizResults = '';
$des="";
//echo "REACHED LOGIN > PHP ";

if(isset($_POST['username']) && isset($_POST['userpassword'])) {

    $username = $_POST['username'];
    $userpassword = $_POST['userpassword'];

    $database = new mysqli("localhost", "root", "", "hiraganaUsers") or die("PROBLEM");

    //$sql = "SELECT * FROM 'hiraganaUsers' WHERE 'username'='{$username}' and 'userpassword'='{$userpassword}';";

    $sql = "SELECT * FROM hiraganaUsers WHERE username LIKE '$username' AND userpassword LIKE '$userpassword'";
    if($data = mysqli_query($database,$sql)) {
        $count = mysqli_num_rows($data);

        //echo "ROWS COUNT == ".$count;

        if ($count == 1) {
            $row = mysqli_fetch_array($data);
            $name = $row['username'];
            $quizResults = $row['quizResults'];
            $_SESSION['username'] = $name;
            $_SESSION['quizResults'] = $quizResults;
            //echo ($quizResults);

            $des = "Welcome ".$name." ".$quizResults;
        } else {
            $des = "Sql Query Issue 1";
        }

    } else {
        $des = "Sql Query Issue 2";
    }
    echo $des;
}

















































?>