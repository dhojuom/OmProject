<html>
<head>
<title>My Form</title>
</head>
<body>

<?php if(isset($message))
echo $message;
?>

<form method='post'>


<h5>FirstName</h5>
<input type="text" name="first_name" value="" size="50" />

<h5>Lastname</h5>
<input type="text" name="last_name" value="" size="50" />

<h5>Username</h5>
<input type="text" name="user_name" value="" size="50" />

<h5>Password</h5>
<input type="password" name="password" value="" size="50" />

<h5>Password Confirm</h5>
<input type="password" name="passconf" value="" size="50" />

<h5>Email Address</h5>
<input type="text" name="email" value="" size="50" />

<h5>Phone Number</h5>
<input type="text" name="phone_number" value="" size="50" />

<h5> Address</h5>
<input type="text" name="address" value="" size="50" />
<h5>Organization</h5>
<select name="organization">
<?php 
	foreach($organizations as $organization)
	{ ?>
	<option value="<?php echo $organization->id; ?>"><?php echo $organization->name ;?>
	</option>
	<?php } ?>
</select>
<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>
