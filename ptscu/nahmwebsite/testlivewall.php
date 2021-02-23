<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="refresh" content="600" >
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
    width: 22.5%;
    margin: 1%;
    background-color: #ffffff;
}
.tagfoto
{
width: 100%;
}
.user
{
  padding-left: 5%;
  padding-right: 5%;
  padding-bottom: 5%;
}
.lovecomen
{
  margin-top: 5%;
  padding-left: 5%;
  padding-right: 5%;
  padding-bottom: 5%;
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
</head>

<body>
<div class="row">
  <div class="col-sm-12">
    <div id="instafeed"></div>
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
<script type="text/javascript">
  var userFeed = new Instafeed1({
    get: 'tagged',
    tagName: 'testqaz',
    userId: '7659099746',
    clientId: '414a8a597a59445d93fc7c24f4e3e2cf',
    accessToken: '7659099746.414a8a5.9e167022eb674361b474e527d55b7eaf',
    resolution: 'standard_resolution',
    template: '<div class="box"><div class="tagfoto"><img class="full" src="{{image}}"></div><div class="lovecomen"><i class="fa fa-heart fa-2x red-text" aria-hidden="true"></i> {{likes}} <i class="fa fa-comment-o fa-2x red-text" aria-hidden="true"></i> {{comments}}</div><div class="user"><a class="card-title"><img src="{{model.user.profile_picture}}" class="rounded-circle quarter"/> {{model.user.username}}</a></div></div>',
    sortBy: 'most-recent',
    sortBy: 'most-recent',
    limit: 20,
    links: false
  });
  userFeed.run();
</script>


</body>

</html>
