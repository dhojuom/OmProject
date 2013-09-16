<?php include_once('header.php');?>
<BR>
<BR>
<div class = "row">
		
		<div class ="col-md-8 col-md-offset-2" >
		<div class="panel panel-default ">
		  <!-- Default panel contents -->
		  <div class="panel-heading"><h2>Organization Profile</h2></div>
		  <!-- Table -->
		  <table class="table">
		    <tr>
							<td width="300"><h4>Organization name</h4></td>
							<td width="300"><h4>Registration Number</h4></td>
							<td width="200"><h4>Email Address</h4></td>
							<td width="300"><h4>Location</h4></td>
							<td width="200"><h4>View Members</h4></td>
							
						</tr>
						
						<tr>
							<td width="300"><?php echo $organization->name;?></td>
							<td width="300"><?php echo $organization->registration_number;?></td>
							<td width="200"><?php echo $organization->email;?></td>
							<td width="300"><?php echo $organization->location;?></td>
							<td width="100"><a href='<?php echo "/members_of_organization/$organization->id";?>'>view_members</a></td>
						</tr>
									
		  </table>
		</div>

		</div>
		</div>
		<br>
		<br>

		<div class = "row">
		<div class ="col-md-8 col-md-offset-2" >
		<div class="panel panel-default ">
		  <!-- Default panel contents -->
		  <div class="panel-heading"><h2> Courses Available</h2></div>
		  <!-- Table -->
		  <table class="table">
		    <tr>
							<td width="300"><h4>Course Name</h4></td>
							<td width="300"><h4>Course Code</h4></td>
							<td width="200"><h4>Category</h4></td>
							<td width="300"><h4>Duration in hours</h4></td>
							<td width="300"><h4>is_active</h4></td>
							<td width="300"><h4>click subscribe</h4></td>
							
						</tr>
						<form method='post'>
							<?php 
								foreach($courses as $course) {
							?>
						
						<tr>
							<td width="300"><?php echo $course->name;?></td>
							<td width="300"><?php echo $course->course_code;?></td>
							<td width="200"><?php echo $course->category;?></td>
							<td width="300"><?php echo $course->duration_hours;?></td>
							<td width="300"><?php echo $course->is_active;?></td>
							<td width="300">
							<input type= "checkbox" name= "check_list[]" value="<?php echo $course->id;?>"><br>
							</td>
						</tr>
						<?php  }?>


		  </table>
		  <div class="col-lg-offset-10">
		  <input type="submit" name="submit" value="submit"></div>					
		</form>


		</div>

		</div>
		</div>

		<div class="row">
			<div class= "col-md-4 col-md-offset-5">
				<?php if(isset($message))
				echo $message;
				?>
			</div>
		</div>

		
		</body>
		</html>