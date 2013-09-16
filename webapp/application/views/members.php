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
		 <br>
		 <br>

		<div class = "row">
		
		<div class ="col-md-4 col-md-offset-3" >
		<div class="panel panel-default ">
		  <!-- Default panel contents -->
		  <div class="panel-heading"><h2>Members</h2></div>
		  <!-- Table -->
		  <table class="table">
		    <tr>
							<td width="300">First Name</td>
							<td width="300">Last Name</td>
		
						</tr>
						
						<?php foreach($organization->members as $member){  ?>
				<tr>
					<td width="300"><?php echo $member->first_name;?></td>
					<td width="300"><?php echo $member->last_name;?></td>
				</tr>
				<?php } ?>	
									
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


