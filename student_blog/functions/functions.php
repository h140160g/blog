<?php
		$conn=mysqli_connect("localhost","root","","chsblog") or die("failed to connect");
//function to get topics in database
		function getTopics(){
		global $conn;
		$getTopics="select* from topics";
								$runTopics=mysqli_query($conn,$getTopics);
								
					while($row=mysqli_fetch_array($runTopics)){ 

								$topic_id = $row['topic_id'];
								$topic_title = $row['topic_title'];
								
								echo"<option value='$topic_id' >$topic_title</option>";

								}
		}
		
//function for inserting posts into database
		function insertPost(){
									
								global $user_id;
								
									
		
									
									if (isset($_POST['sub'])){
									global $conn;
									global $user_id;
									
										$title=  addslashes($_POST['title']);
										$content=addslashes($_POST['content']) ;
										$topic=$_POST['topic'];
										
										if($user_id==''){
										
										
										header("location: index1.php");
									}
										else{
										$insert= "insert into posts(user_id,topic_id,post_title,post_content,post_date) 
														values('$user_id','$topic','$title','$content',NOW())";
										$run=mysqli_query($conn,$insert);
										if($run){
										
										$update="update users set posts='yes' where user_id='$user_id'";
										$run_update=mysqli_query($conn,$update);
										header("location: home.php");

											}
										}
										}
		
		}
									
//function for displaying posts
			function getPosts(){
									
									global $conn;
									$per_page=100;
									
									if(isset($_GET['page'])){
									
									}
									else{
										$page=1;
									}
									$page=1;
									$start_from =($page-1) * $per_page;
									
									$get_posts="select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";
									
									$run_posts=mysqli_query($conn,$get_posts);
									
									while($row_posts=mysqli_fetch_array($run_posts)){
									
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
									<p style=' font-family:Arial, Helvetica, sans-serif; padding-top:20px; '>$content</p>
									<a href=' single.php?post_id=$post_id ' style=' float:right; '><button>replies</button></a>
									
									</div><br/>" ;

									
									}
							
		include("pagination.php");
			}

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
									
									//getting the user session
									$user_com = $_SESSION['user_email'];
									$get_com = "select * from users where user_email ='$user_com' ";
									$run_com = mysqli_query($conn,$get_com);
									$row_com=mysqli_fetch_array($run_com);
									$user_com_id=$row_com['user_id'];
									$user_com_name=$row_com['user_name'];
									
									
									//displaying the info	

									echo "<div id='posts'>
								 	
									<p><img src='user/user_images/$user_image' width='48' height='48'></p>
									<h5> <a href='user_profile.php?user_id='$user_id '  >$user_name</a> </h5>
									<p style=' font-size:12px; '>$post_date</p>
									<h4>$post_title</h4>
									<p style=' font-family:Arial, Helvetica, sans-serif '>$content</p>
									</div>";
									
									include("comments.php");
									
									echo"
									<form action='' method='post' id='reply'>
									<textarea cols='50' rows='5' placeholder='write comment' name='comment' required='required'></textarea></br>
									<input type='submit' name='reply' value='reply'/>
									
									</form>
									" ; 
									
									//insering a comment 
									
									
									
									if(isset($_POST['reply'])){
														$comment=$_POST['comment'];
														
														$insert="insert into comments(post_id,user_id,comment,commentator,date) values('$post_id','$user_com_id','$comment','$user_com_name',NOW())";
														$run_insert=mysqli_query($conn,$insert);
														header("location: single.php?post_id=$post_id");
														
														}
			}						
		
	
		
					
		}
	

//getting topics
function getCats(){
									
									global $conn;
									$per_page=100;
									
									if(isset($_GET['page'])){
									
									}
									else{
										$page=1;
									}
									$page=1;
									$start_from =($page-1) * $per_page;
									
									if(isset($_GET['topic']))
										
										$topic_id = $_GET['topic'];
										
									
									$get_posts="select * from posts where topic_id='$topic_id' ";
									
									$run_posts=mysqli_query($conn,$get_posts);
									
									while($row_posts=mysqli_fetch_array($run_posts)){
									
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
									<p style=' font-family:Arial, Helvetica, sans-serif '>$content</p>
									<a href=' single.php?post_id=$post_id ' style=' float:right; '><button>replies</button></a>
									
									</div><br/>" ;

									
									}
							
									include("pagination.php");	
									}
									

		
			function getResults(){
									
									global $conn;
									
									
									if(isset($_GET['user_query']))
										
										$search_term = $_GET['user_query'];
										
									
									$get_posts="select * from posts where post_title like '%$search_term%' OR post_content like '%$search_term%' ORDER by 1 DESC LIMIT 5";
									
									$run_posts=mysqli_query($conn,$get_posts);
									
									while($row_posts=mysqli_fetch_array($run_posts)){
									
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
									<p style=' font-family:Arial, Helvetica, sans-serif '>$content</p>
									<a href=' single.php?post_id=$post_id ' style=' float:right; '><button>replies</button></a>
									
									</div><br/>" ;

									
									}
			}
?>