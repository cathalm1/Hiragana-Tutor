<?php
/*
 *
 *      CS230_Japan is the dir
 *
 *      hiraganaserver.php is the homepage
 *
 *      http://localhost:8080/CS230_Japan/hiraganaserver.php
 *
 *
 * */
session_start();
$username='';
$userpassword='';
$quizResults='';
$submit = '';
$update=false;
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $database = new mysqli("localhost", "root", "", "hiraganaUsers") or die("PROBLEM");

    $sql = "SELECT * FROM hiraganaUsers WHERE username LIKE '$username' AND userpassword LIKE '$userpassword'";
    $data = mysqli_query($database, $sql);
    $count = mysqli_num_rows($data);
    //echo "ROWS COUNT == ".$count;
    if ($count == 1) {
        $row = mysqli_fetch_array($data);
        $username= $row['username'];
        $userpassword = $row['userpassword'];
        $quizResults = $row['quizResults'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hiragana Tutor App</title>
    <link rel="stylesheet" type="text/css" href="hiraganastyle.css">
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="allfunction.js"></script>

</head>
<body>

<h1 style="text-align: center;!important;"> Hiragana Tutor<!--<p id="httitle">Hiragana Tutor</p>-->
    <!-- toggle switch code outline from w3 schools -->
    <p id="hrdes" style="font-size: 15px; float: left!important;">Hiragana toggle left::::Romaji toggle right <br>

    <label class="switch"><input type="checkbox"><span class="slider round" onclick="disRomIsSet=true;" ></span></label>


        <br>
        Please sign up and then login
    </p>


</h1>

<p id="informationtop" hidden ><a href="logout.php" style="color: black; text-underline: none;">Logout</a></p>

Don't forget to login if you want to save your results






























































<!--  MODAL 2 for sign up-->

<button id="modal2button" onclick="document.getElementById('modalwrapper2').style.display='block'; " value="submit" type="submit" style="height: 50px; width: 100px;">Sign up</button>

<div id="modalwrapper2" class="modal2">
    <form id="form2" class="modal2form2content" method="POST" action="server.php" autocomplete="off">
        <div class="form2topcontainer">
            <span onclick="document.getElementById('modalwrapper2').style.display='none';" class="closemodal2" title="exit login">&times;</span>
            <h3 style="text-align:center;" id="loginInformation">enter a username and password to sign up to hiragana tutor</h3>
        </div>
        <div id="form2modal2center">
            <input class="signUpNU" id="SUname" name="SignUpName" placeholder="enter username" type="text">
            <input class="signUpNU" id="SUpassword" name="SignUpPassword" placeholder="enter password" type="password">
            <button id="form2submit" type="submit" name="submit" style="height: 50px; width: 100px;">Sign up</button>
        </div>
        <p id="form2divbottom"></p>
    </form>

</div>


<!----------------------------------------------------------------------->





<!--onclick="if(uspasEmpty() === false){document.getElementById('modalwrapper2').style.display='none';}"-->







<!--  MODAL 3 for logging in and logging out -->

<button id="modal3button" onclick="document.getElementById('modalwrapper3').style.display='block'; " value="submit" type="submit" style="height: 50px; width: 100px;">Login</button>

<div id="modalwrapper3" class="modal3">
    <form name="form3" class="modal3form3content" method="POST" action="login.php">
        <div class="form3topcontainer">
            <span onclick="document.getElementById('modalwrapper3').style.display='none'; document.getElementById('informationtop').style.display='block';" class="closemodal3" title="exit login">&times;</span>
            <h3 style="text-align:center;" id="loginInformation">Enter Username and Password</h3>
        </div>
        <div id="form3modal3center">
            <input  id="nameLog" name="usersNameL" placeholder="enter username" type="text">
            <input  id="userpasswordLog" name="userspasswordL" placeholder="enter password" type="password">
            <button id="form3submitbtn" type="submit" name="login" formaction="login.php" style="height: 50px; width: 100px;">Login</button>
        </div>
        <p id="form3divbottom"></p>

    </form>

</div>

<!----------------------------------------------------------------------->


<!----------------------------------------------------------------------->






















































































<!----------------------------------------------------------------------->

<!--  MODAL 1 for quiz-->

<button class="modal1button" onclick="if(openQModal1()===true){document.getElementById('modalwrapper1').style.display='block'; getQuestionsArray();}" value="submit" type="submit" style="height: 50px; width: 100px;">Take Quiz</button>

<div id="modalwrapper1" class="modal1">
    <form id="form1" class="modal1form1content">
        <div class="form1topcontainer">
            <span onclick="document.getElementById('modalwrapper1').style.display='none';" class="closemodal1" title="Exit Quiz">&times;</span>
            <h3 style="text-align:center;" id="questionNo"></h3>
        </div>
        <div id="form1modal1center" onclick="return checkCC()">

        </div>
        <p id="form1modal1centerpara"></p>
    </form>

</div>

<!----------------------------------------------------------------------->









<!--  MODAL 4 for displaying hiragan progression -->

<button id="modal4button" onclick="document.getElementById('modalwrapper4').style.display='block';" value="submit" type="submit" style="height: 50px; width: 300px;">Show my progression</button>

<div id="modalwrapper4" class="modal4">
    <form id="form4" class="modal4form4content">
        <div class="form4topcontainer">
            <span onclick="document.getElementById('modalwrapper4').style.display='none';" class="closemodal4" title="exit login">&times;</span>
            <h3 style="text-align:center;" id="hedd">Hiragana Progression</h3>
        </div>
        <div id="form4modal4center">
            <p id="form4divbottom" style="overflow-wrap: break-word;"></p>

        </div>

    </form>

</div>

<!----------------------------------------------------------------------->






















<!--home page wrapper -->

<div id="pagewrapper">
    <form name="formQuestions">
        <!--<a href="#" onclick="getQuestionsArray();return false;">get array</a>-->
        <table id="to_display">
    <tr>
        <td>
         <img src="imagesjapan/image_part_001.jpg" width="100" height="100" class="image_file" onclick="playAudio('audiofile01')">
        <img src="symbols/240px-Hiragana_あ_stroke_order_animation.gif" width="100" height="100" class="gif_file">
        <audio id="audiofile01" src="japansoundfiles/a.mp3"></audio>
            <input id="qs1" class="questionArray" value="a あ" type="checkbox" onclick="return checkCount();">
        </td>
        <td>
        <img src="imagesjapan/image_part_002.jpg" width="100" height="100" class="image_file" onclick="playAudio('audiofile02')">
        <img src="symbols/240px-Hiragana_い_stroke_order_animation.gif" width="100" height="100" class="gif_file">
        <audio id="audiofile02" src="japansoundfiles/i.mp3"></audio>
            <input id="qs2" class="questionArray" value="i い" type="checkbox" onclick="return checkCount();">

        </td>
        <td>
        <img src="imagesjapan/image_part_003.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile03')">
        <img src="symbols/240px-Hiragana_う_stroke_order_animation.gif" width="100" height="100" class="gif_file">
        <audio id="audiofile03" src="japansoundfiles/u.mp3"></audio>
            <input id="qs3" class="questionArray" value="u う" type="checkbox" onclick="return checkCount();">

        </td>
        <td>
        <img src="imagesjapan/image_part_004.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile04')">
        <img src="symbols/240px-Hiragana_え_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile04" src="japansoundfiles/e.mp3"></audio>
            <input id="qs4" class="questionArray" value="e え" type="checkbox" onclick="return checkCount();">

        </td>
        <td>
        <img src="imagesjapan/image_part_005.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile05')">
        <img src="symbols/240px-Hiragana_お_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile05" src="japansoundfiles/o.mp3"></audio>
            <input id="qs5" class="questionArray" value="o お" type="checkbox" onclick="return checkCount();">

        </td>
        <td>
        <img src="imagesjapan/image_part_006.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile06')">
        <img src="symbols/240px-Hiragana_か_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile06" src="japansoundfiles/ka.mp3"></audio>
            <input id="qs6" class="questionArray" value="ka か" type="checkbox" onclick="return checkCount();">

        </td>
        <td>
        <img src="imagesjapan/image_part_007.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile07')">
        <img src="symbols/240px-Hiragana_き_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile07" src="japansoundfiles/ki.mp3"></audio>
            <input id="qs7" class="questionArray" value="ki き" type="checkbox" onclick="return checkCount();">

        </td>
        <td>
        <img src="imagesjapan/image_part_008.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile08')">
        <img src="symbols/240px-Hiragana_く_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile08" src="japansoundfiles/ku.mp3"></audio>
            <input id="qs8" class="questionArray" value="ku く" type="checkbox" onclick="return checkCount();">
        </td>
    </tr>
    <tr>
    <td>
        <img src="imagesjapan/image_part_009.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile09')">
        <img src="symbols/240px-Hiragana_け_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile09" src="japansoundfiles/ke.mp3"></audio>
        <input id="qs9" class="questionArray" value="ke け" type="checkbox" onclick="return checkCount();">
    </td>
    <td>
        <img src="imagesjapan/image_part_010.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile10')">
        <img src="symbols/240px-Hiragana_こ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile10" src="japansoundfiles/ko.mp3"></audio>
        <input id="qs10" class="questionArray" value="ko こ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_011.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile11')">
        <img src="symbols/240px-Hiragana_さ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile11" src="japansoundfiles/sa.mp3"></audio>
        <input id="qs11" class="questionArray" value="sa さ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_012.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile12')">
        <img src="symbols/240px-Hiragana_し_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile12" src="japansoundfiles/shi.mp3"></audio>
        <input id="qs13" class="questionArray" value="shi し" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_013.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile13')">
        <img src="symbols/240px-Hiragana_す_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile13" src="japansoundfiles/su.mp3"></audio>
        <input id="qs14" class="questionArray" value="su す" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_014.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile14')">
        <img src="symbols/240px-Hiragana_せ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile14" src="japansoundfiles/se.mp3"></audio>
        <input id="qs15" class="questionArray" value="se せ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_015.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile15')">
        <img src="symbols/240px-Hiragana_そ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile15" src="japansoundfiles/so.mp3"></audio>
        <input id="qs16" class="questionArray" value="so そ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_016.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile16')">
        <img src="symbols/240px-Hiragana_た_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile16" src="japansoundfiles/ta.mp3"></audio>
        <input id="qs17" class="questionArray" value="ta た" type="checkbox" onclick="return checkCount();">

    </td>
    </tr>

    <tr>
    <td>
        <img src="imagesjapan/image_part_017.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile17')">
        <img src="symbols/240px-Hiragana_ち_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile17" src="japansoundfiles/chi.mp3"></audio>
        <input id="qs18" class="questionArray" value="chi ち" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_018.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile18')">
        <img src="symbols/240px-Hiragana_つ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile18" src="japansoundfiles/tsu.mp3"></audio>
        <input id="qs19" class="questionArray" value="tsu つ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_019.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile19')">
        <img src="symbols/240px-Hiragana_て_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile19" src="japansoundfiles/te.mp3"></audio>
        <input id="qs20" class="questionArray" value="te て" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_020.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile20')">
        <img src="symbols/240px-Hiragana_と_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile20" src="japansoundfiles/to.mp3"></audio>
        <input id="qs21" class="questionArray" value="to た" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_021.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile21')">
        <img src="symbols/240px-Hiragana_な_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile21" src="japansoundfiles/na.mp3"></audio>
        <input id="qs22" class="questionArray" value="na な" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_022.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile22')">
        <img src="symbols/240px-Hiragana_に_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile22" src="japansoundfiles/ni.mp3"></audio>
        <input id="qs23" class="questionArray" value="ni に" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_023.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile23')">
        <img src="symbols/240px-Hiragana_ぬ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile23" src="japansoundfiles/nu.mp3"></audio>
        <input id="qs24" class="questionArray" value="nu ぬ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_024.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile24')">
        <img src="symbols/240px-Hiragana_ね_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile24" src="japansoundfiles/ne.mp3"></audio>
        <input id="qs12" class="questionArray" value="ne ね" type="checkbox" onclick="return checkCount();">

    </td>
    </tr>
    <tr>
    <td>
        <img src="imagesjapan/image_part_025.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile25')">
        <img src="symbols/240px-Hiragana_の_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile25" src="japansoundfiles/no.mp3"></audio>
        <input id="qs25" class="questionArray" value="no の" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_026.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile26')">
        <img src="symbols/240px-Hiragana_は_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile26" src="japansoundfiles/ha.mp3"></audio>
        <input id="qs26" class="questionArray" value="ha は" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_027.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile27')">
        <img src="symbols/240px-Hiragana_ひ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile27" src="japansoundfiles/hi.mp3"></audio>
        <input id="qs27" class="questionArray" value="hi ひ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_028.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile28')">
        <img src="symbols/240px-Hiragana_ふ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile28" src="japansoundfiles/fu.mp3"></audio>
        <input id="qs28" class="questionArray" value="fu ふ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_029.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile29')">
        <img src="symbols/240px-Hiragana_へ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile29" src="japansoundfiles/he.mp3"></audio>
        <input id="qs29" class="questionArray" value="he へ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_030.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile30')">
        <img src="symbols/240px-Hiragana_ほ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile30" src="japansoundfiles/ho.mp3"></audio>
        <input id="qs30" class="questionArray" value="ho ほ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_031.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile31')">
        <img src="symbols/240px-Hiragana_ま_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile31" src="japansoundfiles/ma.mp3"></audio>
        <input id="qs31" class="questionArray" value="ma ま" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_032.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile32')">
        <img src="symbols/240px-Hiragana_み_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile32" src="japansoundfiles/mi.mp3"></audio>
        <input id="qs32" class="questionArray" value="mi み" type="checkbox" onclick="return checkCount();">

    </td>
    </tr>
    <tr>
    <td>
        <img src="imagesjapan/image_part_033.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile33')">
        <img src="symbols/240px-Hiragana_む_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile33" src="japansoundfiles/mu.mp3"></audio>
        <input id="qs33" class="questionArray" value="mu む" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_034.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile34')">
        <img src="symbols/240px-Hiragana_め_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile34" src="japansoundfiles/me.mp3"></audio>
        <input id="qs34" class="questionArray" value="me め" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_035.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile35')">
        <img src="symbols/240px-Hiragana_も_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile35" src="japansoundfiles/mo.mp3"></audio>
        <input id="qs35" class="questionArray" value="mo も" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_036.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile36')">
        <img src="symbols/240px-Hiragana_や_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile36" src="japansoundfiles/ya.mp3"></audio>
        <input id="qs36" class="questionArray" value="ya や" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_038.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile37')">
        <img src="symbols/240px-Hiragana_ゆ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile37" src="japansoundfiles/yu.mp3"></audio>
        <input id="qs37" class="questionArray" value="yu ゆ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_040.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile38')">
        <img src="symbols/240px-Hiragana_よ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile38" src="japansoundfiles/yo.mp3"></audio>
        <input id="qs38" class="questionArray" value="yo よ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_041.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile39')">
        <img src="symbols/240px-Hiragana_ら_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile39" src="japansoundfiles/ra.mp3"></audio>
        <input id="qs39" class="questionArray" value="ra ら" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_042.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile40')">
        <img src="symbols/240px-Hiragana_り_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile40" src="japansoundfiles/ri.mp3"></audio>
        <input id="qs40" class="questionArray" value="ri り" type="checkbox" onclick="return checkCount();">

    </td>
    </tr>
    <tr>
        <td></td>
    <td>
        <img src="imagesjapan/image_part_043.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile41')">
        <img src="symbols/240px-Hiragana_る_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile41" src="japansoundfiles/ru.mp3"></audio>
        <input id="qs41" class="questionArray" value="ru る" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_044.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile42')">
        <img src="symbols/240px-Hiragana_れ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile42" src="japansoundfiles/re.mp3"></audio>
        <input id="qs42" class="questionArray" value="re れ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_045.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile43')">
        <img src="symbols/240px-Hiragana_ろ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile43" src="japansoundfiles/ro.mp3"></audio>
        <input id="qs43" class="questionArray" value="ro ろ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_046.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile44')">
        <img src="symbols/240px-Hiragana_わ_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile44" src="japansoundfiles/wa.mp3"></audio>
        <input id="qs44" class="questionArray" value="wa わ" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_050.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile45')">
        <img src="symbols/240px-Hiragana_を_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile45" src="japansoundfiles/wo.mp3"></audio>
        <input id="qs45" class="questionArray" value="wo を" type="checkbox" onclick="return checkCount();">

    </td>
    <td>
        <img src="imagesjapan/image_part_055.jpg" width="100" height="100" alt="gif_on" class="image_file" onclick="playAudio('audiofile46')">
        <img src="symbols/240px-Hiragana_ん_stroke_order_animation.gif" width="100" height="100" alt="gif_on" class="gif_file">
        <audio id="audiofile46" src="japansoundfiles/n.mp3"></audio>
        <input id="qs46" class="questionArray" value="n ん" type="checkbox" onclick="return checkCount();">

    </td>
    <td></td>
    </tr>
</table>
    </form>
</div>
<!--
<p>
\Resources: <br>
    www.webslesson.com <br>
    www.technotip.com <br>
    www.youtube.com/mmtuts<br>
    https://commons.wikimedia.org/wiki/Category:Hiragana_stroke_order_(animated_image_set) <br>
    http://www.guidetojapanese.org/learn/complete/hiragana <br>

</p>
-->
</body>
</html>