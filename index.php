<?php

require "config.php";

use App\Student;

$students = Student::list();
?>

<h1>Students</h1>

<table border="1" cellpadding="5">
<?php foreach ($students as $student): ?>
<tr>
<td><?php echo $student->getId(); ?></td>
<td><?php echo $student->getFullName(); ?></td>
<td><?php echo $student->getEmail(); ?></td>
<td>
	<a href="edit-student.php?id=<?php echo $student->getId(); ?>">EDIT</a>
</td>
<td>
	<a href="delete-student.php?id=<?php echo $student->getId(); ?>">DELETE</a>
</td>
</tr>
<?php endforeach ?>
</table>