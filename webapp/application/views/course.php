<html>
<head>
	
<title>Welcome</title>	
</head>
<body>


<table width="1200">
				<tr>
					<td width="300">Course Name</td>
					<td width="300">course_code</td>
					<td width="200">Category</td>
					<td width="300">durationInhours</td>
					<td width="100">Members</td>
				</tr>
				<?php foreach($courses as $course){  ?>
				<tr>
					<td width="300"><?php echo $course->name;?></td>
					<td width="300"><?php echo $course->course_code;?></td>
					<td width="200"><?php echo $course->category;?></td>
					<td width="300"><?php echo $course->duration_hours;?></td>
					<td width="100"><a href='<?php echo "view_members/$organization->id";?>'>view_members</a></td>
				</tr>
				<?php } ?>				
</table>




</body>
</html>