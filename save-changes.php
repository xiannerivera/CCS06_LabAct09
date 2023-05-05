<?php

require "config.php";

use App\Pet;

// Save the Pet information, and automatically redirect to index

try {
	$id = $_POST['id'];
	$pet_name = $_POST['pet_name'];
    $pet_gender = $_POST['pet_gender'];
    $pet_birthday = $_POST['birthday'];
    $owner_name = $_POST['owner_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $result = Pet::update($id,$pet_name, $pet_gender, $pet_birthday,$owner_name,$email,$address,$contact);

    if ($result) {
        header('Location: index.php');
		exit;
    } else {
        echo "Error saving changes.";
    }

} catch (PDOException $e) {
    error_log($e->getMessage());
    echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}

?>