
<html>
<head>
	
<title>Welcome</title>

<?php 
if($this->session->flashdata('error')) {

	echo $this->session->flashdata('error');
}
if($this->session->flashdata('success')) 
{

	echo $this->session->flashdata('success');
}

if($this->session->flashdata('logout'))
{
	echo $this->session->flashdata('logout');
}
?>

	
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
<a href='/loginValidation/log_out'><h2>LOG OUT</h2></a>
<a href='/addEnrollment'><h1>Add course</h1></a>
</body>
</html>