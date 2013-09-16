<?php include_once('header.php');?>

<body>
		<div class="container">
						
			
		    <form class="form-signin" method="post">
		    	<h2 class="form-signin-heading">Add Course</h2>

			    <p>
			        <input type="text" class="form-control" placeholder="Name" name="name" autofocus>
			    </p>
			 
			 	<p>
			        <input type="text" class="form-control" placeholder="Course Code" name="course_code">
			    </p>

				<p>
			        <input type="text" class="form-control" placeholder="Category" name="category">
			    </p>

			    <p>
			        <input type="text" class="form-control" placeholder="Duration in hours" name="hours">
			    </p>
			    
			 
			    <p>
			    	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Add</button>
			    </p>	
			    <h3><?php 
				if(isset($message))
					echo $message;
			?></h3> 
		    </form>
		    

		    <hr>

		</body>
		</html>