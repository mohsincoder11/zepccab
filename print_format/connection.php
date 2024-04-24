<?php

//$con=mysqli_connect("localhost","zhepcabuser","Zh9fk45@312");
$con = mysqli_connect("localhost", "zepcab", "", "", 3307);

if ($con) {
	$db=mysqli_select_db($con,"zhepcab");
}
else
{	
	echo "something is Wrong";
}
?>
