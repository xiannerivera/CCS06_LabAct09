<?php

require "config.php";

use App\Student;

$student_id = $_GET['id'];

$student = Student::getById($student_id);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Student</title>
</head>
<body>
<h1>Edit Student</h1>

<form action="save-changes.php" method="POST">
	<input type="hidden" name="id" value="<?php echo $student->getId(); ?>">
	<div>
		<label>First Name</label>
		<input type="text" name="first_name" placeholder="First Name" value="<?php echo $student->getFirstName();?>" />	
	</div>
	<div>
		<label>Last Name</label>
		<input type="text" name="last_name" placeholder="Last Name" value="<?php echo $student->getLastName();?>" />	
	</div>
	<div>
		<label>Email Address</label>
		<input type="email" name="email" placeholder="email@address.com" value="<?php echo $student->getEmail();?>" />	
	</div>
	<div>
		<button>
			Save
		</button>
		<a href="index.php">Cancel</a>
	</div>
</form>
</body>
</html>