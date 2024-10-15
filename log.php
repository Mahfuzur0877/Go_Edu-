<?php
	$conn = new mysqli("127.0.0.1:3308","root","","go_edu");

	if($conn->connect_error)
		{
			die("Connection error: " .mysqli_connect_error());
		}
	
		if(isset($_POST['log']))
		{
		  $user_email=$_POST['user_email'];
		  $user_password=$_POST['user_password'];
		  $md5password 	= md5($user_password);

		  if(empty($user_email)){
			$emailmsg = 'Enter an email.';
		}else{
			$emailmsg = '';
		}
		
		if(empty($user_password)){
			$passmsg = 'Enter your password.';
		}else{
			$passmsg = '';
		}

		if(!empty($user_email) && !empty($user_password)){
			$sql = "SELECT * FROM users WHERE user_email='$user_email' AND user_password = '$md5password'";
			$query = $conn->query($sql);
			
			if($query->num_rows >0){
				$row = $query->fetch_assoc();
				$user_first_name = $row['user_first_name'];
				$user_last_name = $row['user_last_name'];
				
				$_SESSION['user_last_name'] = $user_last_name;
				$_SESSION['users_first_name'] = $user_first_name;
				header('location:index.html');
			}else{
				header('location:login.html');
			}
		}




		}



?>