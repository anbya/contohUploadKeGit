<html>
<head>
</head>
<body>
<?php 
$abc="asd";
?>
<script type="text/javascript">
	function displynum<?php echo $abc;?>(n1)
	{
		calcform.txt1.value=calcform.txt1.value+n1;
	}
	function displyclear()
	{
		calcform.txt1.value="";
	}
</script>
	<form name="calcform">
	<input type=text name=txt1><br>
	<input type=button name=btn9 value=9 onclick="displynum<?php echo $abc;?>(btn9.value)">
	<input type=button name=btn8 value=8 onclick="displynum(btn8.value)">
	<input type=button name=btn7 value=7 onclick="displynum(btn7.value)">
	<input type=button name=addbtn value=+ onclick="displynum(addbtn.value)"><br>
	<input type=button name=btn6 value=6 onclick="displynum(btn6.value)">
	<input type=button name=btn5 value=5 onclick="displynum(btn5.value)">
	<input type=button name=btn4 value=4 onclick="displynum(btn4.value)">
	<input type=button name=subbtn value=- onclick="displynum(subbtn.value)"><br>
	<input type=button name=btn3 value=3 onclick="displynum(btn3.value)">
	<input type=button name=btn2 value=2 onclick="displynum(btn2.value)">
	<input type=button name=btn1 value=1 onclick="displynum(btn1.value)">
	<input type=button name=btnmul value=* onclick="displynum(btnmul.value)"><br>
	<input type=button name=btn0 value=0 onclick="displynum(btn0.value)">
	<input type=button name=potbtn value=. onclick="displynum(potbtn.value)">
	<input type=button name=eqlbtn value== onclick="displynum(eqlbtn.value)">
	<input type=button name=divbtn value=/ onclick="displynum(divbtn.value)"><br>
	<input type=button name=clrbtn value=clear onclick="displyclear()">
	</form>
</body>
</html>