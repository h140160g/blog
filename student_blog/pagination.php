<?php
		$query="select * from posts";
		$result = mysqli_query($conn,$query);
		
		//count total records
		
		$total_posts=mysqli_num_rows($result);
		
		//using ceil function to devide the total records per page
		
		$total_pages = ceil($total_posts/$per_page);
		
		//going to first page
		
		echo"
		<centre>
		<div id=' pagination ' style='padding-top:20px'>
		<a href=' home.php?page=1 '>first page</a>
		
		";

		for($i=1; $i<=$total_pages; $i++){
		echo "<a href=' home.php?page=$i '>$i</a>";
				
		}
		
		//going to last page
		echo"<a href='home.php?page=$total_pages'>last page</a></centre></div>"


?>