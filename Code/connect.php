<?php
$db = @new mysqli("localhost","root","","educateyou");
if($db->connect_error){
	exit("cannot connect to database");
}


?>