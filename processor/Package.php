<?php
class Package
{
	function __construct()
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		try {
			$this->db = new PDO("mysql:host=$servername;dbname=local_tourism", $username, $password);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	} //End of constructor


	// Get all packages
	function get_packages()
	{
		try {
			$date = time();
			$query = "SELECT * FROM packages where closing_date > ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($date));
			if ($stmt->rowCount() < 1)
				return [];
			else
				return 	$stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}

	// Get single package
	function get_package($id)
	{
		$query = "SELECT * FROM packages WHERE PackageId = ? ";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array($id));
		if ($stmt->rowCount() < 1)
			return [];
		else
			return 	$stmt->fetchAll(PDO::FETCH_OBJ);
	}

	function cancel_booking($id)
	{
		try {
			$status = 2;
			$query = "UPDATE booking SET status=? WHERE id=?";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($status, $id));
			return 'done';
		} catch (\Throwable $th) {
		  return  var_dump($th->getMessage());
		}
	}

	function booking_request()
	{
		$package_id = $_POST['package_id'];
		$user_id = $_POST['user_id'];
		$comment = $_POST['comment'];

		try {
			$query = "INSERT INTO booking(package_id,user_id,comment) VALUES(?,?,?)";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($package_id, $user_id, $comment));
			return 'Your Booking Request Has Been added we will Contact you soon.';
		} catch (\Throwable $th) {
			echo $th->getMessage();
		}
	}

	function get_single_user_booking($user_id)
	{
		try {
			$query = "SELECT b.* , p.* from booking b join packages p on p.PackageId=b.package_id 
			          WHERE b.user_id= ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($user_id));

			if ($stmt->rowCount() < 1)
				return [];
			else
				return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (\Throwable $th) {
			echo $th->getMessage();
		}
	}
}
