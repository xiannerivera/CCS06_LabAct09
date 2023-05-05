<?php

require "config.php";

use App\Pet;

try {
	Pet::register('Giant', 'Male', '2022-12-12','Ashley', 'ashleym@gmail.com', '555 Apple Street NYC', '09223344567');
	echo "<li>Added 1 pet</li>";

	$pets = [
		[
			'pet_name' => 'Lily',
			'pet_gender' => 'Female',
			'pet_birthday' => '2023-02-02',
			'owner_name' => 'Aj',
			'email' => 'ajcastro@gmail.com',
			'address' => '123 Corn Street NYC',
			'contact' => '0912312322'
		],
		[
			'pet_name' => 'Stuart',
			'pet_gender' => 'Male',
			'pet_birthday' => '2023-01-01',
			'owner_name' => 'Dane',
			'email' => 'danecastillo@gmail.com',
			'address' => '223 Kiwi Street NYC',
			'contact' => '091234567'
		]
	];
	Pet::registerMany($pets);
	echo "<li>Added " . count($pets) . " more pets";
	echo "<br /><a href='index.php'>Proceed to Index Page</a>";

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}

