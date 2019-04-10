<?php
	
	include("includes/connection.php");
					if( isset($_POST['login']) )
													{
		   										    
		   										    $email = mysqli_real_escape_string($conn, $_POST['email']);
		   											$pass=mysqli_real_escape_string($conn, $_POST['pass']);
													
													
													$getUser = "select * from users where user_email='$email' AND user_pass = '$pass'";
													
		   											$runUser = mysqli_query($conn,$getUser);
		   											$check=mysqli_num_rows($runUser);	
													
													if($check==1){
																	$_SESSION['user_email']=$email;
																	echo "<script>window.open('home.php','_self')</script>";
																		}
																		
															else{
																	echo"<script>alert('Password or Email is invalid. Try again')</script>";
																	}
													}
?>