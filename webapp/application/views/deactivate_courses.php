<?php 
if(isset($message))
	echo $message;
?>

<html>
<head>
	
<title>Welcome</title>	
</head>
<body>
<?php

echo $current_member->first_name;
echo $current_member->last_name;
?>
<h1>click the courses you want to deactivate</h1>


	<form method='post'>
<?php 
	foreach($enrollments as $enrollment)
	{ if($enrollment->is_active && !$enrollment->is_deleted){ ?>
	<input type= "checkbox" name= "check_list[]" value="<?php echo $enrollment->course->id;?>"><?php echo $enrollment->course->name; ?> <br>
	
	<?php }
	continue;
	} ?>
	<input type="submit" name="submit" value="submit">
</form>
 


</body>
</html>