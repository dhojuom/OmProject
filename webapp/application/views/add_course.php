
<?php if(isset($message))
echo $message;
?>
<html>
<head>
	
<title>Welcome</title>
</head>
<body>

<pre>
<?php
echo "Firstname:\n";
echo $member->first_name;
echo "\n";
echo "Lastname:\n";
echo $member->last_name;
echo "\n";
echo "Email:\n";
echo $member->email;
echo "\n";
echo "Organization:\n";
echo $member->organization->name;
?>
</pre>
<form method='post'>
<?php 
	foreach($enrollments as $enrollment)
	{ $course= Course::find_by_id($enrollment->course_id)?>
	<input type= "checkbox" name= "check_list[]" value="<?php echo $course->id;?>"><?php echo $course->name; ?> <br>
	
	<?php } ?>
	<input type="submit" name="submit" value="submit">
</form>
<a href='/loginValidation/log_out'><h2>LOG OUT</h2></a>

</body>
</html>