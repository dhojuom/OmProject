<?php include_once('header.php');?>

<body>
		<div class="container">
						
			
		    <form class="form-signin" method="post">
		    	<h2 class="form-signin-heading">Add Organization</h2>

			    <p>
			        <input type="text" class="form-control" placeholder="Name" name="name" autofocus>
			    </p>
			 
			 	<p>
			        <input type="text" class="form-control" placeholder="Location" name="location">
			    </p>

				<p>
			        <input type="text" class="form-control" placeholder="Registration Number" name="registration_number">
			    </p>

			    <p>
			        <input type="text" class="form-control" placeholder="Phone Number" name="phone_number">
			    </p>
			    <p>
			        <input type="text" class="form-control" placeholder="Email Address" name="email">
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