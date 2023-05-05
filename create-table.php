<?php

require "config.php";

try {
	$sql_users = "
	CREATE TABLE IF NOT EXISTS pets (
		id INT AUTO_INCREMENT PRIMARY KEY,
		pet_name VARCHAR(50) NOT NULL,
		pet_gender VARCHAR(6) NOT NULL,
		pet_birthday VARCHAR (10) NOT NULL,
		owner_name VARCHAR(50) NOT NULL,
		email VARCHAR(100) UNIQUE NOT NULL,
		address VARCHAR(255) NOT NULL,
		contact VARCHAR(20) NOT NULL,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
";
	$conn->exec($sql_users);
	echo "<li>Created pets table";

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}
