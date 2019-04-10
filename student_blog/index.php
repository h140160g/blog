<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
 session_start(); 
 include ("functions/function1.php");
 include ("includes/connection.php");
 include ("functions/functions.php");
 include ("login.php")
?>
<html>
<head>
	<title>welcome</title>
	<link rel="stylesheet" href="styles/home_style.css" media="all"/>
</head>

<body>
			<!--container-->
		
			<!--head wrap-->
				<div id="head_wrap">
				
				
						<!--header-->
						<div id="header">
						     <ul id="menu">
							<li> 
							<a href="http://www.uz.ac.zw"> <img border="0" alt="UZ website" src= "images/uzlogo.png"></a>
							</li>
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
								<form method="get" action="results.php" id="form1">
								<input type="text" name="user_query" placeholder="search topic" size="30"/>	
								<input type="submit" name="search" value="search"/>
							 </form>
							 
						     <ul/>
							 
							 
						</div>
							<!--header ends-->	
				</div>
				<!--head wrap ends-->
					<div class="container">
				<!--content area-->
						<div class="content ">

							
							<!--timeline ends-->
							<!--content timeline-->
							<div id="content_timeline">
								<div id="logging">
								<form method="post" action="" id="form3">
								<strong>Email:</strong>
								<input type="email" name="email" placeholder="email" />
								<strong>Password:</strong>
								<input type="password" name="pass" placeholder="*****" />
								<button name="login">login</button>
								</form>
								</div>
								
								
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
