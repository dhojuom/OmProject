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
echo $organization->name;
echo "\n";
echo "registration_number:\n";
echo $organization->registration_number;
echo "\n";
echo "Email:\n";
echo $organization->email;
echo "\n";
echo "location:\n";
echo $organization->location;
foreach($organization->members as $member)
{
	echo $member->first_name;
	echo $member->last_name;
}

?>
</pre>
<form method='post'>
<?php 
	foreach($courses as $course)
	{ ?>
	<input type= "checkbox" name= "check_list[]" value="<?php echo $course->id;?>"><?php echo $course->name; ?> <br>
	
	<?php } ?>
	<input type="submit" name="submit" value="submit">
</form>

</body>
</html>