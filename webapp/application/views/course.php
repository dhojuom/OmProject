<html>
<head>
	
<title>Welcome</title>	
</head>
<body>
<?php

echo $member->first_name;
echo $member->last_name;
?>
<h1>Courses enrolled</h1>
<?php
foreach($enrollments as $enrollment)
{ if($enrollment->is_active){		?>

<h2><?php echo $enrollment->course->name; ?></h2> 
<h2><?php echo $enrollment->is_active; ?></h2> 
<h2><?php echo $enrollment->course->course_code; ?></h2>
<?php 
}
continue;
}
?>


</body>
</html>