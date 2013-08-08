<html>
<head>
<title>My Form</title>
</head>
<body>
<h2> 
<?php 
if($this->session->flashdata('error')) {

	echo $this->session->flashdata('error');
}
if($this->session->flashdata('success')) {

	echo $this->session->flashdata('success');
}
?>

<?php
if(isset($message))
	echo $message; 
?>
</h2>


<form method='post'>
<h5>Username</h5>
<input type="text" name="user_name" value="" size="50" />
<h5>Password</h5>
<input type="password" name="password" value="" size="50" />
<div>
	<input type= "submit" name="submit" value="submit"/>
</div>
</form>
</body>
</html>
