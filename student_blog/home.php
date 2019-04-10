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
								<form action="home.php?id=<?php echo $user_id;?>" method="post" id="f" >
								<h2 style="font-family:Comic Sans MS, cursive, sans-serif; padding-bottom:10px; padding-top:20px;"> post something</h2>
								<input type="text" name="title" placeholder="Subject of post" size="40" required="required"/></br>
								<textarea cols="83" rows="4" name="content" placeholder="....description" required="required"></textarea></br>
								<select name="topic">
									<option>Select Topic</option>
									<?php getTopics() ?>
								</select>
								<input type="submit" name="sub" value="Post"/>
								</form>
								<?php  insertPost(); ?>
								<div id="posts_container">
									<h3 style="font-family:Comic Sans MS, cursive, sans-serif">recent posts</h3>
									<?php getPosts(); ?>
								</div>
							</div>
							<!--content timeline ends-->
						</div>
						<!--content area ends-->
			</div>
			<!--container ends-->


</body>
</html>
	