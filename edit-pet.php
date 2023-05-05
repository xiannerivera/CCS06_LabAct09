<?php

require "config.php";

use App\Pet;

$pet_id = $_GET['id'];

$pet = Pet::getById($pet_id);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Pet</title>
</head>
<body>
<h1>Edit Pet</h1>

<form action="save-changes.php" method="POST">
	<input type="hidden" name="id" value="<?php echo $pet->getId(); ?>">
	<div>
		<label>Pet Name</label>
		<input type="text" name="pet_name" placeholder="Pet Name" value="<?php echo $pet->getPetName();?>" />	
	</div>
	<div>
  <label>Pet Gender</label>
  <input type="radio" name="pet_gender" value="Male" <?php echo $pet->getPetGender() === 'Male' ? 'checked' : ''; ?>> Male
  <input type="radio" name="pet_gender" value="Female" <?php echo $pet->getPetGender() === 'Female' ? 'checked' : ''; ?>> Female
</div>
	<div>
		<label for="birthday">Pet Birthday</label>
		<input type="date" id="birthday" name="birthday" value = "<?php echo $pet->getPetBirthday();?>" />	
	</div>
	<div>
		<label>Owner Name</label>
		<input type="text" name="owner_name" placeholder="Owner Name" value="<?php echo $pet->getOwnerName();?>" />	
	</div>

	<div>
		<label>Email Address</label>
		<input type="email" name="email" placeholder="email@address.com" value="<?php echo $pet->getEmail();?>" />	
	</div>
	<div>
		<label>Address</label>
		<input type="text" name="address" placeholder="Address" value="<?php echo $pet->getAddress();?>" />	
	</div>

	<div>
		<label>Contact</label>
		<input type="text" name="contact" placeholder="Contact" value="<?php echo $pet->getContact();?>" />	
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