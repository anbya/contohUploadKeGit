<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>NAHM THAI SUKI & BBQ</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <link href="assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
	<link rel="stylesheet" href="assets/css/style.css">
    <script type="text/javascript" src="instafeed.min.js"></script>
<style>
@font-face {
font-family: "Font Digital";
src: url('Helv Children.otf');
}
.digital {
font-family: "Font Digital";
}
.badanimg {
  background-color: #6c0000;
  position: relative;
}

.gmbr {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  color: #FFFFFF;
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.badanimg:hover .gmbr {
  opacity: 0.3;
}

.badanimg:hover .middle {
  opacity: 1;
}

.nopadd
{
	padding: 0px;
}
#instafeed
{
    width: 100%;
    padding: 1%;
}
.box
{
    float: left;
    width: 100%;
    margin: 1%;
    background-color: #ffffff;
}
.tagfoto
{
width: 100%;
}
.user
{
  padding-left:1%;
  padding-right: 1%;
  padding-bottom: 1%;
}
.lovecomen
{
  margin-top: 1%;
  padding-left: 1%;
  padding-right: 1%;
  padding-bottom: 1%;
}
.full
{
    width: 100%;
}
.quarter
{
    width: 25%;
}
</style>
<script language="javascript">
ScrollRate = 50;

function scrollDiv_init() {
  DivElmnt = document.getElementById('MyDivName');
  ReachedMaxScroll = false;
  
  DivElmnt.scrollTop = 0;
  PreviousScrollTop  = 0;
  
  ScrollInterval = setInterval('scrollDiv()', ScrollRate);
}

function scrollDiv() {
  
  if (!ReachedMaxScroll) {
    DivElmnt.scrollTop = PreviousScrollTop;
    PreviousScrollTop++;
    
    ReachedMaxScroll = DivElmnt.scrollTop >= (DivElmnt.scrollHeight - DivElmnt.offsetHeight);
  }
  else {
    ReachedMaxScroll = (DivElmnt.scrollTop == 0)?false:true;
    
    DivElmnt.scrollTop = PreviousScrollTop;
    PreviousScrollTop--;
  }
}

function pauseDiv() {
  clearInterval(ScrollInterval);
}

function resumeDiv() {
  PreviousScrollTop = DivElmnt.scrollTop;
  ScrollInterval    = setInterval('scrollDiv()', ScrollRate);
}
</script>
</head>

<body onLoad="scrollDiv_init()">
<div class="row" style="display: none;">
  <div class="col-sm-12">
 <div class="taggbox-container" style="width:100%;height:100%;overflow: auto;"><script defer src="//taggbox.com/app/js/embed.min.js" type="text/javascript"></script><div class="taggbox-socialwall" data-wall-id="livewall">  </div></div>
  </div>
</div>


<div class="row" style="margin-top: 2%;">

  <div class="col-sm-4" style="padding-top: 2%; position: fixed;top: 0;left: 0;bottom: 0;">
    <div class="row">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-6">
      <img src="Logo Web Nahm.png" alt="Avatar" class="gmbr" style="width:100%">
      </div>
      <div class="col-sm-3">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
      <div style="text-align: center;margin-bottom: 2%;">
      <a class="digital" style="font-size: 30px;font-weight: bold;color: #ffffff;">#ELEPHANT CHALLENGE</a> 
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12"><br></div>
    </div>
    <div class="row">
      <div class="col-sm-1">
      </div>
      <div class="col-sm-10">
      <div style="text-align: center;margin-bottom: 2%;">
      <a class="digital" style="font-size: 40px;font-weight: bold;color: #ffffff;">WINNER<br>OF THE WEEK</a> 
      </div>
      </div>
      <div class="col-sm-1">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12"><br></div>
    </div>
    <div class="row">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-8">
      <div id="instafeed"></div>
      </div>
      <div class="col-sm-2">
      </div>
    </div>
  </div>

  <div id="MyDivName" class="col-sm-8" style="text-align: center;position: fixed;top: 0;right: 0;bottom: 0;overflow-y: auto;">
    <div class="col-sm-12" style="text-align: center;">
    <script src="https://assets.juicer.io/embed.js" type="text/javascript"></script>
    <link href="https://assets.juicer.io/embed.css" media="all" rel="stylesheet" type="text/css" />
    <ul class="juicer-feed" data-feed-id="nahmthaisukibbq"><h1 class="referral"></ul>
    </div>
  </div>

</div>


    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script src="assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>
	<script>
	function w3_open() {
	    document.getElementById("mySidebar").style.display = "block";
	}
	function w3_close() {
	    document.getElementById("mySidebar").style.display = "none";
	}
	</script>


<!-- Use the CDN or host the script yourself -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/instafeed.js/1.4.1/instafeed.min.js"></script> -->
<script src="https://matthewelsom.com/assets/js/libs/instafeed.min.js"></script>
<script type="text/javascript">
  var userFeed = new Instafeed({
    get: 'tagged',
    tagName: 'nahmsuki',
    userId: '7659099746',
    clientId: '58029e2f1e0345dda92a91ed8577db84',
    accessToken: '7079029557.58029e2.8cae979685bb498fbeb64260d95c2d7f',
    resolution: 'standard_resolution',
    template: '<div class="box"><div class="tagfoto"><img class="full" src="{{image}}"></div><div class="lovecomen"><i class="fa fa-heart fa-2x red-text" aria-hidden="true"></i> {{likes}} <i class="fa fa-comment-o fa-2x red-text" aria-hidden="true"></i> {{comments}}</div><div class="user"><a class="card-title"><img src="{{model.user.profile_picture}}" class="rounded-circle quarter"/> {{model.user.username}}</a></div></div>',
    sortBy: 'most-recent',
    limit: 1,
    links: false
  });
  userFeed.run();
</script>


</body>

</html>
