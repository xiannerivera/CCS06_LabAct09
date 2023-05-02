<?php

require "config.php";

use App\Student;

try {
	Student::register('Richard', 'Feynman', 'richard@feynman.com');
	echo "<li>Added 1 student";

	$students = [
		[
			'first_name' => 'Albert',
			'last_name' => 'Einstein',
			'email' => 'albert@einstein.com'
		],
		[
			'first_name' => 'Paul',
			'last_name' => 'Erdos',
			'email' => 'paul@erdos.com'
		]
	];
	Student::registerMany($students);
	echo "<li>Added " . count($students) . " more students";
	echo "<br /><a href='index.php'>Proceed to Index Page</a>";

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}

