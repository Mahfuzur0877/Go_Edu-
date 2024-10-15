<?php
$conn = new mysqli("127.0.0.1:3308","root","","go_edu");

if($conn->connect_error)
	{
		die("Connection error: " .mysqli_connect_error());
	}

    if(isset($_POST['submit']))
    {
      
      $user_first_name=$_POST['user_first_name'];
      $user_last_name=$_POST['user_last_name'];
      $user_email=$_POST['user_email'];
      $user_password=$_POST['user_password'];
      $user_password_confirm=$_POST['user_password_confirm'];
      $md5password 	= md5($user_password);

      if(empty($user_first_name)){
        $emptymsg1 = 'Write Firstname';
      }
      if(empty($user_last_name)){
        $emptymsg2 = 'Write Lastname';
      }
      if(empty($user_email)){
        $emptymsg3 = 'Write email';
      }
      if(empty($user_password)){
        $emptymsg4 = 'Write password';
      }
      if(empty($user_password_confirm)){
        $emptymsg5 = 'Write password Again';
      }	


      if(!empty($user_first_name) && !empty($user_last_name) && !empty($user_email) && !empty($user_password) && !empty($user_password_confirm))
      {
        if($user_password !== $user_password_confirm)
        {
          echo'Password does not match!';
          
        }
        else
        {
          $pasmatchmsg='';
          $sql = "INSERT INTO users(user_first_name, user_last_name, user_email, user_password) 
              VALUES('$user_first_name', '$user_last_name', '$user_email', '$md5password')";
        
          if($conn->query($sql) == TRUE)
          {
            header('location:login.html');
            $_SESSION['signupmsg']='Sign Up Complete. Please Log in now.';
          }
          else
          {
            echo 'data not inserted';
          }
        }
      }
      else
      {
        $emptymsg = 'Fill up all fields';
      }

    }
    
  ?>