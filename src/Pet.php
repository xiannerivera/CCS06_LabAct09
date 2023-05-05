<?php
namespace App;
use PDO;
use PDOException;

class Pet
{
	protected $id;
	protected $pet_name;
	protected $pet_gender;
	protected $pet_birthday;
	protected $owner_name;
	protected $email;
	protected $address;
	protected $contact;
	protected $created_at;

	public function getId()
	{
		return $this->id;
	}

	public function getPetName()
	{
		return $this->pet_name;
	}

	public function getPetGender()
	{
		return $this->pet_gender;
	}

	public function getPetBirthday()
	{
		return $this->pet_birthday;
	}

	public function getOwnerName()
	{
		return $this->owner_name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function getContact()
	{
		return $this->contact;
	}

	public static function list()
	{
		global $conn;

		try {
			$sql = 'SELECT * FROM pets';
			$statement = $conn->query($sql);
			
			$pets = [];
			while ($row = $statement->fetchObject('App\Pet')) {
				array_push($pets, $row);
			}

			return $pets;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function getById($id)
	{
		global $conn;

		try {
			$sql = "
				SELECT * FROM pets
				WHERE id=:id
				LIMIT 1
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'id' => $id
			]);
			$result = $statement->fetchObject('App\Pet');
			return $result;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function register($pet_name, $pet_gender, $pet_birthday,$owner_name,$email,$address,$contact)
	{
		global $conn;

		try {
			$sql = "
				INSERT INTO pets (pet_name, pet_gender, pet_birthday, owner_name, email, address, contact)
				VALUES ('$pet_name', '$pet_gender', '$pet_birthday','$owner_name','$email','$address','$contact')
			";
			$conn->exec($sql);

			return $conn->lastInsertId();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function registerMany($pets)
	{
		global $conn;

		try {
			foreach ($pets as $pet) {
				$sql = "
					INSERT INTO pets
					SET
						pet_name=\"{$pet['pet_name']}\",
						pet_gender=\"{$pet['pet_gender']}\",
						pet_birthday=\"{$pet['pet_birthday']}\",
						owner_name=\"{$pet['owner_name']}\",
						email=\"{$pet['email']}\",
						address=\"{$pet['address']}\",
						contact=\"{$pet['contact']}\"
				";
				$conn->exec($sql);
			}
			return true;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function update($id, $pet_name, $pet_gender, $pet_birthday, $owner_name, $email, $address, $contact)
{
    global $conn;

    try {
        $sql = "
            UPDATE pets
            SET
                pet_name = ?,
                pet_gender = ?,
                pet_birthday = ?,
                owner_name = ?,
                email = ?,
                address = ?,
                contact = ?
            WHERE id = ?
        ";
        $statement = $conn->prepare($sql);
        return $statement->execute([
            $pet_name, 
            $pet_gender,
            $pet_birthday,
            $owner_name,
            $email,
            $address,
            $contact,
            $id
        ]);
    } catch (PDOException $e) {
        error_log($e->getMessage());
    }

    return false;
}

	public static function updateUsingPlaceholder($pet_name, $pet_gender, $pet_birthday,$owner_name,$email,$address,$contact)
	{
		global $conn;

		try {
			$sql = "
				UPDATE pets
				SET
					pet_name=:pet_name,
					pet_gender=:pet_gender,
					pet_birthday=:pet_birthday,
					owner_name=:owner_name,
					email=:email,
					address=:address,
					contact=:contact
				WHERE id=:id
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				'pet_name' => $pet_name,
				'pet_gender' => $pet_gender,
				'pet_birthday' => $pet_birthday,
				'owner_name' => $owner_name,
				'email' => $email,
				'address' => $address,
				'contact' => $contact,
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function deleteById($id)
	{
		global $conn;

		try {
			$sql = "
				DELETE FROM pets
				WHERE id=:id
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				'id' => $id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function clearTable()
	{
		global $conn;

		try {
			$sql = "TRUNCATE TABLE pets";
			$statement = $conn->prepare($sql);
			return $statement->execute();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}
}