<html>
<head>
<title>Course Form</title>
</head>
<body>

<?php 
if(isset($message))
	echo $message;
?>

<form method='post'>
<h5>Name</h5>
<input type="text" name="name" value="" size="50" />

<h5>CourseCode</h5>
<input type="int" name="course_code" value="" size="50" />

<h5>Category</h5>
<input type="text" name="category" value="" size="50" />

<h5>Duration in hours</h5>
<input type="int" name="hours" value="" size="50" />
<div><input type="submit" value="Submit" /></div>
</form>

</body>
</html>
