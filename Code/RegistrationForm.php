<?php
	if(!empty($_POST['submit'])){
		if(empty($_POST['user_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['re_password'])){
			exit("please fill all the forms.<a href='./RegistrationForm.php'>return</a>");
		}
		if($_POST['password'] !==$_POST['re_password']){
			exit("please check your password, <a href='./RegistrationForm.php'>return </a>");
		}
		$pattern="/^\W+((-\W+) | (\.\W+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/";
		if(!preg_match($pattern,$_POST['email'])){
			exit("please enter a valid email,<a href='./RegistrationForm.php'>return </a>");
		}
		$pattern="/^.(6,20)$/";
		if(!preg_match($pattern,$_POST['password'])){
			exit("passowrd should contain atleast 6 characters and no more than 20 characters. <a href='./RegistrationForm.php'>Return</a>");
		}
		$user_name=addslashes($_POST['user_name']);
		$email=addslashes($_POST['email']);
		$password=addslashes($_POST['password']);
		require_once("./connect.php");
		$sql="SELECT * FROM 'user' WHERE 'email'='{$email}'";
		$result=$db->query($sql);
		if($db->error){
			exit("SQL error. <a href='./register.php'>return</a>");

		}
		if($result->num_rows!==0){
			exit("please use another email address. <a href='./register.php'>return</a>");
		}
		$result->free();
		$password = md5($password);
		$sql = "INSERT INTO 'user' SET 'user_name'='{$user_name}', 'email'='{$email}', 'password'='{$password}'";
		$result = $db->query($sql);
		if($result === true){
			echo "registration successful <br/>";
		}
		else{
			echo "registration failed<br/>";
		}
		$db->close();
	}
?>

<form action="" method="POST">
user name:	<input name="user_name" type="text" value="" /><br>
email addess:	<input name="email" type="text" value="" /><br>
password:	<input name="password" type="password" value="" /><br>
<!-- re-enter password:	<input name="re_password" type="passord" value="" /><br> -->
	<input type="submit" name="submit" value="submit" /><br>
</form>