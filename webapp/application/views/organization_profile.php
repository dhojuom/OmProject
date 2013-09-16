<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../bootstrap/ico/favicon.ico">
   
    
    


    <title>welcome</title>

    <!-- Bootstrap core CSS -->
    <link href="../../bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="jumbotron.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<nav class="navbar navbar-default" role="navigation">
		  <!-- Brand and toggle get grouped for better mobile display -->


		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse navbar-ex1-collapse">
		    <ul class="nav navbar-nav">
		      <li class="active"><a href="dashBoard">Home</a></li>
		      <li><a href="enroll_course">Enroll Course</a></li>
		      <li><a href="unenroll_course">Unenroll Course</a></li>
		      <li><a href="activate_course">Activate Courses</a></li>
		      <li><a href="deactivate_course">Deactivate Courses</a></li>
		    </ul>
		    
		    <ul class="nav navbar-nav navbar-right">

			  <div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			      
			    </button>
			    <a class="navbar-brand" href="">View Organization profile</a>
			  </div>
		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		        	<b><?php echo $current_member->first_name." ". $current_member->last_name;?></b>
		        	<b class="caret"></b></a>
		        <ul class="dropdown-menu">
		          <li><a href="../loginValidation/log_out">Sign Out</a></li>
		          <li><a href="#">Account</a></li>
		          <li><a href="#">Detail</a></li>
		        </ul>
		      </li>
		    </ul>
		  </div><!-- /.navbar-collapse -->
		</nav>
		 <br>
		 <br>

		<div class = "row">
		
		<div class ="col-md-4 col-md-offset-3" >
		<div class="panel panel-default ">
		  <!-- Default panel contents -->
		  <div class="panel-heading"><h2>Organizations</h2></div>
		  <!-- Table -->
		  <table class="table">
		    <tr>
							<td width="300"> Name</td>
							<td width="300">Location</td>
							<td width="300">Phone Number</td>
		
						</tr>
						
						
				<tr>
					<td width="300"><?php echo $current_organization->name;?></td>
					<td width="300"><?php echo $current_organization->location;?></td>
					<td width="300"><?php echo $current_organization->phone_number;?></td>
				</tr>
				
									
		  </table>
		</div>

		</div>
		</div>
		<br>
		<br>

		

		
	
		
		    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../bootstrap/js/jquery.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
   
                
  </body>

</html>

