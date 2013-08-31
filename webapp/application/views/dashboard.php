
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
echo $current_member->first_name;
echo "\n";
echo "Lastname:\n";
echo $current_member->last_name;
echo "\n";
echo "Email:\n";
echo $current_member->email;
echo "\n";
echo "Organization:\n";
echo $current_organization->name;
?>
</pre>
<a href='../loginValidation/log_out'><h2>LOG OUT</h2></a>
<a href='enroll_course'><h1>Add course</h1></a>
<a href='deactivate_course'><h1>Deactivate Courses</h1></a>
<a href='activate_course'><h1>activate Courses</h1></a>
<a href='unenroll_course'><h1>UnEnroll Courses</h1></a>
</body>
</html>