<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
 session_start(); 
 include ("functions/function1.php");
 include ("includes/connection.php");
 include ("functions/functions.php");
 if(!isset($_SESSION['user_email'])){
	 header("location:index.php");
	}
	
?>
<html>
<head>
	<title>welcome</title>
	<link rel="stylesheet" href="styles/home_style.css" media="all"/>
</head>

<body >
			<!--container-->
			<div class="container" ">
			<!--head wrap-->
				<div id="head_wrap">
				
				
						<!--header-->
						<div id="header">
							
							 
							 
						    <ul id="menu">
							<li>
							<a href="http://www.uz.ac.zw"> <img border="0" alt="UZ website" src= "images/uzlogo.png"></a>
							</li>
								<li ><a href="home.php">Home</a></li>
								<strong >Topics</strong>
								<?php
								$getTopics="select* from topics";
								$runTopics=mysqli_query($conn,$getTopics);
								
								while($row=mysqli_fetch_array($runTopics)){ 

								$topic_id = $row['topic_id'];
								$topic_title = $row['topic_title'];
								
								echo"<li><a href='topic.php?topic=$topic_id'>$topic_title<a/></li>";

								}
								?>
							<li>
							<form method="get" action="results.php" id="form1">
								<input type="text" name="user_query" placeholder="search topic" size="30"/>
								<input type="submit" name="search" value="search"/>
							 </form>
							 </li>
						     <ul/>
							 
						</div>
							<!--header ends-->	
				</div>
				<!--head wrap ends-->
				<!--content area-->
						<div class="content ">
						<!--timeline-->
							<div id="user_timeline" >
							
									<div id="user_details">
										<?php
										$user= $_SESSION['user_email'];
										$getUser="select * from users where user_email ='$user' ";
										$runUser=mysqli_query($conn,$getUser);
										$row=mysqli_fetch_array($runUser);
										$user_id=$row['user_id'];
										$user_name=$row['user_name'];
										$user_image=$row['user_pic' ];
										$user_prog=$row['user_prog'];
										$user_sex=$row['user_gender'];
										$user_regDate=$row['reg_date'];
										$user_lastLogin=$row['last_login'];
										
										echo"
										<center>
										<img src='user/user_images/$user_image'  width='277' height='300'/>
										</center>
										
										<div id='user_nfo'>
										<p><b>Name:</b>$user_name</p>
										<p><b>Program:</b>$user_prog</p>
										<p><b>Last Login </b>$user_lastLogin</p>
										<p><b>Using blog Since </b>$user_regDate</p>
										
										<p><a href='edit_profile.php?u_id=$user_id'><b>Edit profile</b></a></p>
										<p><a href='my_messages.php?u_id=$user_id'><b>Messages</b></a></p>
										<p><a href='my_posts.php?u_id=$user_id'><b>Posts</b></a></p>
										<p><a href='logout.php'><b>Logout</b></a></p>
										</div>
										";
										
										?>
										
									</div>
									
							</div>
							<!--timeline ends-->
							<!--content timeline-->
							<div id="content_timeline">
								
						
						<form action="" method="post" id="f" class="ff">
							<h2 style="font-family:Comic Sans MS, cursive, sans-serif; padding-bottom:10px; padding-top:20px;">Edit your profile</h2>
							<table >
								<tr>
									<td align="right">Name:</td>
									<td><input type="text" name="u_name" placeholder="enter your name here"/></td>
								</tr>
								<tr>
									<td align="right">Email:</td>
									<td><input type="email" name="u_email" placeholder="enter your email here"/></td>
								</tr>
		
								<tr>
									<td align="right">Password:</td>
									<td><input type="password" name="u_pass" placeholder="enter your new password" /></td>
								</tr>
								
								<tr>
									<td align="right">Repeat Password:</td>
									<td><input type="password" name="u_pass" placeholder="Repeat your new password" /></td>
								</tr>
								
								<tr>
									<td align="right">Profile Picture</td>
									<td><input type="file" name="u_image" /></td>
								</tr>
				
								<tr>
									<td align="right">Program:</td>
									<td><select name="u_prog">
										<option>Select your program</option>
										<option>Medicine</option>
										<option>nursing</option>
										<option>Pharmacy</option>
										<option>Midwifery</option>
										<option>Surgery</option>
										<option>other</option>
									</td>
								</tr>
							
								<tr>
									<td align="right">       </td>
									<td colspan="6">
									<button name="submit">Update</button>
									</td>
								</tr>
						</table>
						<p style="font-family:Comic Sans Ms; padding:20px;">
						
						</p>
					<form/> 
							</div>
							<!--content timeline ends-->
						</div>
						<!--content area ends-->
			</div>
			<!--container ends-->


</body>
</html>
	