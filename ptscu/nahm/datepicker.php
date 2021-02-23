<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>SCU PAYROLL SYSTEM</title>
  <link rel="stylesheet" href="js/jquery-ui.css" type="text/css"/>
  <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
  <script src="js/jquery-ui.js" type="text/javascript"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker1();
  });
  </script>
  <style>
  body {
    background: #f5f5f5;
    margin: 0;
    padding: 20px 0 0 0;
    text-align: center;
    font-size: 16px;
  }
  h1 {
    color: #222;
    font-size: 24px;
  }
  </style>
</head>
<body>
<h1>jQuery UI DatePicker Sederhana</h1>
<form>
    <label>Tanggal: </label>
    <input type="text" id="datepicker" />
    <input type="text" id="datepicker1" />
</form> 

</body>
</html>