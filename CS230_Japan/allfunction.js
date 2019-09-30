function playAudio(file) {
    var n = document.getElementById(file);
    n.play();
}


/************************************************************/


var overallRes = 0;
var disRomIsSet = false;

var sQa = [];

var resultTracker;
function getQuestionsArray() {
    resultTracker = jQuery.parseJSON(document.getElementById("form4divbottom").innerText.toString()) ;

    var start = 0;
    var el = document.getElementsByClassName("questionArray");
    for(var i = 0; i < el.length; i++){
        if(el[i].checked === true){
            var tem = new Array(2);
            let s = el[i].value.toString();
            tem=s.split(" ");
            sQa[start] = tem;
            start++;
        }
    }

    //alert(sQa);

    displayQuestion();
}


/************************************************************/


var countopenM = 0;

function checkCount() {
    var countSB = 0;
    var ch = document.getElementsByClassName("questionArray");

    for(var i = 0; i < ch.length; i++){
        if(ch[i].checked === true) {
            countSB++;
        }
    }
    if(countSB > 10){
        alert("**10 questions have been selected please proceed to quiz**");
        return false;
    }
    countopenM = countSB;
}


/************************************************************/


function checkCC(){
    var qCount = 0;
    var qc = document.getElementsByClassName('a');
    for(var n = 0; n < qc.length; n++) {
        if(qc[n].checked === true) {
            qCount++;
        }
    }
    if(qCount > 1) {
        return false;
    }
}


/************************************************************/


function openQModal1(){
    //alert(countopenM);
    if(countopenM < 10){
        alert("Please Select more Questions");
        return false;
    }
    return true
}


/************************************************************/


var other = function hFun() {
    var hString = "あ い う え お か き く け こ が ぎ ぐ げ ご さ し す せ そ ざ じ ず ぜ ぞ た ち つ て と だ ぢ づ で ど な に ぬ ね の は ひ ふ へ ほ ば び ぶ べ ぼ ぱ ぴ ぷ ぺ ぽ ま み む め も や ゆ よ ら り る れ ろ わ ゐ ゑ を ん";

    var temph = hString.split(" ");

    var ch = temph[Math.floor(Math.random() * Math.floor((temph.length - 1) / 2))];
    if (ch === Qopp || ch === null || ch === " ") {
        //alert("match");
        hFun();
    }
    //alert("IN hString "+ch);
    return ch;
};


/************************************************************/




    resultTracker={a:0,i:0,u:0,e:0,o:0,ka:0,ki:0,ku:0,ke:0,ko:0,sa:0,shi:0,su:0,se:0,so:0,ta:0,chi:0,tsu:0,te:0,to:0
    ,na:0,ni:0,nu:0,ne:0,no:0,ha:0,hi:0,fu:0,he:0,ho:0,ma:0,mi:0,mu:0,me:0,mo:0,ya:0,yu:0,yo:0,ra:0,ri:0,ru:0
    ,re:0,ro:0,wa:0,wo:0,n:0};

/************************************************************/



var correctAnswers = 0;

var disRom = 0;

var disHir = 1;

var QNO = -1;

var Qopp;

var ansKeep;

function displayQuestion() {

    var ANSisin = false;
    ++QNO;

    //pick a random romaji or hiragana depending on if the toggle is set

    if(disRomIsSet){
        other = function rFun(){

            var rString = "a i u e o ka ki ku ke ko sa shi su se so ta chi tsu te to na ni nu ne no ha hi fu he ho ma mi mu me mo ya yu yo ra ri ru re ro wa o";

            var tempr = rString.split(" ");

            //alert(temp);

            var char =  tempr[Math.floor(Math.random()*Math.floor((tempr.length-1)/2))];
            if(char===Qopp || char===null){
                //alert("match");
                rFun();
            }
            //alert("IN rString "+char);
            return char;
        }
    }

    var questionslist = document.getElementById("form1modal1center");
    questionslist.style.background = "white";
    if(QNO===10){
        questionslist.innerHTML = "";
        questionslist.style.color = "white";
        onFinConJson();
        overallRes = Math.floor((correctAnswers/10)*100);
        document.getElementById("questionNo").innerText = "Congratulations your score is " + overallRes;
        questionslist.innerHTML = "Please press update to save your results otherwise exit";
        questionslist.innerHTML = "<input id='qUpdate' value='update' type='submit' formaction='server.php' formmethod='POST' style='height: 50px; width: 100px; color: orangered;'>Save my progression</input>";

        //questionslist.innerHTML = "<button id='closequizbutton' onclick='close();' style='height: 50px; width: 300px; margin-left: 40%;!important; margin-top: 25%;!important;'>Exit Quiz And SignUp / Login to save your score</button>";

    }
    else {

        var QNOAA;



    /*dictionary for romaji charchter words*/
        if(disRomIsSet) {
            QNOAA = sQa[QNO][disHir];
            Qopp = sQa[QNO][disRom];
            ansKeep = Qopp;
            document.getElementById("questionNo").innerHTML = "Question " + (QNO + 1) + " What is the Romaji for " + QNOAA + "?";


        } else if(disRomIsSet===false) {
            QNOAA = sQa[QNO][disRom];
            Qopp = sQa[QNO][disHir];
            ansKeep = QNOAA;

            document.getElementById("questionNo").innerHTML = "Question " + (QNO + 1) + " What is the Hiragana for " + QNOAA + "?";
        }

        //call once to get the random position of the correct answer

        var pos = getRandomCorrectPosition();

        if(pos===1 && ANSisin===false){
            ANSisin = true;
            questionslist.innerHTML = "<input id='a1' class='a' value='"+Qopp+"' type='checkbox' style='margin-left: 40%;!important; margin-top: 5%;!important;'>" + Qopp + "<br>";
        }
        else {
            questionslist.innerHTML = "<input id='a1' class='a' value='X' type='checkbox' style='margin-left: 40%;!important; margin-top: 5%;!important;'>" + other().toString()+ "<br>";
        }
        if(pos===2 && ANSisin===false){
            ANSisin = true;
            questionslist.innerHTML += "<input id='a2' class='a' value='"+Qopp+"' type='checkbox' style='margin-left: 40%;!important; margin-top: 5%;!important;'>" + Qopp + "<br>";
        }
        else {
            questionslist.innerHTML += "<input id='a2' class='a' value='X' type='checkbox' style='margin-left: 40%;!important; margin-top: 5%;!important;'>" + other().toString() + "<br>";
        }
        if(pos===3 && ANSisin===false){
            ANSisin = true;
            questionslist.innerHTML += "<input id='a3' class='a' value='"+Qopp+"' type='checkbox' style='margin-left: 40%;!important; margin-top: 5%;!important;'>" + Qopp + "<br>";
        }
        else {
            questionslist.innerHTML += "<input id='a3' class='a' value='X' type='checkbox' style='margin-left: 40%;!important; margin-top: 5%;!important;'>" + other().toString() + "<br>";
        }
        if(pos===4 && ANSisin===false){
            questionslist.innerHTML += "<input id='a4' class='a' value='"+Qopp+"' type='checkbox' style=' margin-left: 40%;!important; margin-top: 5%;!important;'>" + Qopp + "<br>";
        }
        else {
            questionslist.innerHTML += "<input id='a4' class='a' value='X' type='checkbox' style='margin-left: 40%;!important; margin-top: 5%;!important;'>" + other().toString() + "<br>";
        }
        questionslist.innerHTML += "<button onclick='answerChecker(); displayQuestion();' style='height: 50px; width: 200px; margin-left: 40%;!important; margin-top: 10%;!important;'>Next Question</button>"

    }
}


/************************************************************/


function getRandomCorrectPosition() {
    return Math.floor(Math.random() * Math.floor(4))+1;
}


/************************************************************/


function answerChecker(){
    var ab = document.getElementsByClassName('a');
    for(var i = 0; i < ab.length; i++){
        if(ab[i].checked === true) {
            if(ab[i].value === Qopp) {
                alert("Correct");
                correctAnswers++;
                increaseCorrectAnswer();
                return true;
            } else {
                alert("Incorrect the correct answer is " + Qopp);
            }
        }
    } return false;
}



// for styling the question based on whether they are correct or not

/*

new idea !!!!!

so have a global string and in check answer add to this string every time a question is correct or not
and then when all questions are answered display this string on that modal
so ie.

question 1 correct a=symbol
question 2 incorrect u=symbol

add in here


function wrongQ(){
    document.getElementById("form1modal1center").style.background = "red";
    document.getElementById("form1modal1center").innerHTML = "The correct answer is " + Qopp;
}

function correctQ() {
    document.getElementById("form1modal1center").style.background = "green";
}



////

*/


/************************************************************/


function close() {
    alert("Data Updated");
    document.getElementById('modalwrapper1').style.display='none';
}


/************************************************************/


function open(){
    document.getElementById('modalwrapper2').style.display="block";
}


/************************************************************/


function increaseCorrectAnswer() {
    resultTracker[ansKeep]+=1;
    //alert("UPDATED VALUES "+resultTracker[ansKeep]);
}


/************************************************************/


//convert this array to a json file and store in database

function onFinConJson() {
    let jsf = JSON.stringify(resultTracker);
    //alert(jsf);
    return jsf;
}

/************************************************************/
//problem with username or password

function uspasEmpty() {
    var empty =  "<?php echo $isEmpty; ";
    if(empty === true) return true;
    else return false;
}


/************************************************************/


//jquery and ajax for the sign up


$(document).ready(function() {
    $("form").submit(function(event) {
        event.preventDefault();

        var username = $("#SUname").val();
        var userpassword = $("#SUpassword").val();
        var quizResults = onFinConJson();
        var submit = $("#form2submit").val();
        var update = $("#modal1Qbutton").val();

        /*if(update==='update'){
            var d = load("getResultsjs.php", {username: username, userpassword: userpassword,quizResults:quizResults,submit:submit, update:update});
            //d.toString().split(",");
            $("#form4divbottom").d;
            //$("#form4divbottom").load("server.php", {username: username, userpassword: userpassword,quizResults:quizResults,submit:submit, update:update});

        } else {*/
            $("#form2divbottom").load("server.php", {username: username, userpassword: userpassword,quizResults:quizResults,submit:submit, update:update});
        //}

    });
});


/************************************************************/


//jquery and ajax for the login
/*

$(document).ready(function() {
    $("#form3").get(function(event) {
        event.preventDefault();

        var username = $("#nameLog").val();
        var userpassword = $("#userpasswordLog").val();
        var submit = $("#form3submitbtn").val();


        $("#form3divbottom").load("login.php", {username: username, userpassword: userpassword,submit:submit});
    });
});

*/

/************************************************************/

$(function() {
    $("#form3submitbtn").click(function() {

        var username = $("#nameLog").val();
        var userpassword = $("#userpasswordLog").val();

        $.post("login.php", {username:username, userpassword:userpassword})
            .done(function(data) {
                //alert(data);
                if(data.charAt(0).toString().toLowerCase() === "w") {
                    //previously form3divbottom
                    var newdata = data.split(" ");
                    $("#form3divbottom").text(newdata[0]+" "+newdata[1]);
                    if($("#modal4button").click()) {
                        resTraJs = newdata[2];
                        //alert(resTraJs["a"]);
                        $("#form4divbottom").text(newdata[2]);
                    }
                    //window.location = "hiraganaserver.php";
                } else {
                    $("#form3divbottom").text("You need to sign up ");
                }
            });
    });

});


/*

//previously form3divbottom
if($("#modal4button").click()) {
    $("#form4divbottom").text(data);
}
//window.location = "hiraganaserver.php";



*/




$(document).ready(function() {
    $("form").submit(function(event) {
        event.preventDefault();

        var username = $("#nameLog").val();
        var userpassword = $("#userpasswordLog").val();
        var quizResults = onFinConJson();
        var submit = $("#resultsubmit").val();
        var update = $("#qUpdate").val();

        if(update==="update"){
            $("#form4divbottom").load("server.php", {username: username, userpassword: userpassword,quizResults:quizResults,submit:submit,update:update});

        } else if (submit==="submit"){
            $("#form2divbottom").load("server.php", {username: username, userpassword: userpassword,quizResults:quizResults,submit:submit,update:update});
        }
    });
});































