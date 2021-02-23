<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>NAHM POS</title>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="css/mdb.min.css" rel="stylesheet">
<!-- Your custom styles (optional) -->
<link href="css/style.css" rel="stylesheet">
<link href="sticky-footer.css" rel="stylesheet">
<style>
.abcd {
position: fixed;
left: 0;
bottom: 0;
width: 100%;
background-color: red;
color: white;
text-align: center;
}
.mh1
{
  height: 50vh; /* 30% of viewport height*/
  max-height: 50vh;
}
.mh2
{
  height: 100vh; /* 30% of viewport height*/
  max-height: 100vh;
}
.mh3
{
  height: 70vh; /* 30% of viewport height*/
  max-height: 70vh;
}
.mh4
{
  height: 30vh; /* 30% of viewport height*/
  max-height: 30vh;
}
.maxwidthheight
{
text-align: center;
width: 100%;
height: 100%;
}
.maxwidth
{
width: 100%;
}
.tepian
{
border-width: 1px;
border-color: #000;
border-style: solid;
}
.tepibawah
{
border-bottom-width: 1px;
border-bottom-color: #000;
border-bottom-style: solid;
}
.nopadding
{
padding: 0px;
}
.nomargin
{
margin: 0px;
}
.scrollpage
{
overflow-x: hidden;
overflow-y: scroll;
}
#item0
{
display: block;
}
#item1
{
display: none;
}
#item2
{
display: none;
}
#item3
{
display: none;
}
#item4
{
display: none;
}
#item5
{
display: none;
}
#item6
{
display: none;
}
</style>
</head>

<body onload="displyclear()">
<div class="container-fluid" style="background-color: #ffe6e6;">
<div class="row justify-content-md-center">
    <!--/.postitem-->
    <div class="col-md-3 mh2">
            <table width="60%" align="center" style="margin-top: 10%;margin-bottom: 10%;">
            <tr>
            <td><img src="logo.png" class="img-fluid" alt="Responsive image"></td>
            </tr>
            </table>
            <!--/.numpad-->
            <form name="calcform" action="verify.php" method="post">
            <table width="80%" align="center">
            <tr>
                <td colspan="3">
                <input type="text" name="txt1" class="form-control ml-0" autofocus="true">
                </td>
            </tr>
            <tr>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn7" value=7 onclick="displynum(btn7.value)">7
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn8" value=8 onclick="displynum(btn8.value)">8
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn9" value=9 onclick="displynum(btn9.value)">9
            </button>
            </td>
            </tr>
            <tr>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn4" value=4 onclick="displynum(btn4.value)">4
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn5" value=5 onclick="displynum(btn5.value)">5
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn6" value=6 onclick="displynum(btn6.value)">6
            </button>
            </td>
            </tr>
            <tr>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn1" value=1 onclick="displynum(btn1.value)">1
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn2" value=2 onclick="displynum(btn2.value)">2
            </button>
            </td>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn3" value=3 onclick="displynum(btn3.value)">3
            </button>
            </td>
            </tr>
            <tr>
            <td>
            <button type="button" class="btn btn-nahm btn-block" name="btn0" value=0 onclick="displynum(btn0.value)">0
            </button>
            </td>
            <td colspan="2">
            <button type="button" class="btn btn-nahm btn-block" name="btnnhu" value=BPU onclick="displynum(btnnhu.value)">BPU
            </button>
            </td>
            </tr>
            <tr>
            <td colspan="3">
            <button type="button" class="btn btn-nahm btn-block" name="clrbtn" value=clear onclick="displyclear()">CLEAR
            </button>
            </td>
            </tr>
            <tr>
                <td colspan="3">
                <button type="submit" class="btn btn-nahm btn-block">LOGIN
                <i class="fa fa-sign-in ml-1"></i>
                </button>
                </td>
            </tr>
            </table>
            <!--/.numpad-->
            </form>
        <!--Modal Form Login with Avatar Demo-->
    </div>
</div>
</div>
<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript">
function displynum(n1)
{
    calcform.txt1.value=calcform.txt1.value+n1;
}
function displyclear()
{
    calcform.txt1.value="";
}
</script>
<script>
function positem1() {
document.getElementById("item0").style.display = "none";
document.getElementById("item1").style.display = "block";
document.getElementById("item2").style.display = "none";
document.getElementById("item3").style.display = "none";
document.getElementById("item4").style.display = "none";
document.getElementById("item5").style.display = "none";
document.getElementById("item6").style.display = "none";
}
function positem2() {
document.getElementById("item0").style.display = "none";
document.getElementById("item1").style.display = "none";
document.getElementById("item2").style.display = "block";
document.getElementById("item3").style.display = "none";
document.getElementById("item4").style.display = "none";
document.getElementById("item5").style.display = "none";
document.getElementById("item6").style.display = "none";
}
function positem3() {
document.getElementById("item0").style.display = "none";
document.getElementById("item1").style.display = "none";
document.getElementById("item2").style.display = "none";
document.getElementById("item3").style.display = "block";
document.getElementById("item4").style.display = "none";
document.getElementById("item5").style.display = "none";
document.getElementById("item6").style.display = "none";
}
function positem4() {
document.getElementById("item0").style.display = "none";
document.getElementById("item1").style.display = "none";
document.getElementById("item2").style.display = "none";
document.getElementById("item3").style.display = "none";
document.getElementById("item4").style.display = "block";
document.getElementById("item5").style.display = "none";
document.getElementById("item6").style.display = "none";
}
function positem5() {
document.getElementById("item0").style.display = "none";
document.getElementById("item1").style.display = "none";
document.getElementById("item2").style.display = "none";
document.getElementById("item3").style.display = "none";
document.getElementById("item4").style.display = "none";
document.getElementById("item5").style.display = "block";
document.getElementById("item6").style.display = "none";
}
function positem6() {
document.getElementById("item0").style.display = "none";
document.getElementById("item1").style.display = "none";
document.getElementById("item2").style.display = "none";
document.getElementById("item3").style.display = "none";
document.getElementById("item4").style.display = "none";
document.getElementById("item5").style.display = "none";
document.getElementById("item6").style.display = "block";
}
</script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<script>
//doughnut
var ctxD = document.getElementById("doughnutChart").getContext('2d');
var myLineChart = new Chart(ctxD, {
type: 'doughnut',
data: {
labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
datasets: [
{
data: [300, 50, 100, 40, 120],
backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
}
]
},
options: {
responsive: true
}
});
</script>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
data: {
labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
datasets: [{
label: '# of Votes',
data: [12, 19, 3, 5, 2, 3],
backgroundColor: [
'rgba(255, 99, 132, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(255, 206, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(153, 102, 255, 0.2)',
'rgba(255, 159, 64, 0.2)'
],
borderColor: [
'rgba(255,99,132,1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)'
],
borderWidth: 1
}]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero:true
}
}]
}
}
});
</script>

</body>

</html>
