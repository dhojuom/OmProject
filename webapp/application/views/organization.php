<html>
<head>
	
<title>Welcome</title>	
</head>
<body>


<table width="1200">
				<tr>
					<td width="300">Organization Name</td>
					<td width="300">Address</td>
					<td width="200">Email Address</td>
					<td width="300">PhoneNumber</td>
					<td width="100">Members</td>
				</tr>
				<?php foreach($organizations as $organization){  ?>
				<tr>
					<td width="300"><?php echo $organization->name;?></td>
					<td width="300"><?php echo $organization->location;?></td>
					<td width="200"><?php echo $organization->email;?></td>
					<td width="300"><?php echo $organization->phone_number;?></td>
					<td width="100"><a href='<?php echo "view_members/$organization->id";?>'>view_members</a></td>
				</tr>
				<?php } ?>				
</table>
<?php echo $organization->name;?>
<?php echo $organization->email;?>
<a href="<?php echo "/subscribeCourse/add_org_enrollment/$organization->id";?>"><h1>Subscribe Course</h1></a>



</body>
</html>