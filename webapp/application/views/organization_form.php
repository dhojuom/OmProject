<html>
<head>
<title>Organization Form</title>
</head>
<body>

<?php 
if(isset($message))
	echo $message;
?>

<form method='post'>
<h5>Name</h5>
<input type="text" name="name" value="" size="50" />

<h5>Registration No</h5>
<input type="int" name="registration_number" value="" size="50" />

<h5>Location</h5>
<input type="text" name="location" value="" size="50" />

<h5>Phone Number</h5>
<input type="int" name="phone_number" value="" size="50" />


<h5>Email Address</h5>
<input type="text" name="email" value="" size="50" />

<div><input type="submit" value="Submit" /></div>
</form>

</body>
</html>
