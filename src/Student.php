<?php

namespace App;

use PDO;

class Student
{
	protected $id;
	protected $first_name;
	protected $last_name;
	protected $email;
	protected $created_at;

	public function getId()
	{
		return $this->id;
	}

	public function getFullName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public function getFirstName()
	{
		return $this->first_name;
	}

	public function getLastName()
	{
		return $this->last_name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public static function list()
	{
		global $conn;

		try {
			$sql = "SELECT * FROM students";
			$statement = $conn->query($sql);
			
			$students = [];
			while ($row = $statement->fetchObject('App\Student')) {
				array_push($students, $row);
			}

			return $students;
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
				SELECT * FROM students
				WHERE id=:id
				LIMIT 1
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'id' => $id
			]);
			$result = $statement->fetchObject('App\Student');
			return $result;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function register($first_name, $last_name, $email)
	{
		global $conn;

		try {
			$sql = "
				INSERT INTO students (first_name, last_name, email)
				VALUES ('$first_name', '$last_name', '$email')
			";
			$conn->exec($sql);

			return $conn->lastInsertId();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function registerMany($users)
	{
		global $conn;

		try {
			foreach ($users as $user) {
				$sql = "
					INSERT INTO students
					SET
						first_name=\"{$user['first_name']}\",
						last_name=\"{$user['last_name']}\",
						email=\"{$user['email']}\"
				";
				$conn->exec($sql);
			}
			return true;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function update($id, $first_name, $last_name, $email)
	{
		global $conn;

		try {
			$sql = "
				UPDATE students
				SET
					first_name=?,
					last_name=?,
					email=?
				WHERE id=?
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				$first_name,
				$last_name,
				$email,
				$id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function updateUsingPlaceholder($id, $first_name, $last_name, $email)
	{
		global $conn;

		try {
			$sql = "
				UPDATE students
				SET
					first_name=:first_name,
					last_name=:last_name,
					email=:email
				WHERE id=:id
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email' => $email,
				'id' => $id
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
				DELETE FROM students
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
			$sql = "TRUNCATE TABLE students";
			$statement = $conn->prepare($sql);
			return $statement->execute();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}
}