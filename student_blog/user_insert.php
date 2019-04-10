<?php
	includes("includes/connection.php")
	
				if( isset($_POST['submit']) )
													{
		   										    
		   										    $name = mysqli_real_escape_string($conn, $_POST['u_name']);
		   											$email=mysqli_real_escape_string($conn, $_POST['u_email']);
		   											$password=mysqli_real_escape_string($conn, $_POST['u_pass']);
		   											$program= $_POST['u_prog'];
		   											$sex= $_POST['u_gender'];
		   											$date=  date("y-m-d");
		   											$status= "unverified";
		   											$posts="no";
		   											
		   											$getEmail = "select * from users where user_email='$email'";
		   											$runEmail = mysqli_query($conn,$getEmail);
		   											$check=mysqli_num_rows($runEmail);	
													
													
		   											
		   											if($check==1){
		   												         echo "<script>alert('this email is already registered')</script>";
		   												         exit();
		   														}	
																
													if(strlen($password)<6){
																echo "<script>alert('password should be at least 6 characters')</script>";
																exit();
																			}
																			
													
													else{
													        $insert = "insert into users (user_name,user_pass,user_prog,user_gender,user_pic,user_email,reg_date,last_login,status,posts) values ('$name','$password','$program','$sex','default.jpg','$email','$date','$date','unverified','Nill' )";
															$run_insert = mysqli_query($conn,$insert);
															
															if($run_insert){
																			$_SESSION['user_name']=$name;
																			echo "<script>alert('successfully registered')</script>";
																			echo "<script>window.open('home.php','self')</script>";
																			}
															}
		   												}
														
				else{echo("ollen")}
?>