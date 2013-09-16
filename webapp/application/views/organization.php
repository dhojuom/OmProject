<?php include_once('header.php');?>
		 <br>
		 <br>

		<div class = "row">
		
		<div class ="col-md-8 col-md-offset-2" >
		<div class="panel panel-default ">
		  <!-- Default panel contents -->
		  <div class="panel-heading"><h2>Organizations</h2></div>
		  <!-- Table -->
		  <table class="table">
		    <tr>
							<td width="300">Organization Name</td>
							<td width="300">Address</td>
							<td width="200">Email Address</td>
							<td width="300">PhoneNumber</td>
							<td width="100">Members</td>
							<td width="100"></td>
							
						</tr>
						
						<?php foreach($organizations as $organization){  ?>
				<tr>
					<td width="300"><?php echo $organization->name;?></td>
					<td width="300"><?php echo $organization->location;?></td>
					<td width="200"><?php echo $organization->email;?></td>
					<td width="300"><?php echo $organization->phone_number;?></td>
					<td width="100"><a href='<?php echo "/members_of_organization/$organization->id";?>'>view_members</a></td>
					<td width="100"><a href="<?php echo "/subscribe/course_for/organization/$organization->id";?>">Subscribe Course</a></td>
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
   
   
                
  </body>

</html>


