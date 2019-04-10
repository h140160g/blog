<?php
		$get_id=$_GET['post_id'];
					
		$get_com="select * from comments where post_id='$get_id' ";
									
		$run_com=mysqli_query($conn,$get_com);
		while($row=mysqli_fetch_array($run_com)){
			
			$com=$row['comment'];
			$com_name=$row['commentator'];
			$date= $row['date'];
			
			echo"
				<div id='comments'>
				<h3>$com_name </h3> <h6>$date</h6>
				<p>$com</p>
				</div>
			";
			
		}
?>