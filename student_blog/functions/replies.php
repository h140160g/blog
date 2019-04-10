<?php
function single_post(){
									global $conn;
									if(isset($_GET['post_id'])){
									$get_id=$_GET['post_id'];
					
									$get_posts="select * from posts where post_id='$get_id'";
									
									$run_posts=mysqli_query($conn,$get_posts);
									
									$row_posts=mysqli_fetch_array($run_posts);
									
									$post_id=$row_posts[ 'post_id' ];
									$user_id=$row_posts[ 'user_id' ];
									$post_title=$row_posts[ 'post_title' ];
									$content=$row_posts[ 'post_content' ];
									$post_date=$row_posts[ 'post_date' ];
									
									
									
									//getting the user who has posted the thread
									$user="select * from users where user_id=' $user_id' ";
								 	
									$run_user=mysqli_query($conn,$user);
									$row_user=mysqli_fetch_array($run_user);
									$user_name=$row_user['user_name'];
									$user_image=$row_user['user_pic'];
									
									
									
									
									//displaying the info	

									echo "<div id='posts'>
								 	
									<p><img src='user/user_images/$user_image' width='48' height='48'></p>
									<h5> <a href='user_profile.php?user_id='$user_id '  >$user_name</a> </h5>
									<p style=' font-size:12px; '>$post_date</p>
									<h4>$post_title</h4>
									<p style=' font-family:Arial, Helvetica, sans-serif; '>$content</p>
									</div>";
									
									echo"
									<form action='' method='post' id='reply'>
									<textarea cols='50' rows='5' placeholder='write comment' name='comment' required='required'></textarea></br>
									<input type='submit' name='reply' value='reply'/>
									
									</form>
									" ;
									//insering a comment 
									
									
									
									if(isset($_POST['reply'])){
														$comment=addslashes($_POST['comment']);
														$insert="insert into comments(post_id,user_id,comment,commentator,date) values('$post_id','$user_id','$comment','$user_name',NOW())";
														$run_insert=mysqli_query($conn,$insert);
														echo"<script> alert('successful') </script>";												
														}
			}						
		
	
	?>	
					