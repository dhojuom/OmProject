<html>
<head>
	
<title>Welcome</title>	
</head>
<body>


<table width="1200">
				<tr>
					<td width="300">Course Name</td>
					<td width="200">Category</td>
					<td width="300">Duration</td>
					<td width="100">Members</td>
				</tr>
				<?php foreach($courses as $course){  ?>
				<tr>
					<td width="300"><?= $course->name;?></td>
					<td width="200"><?=$course->category;?></td>
					<td width="300"><?=$course->duration_hours;?></td>
					<td width="100"><a href="<?php echo "/courseSignup/view_members/$course->id";?>">view members</a></a></td>
				</tr>
				<?php } ?>				
</table>