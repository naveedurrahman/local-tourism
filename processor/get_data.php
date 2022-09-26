<?php

class get_data
{
	function __construct()
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		try {

			$this->db = new PDO("mysql:host=$servername;dbname=local_tourism", $username, $password);
			// set the PDO error mode to exception
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// echo "Connection Successfull ";

		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}

	function userRegister()
	{
		try {
			session_start();
			error_reporting(0);
			$name = $_POST['name'];
			$contact = $_POST['number'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$c_password = $_POST['c_password'];

			$filename = $_FILES["image"]["name"];
			$tempname = $_FILES["image"]["tmp_name"];
			$folder = "../images/" . $filename;

			// VALIDATION
			if (!preg_match("/^[a-zA-Z-'\s]+$/", $name)) {
				return "Please Enter a valid Name";
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return "You have entered an invalid email";
			}

			if (!preg_match("/^[0-9]{11}+$/", $contact)) {
				return "Please enter a valid contact number e.g. 0313XXXXXXX";
			}

			if ($password != $c_password)
				return "password confirmation does not match.";

			$password = md5($_POST['password']);

			$check = $this->db->prepare("SELECT FullName FROM users WHERE EmailId = ? LIMIT 1");
			$check->execute(array($email));
			if ($check->rowCount() == 1)
				return "Email already registered";

			if (move_uploaded_file($tempname, $folder)) {
			}

			$query = "INSERT INTO  users(FullName,MobileNumber,EmailId ,image,Password) VALUES(?,?,?,?,?)";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($name, $contact, $email, $filename, $password));

			$query = "SELECT * FROM users WHERE EmailId=? LIMIT 1";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($email));
			$user =  $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($user as $key => $value) {
				$id =  $value['id'];
				$name = $value['FullName'];
				$image = $value['image'];
			}
			session_name("travel");
			session_start();

			$_SESSION['id'] = $id;
			$_SESSION['image'] = $image;
			$_SESSION['user_name'] = $name;
			$_SESSION['user_logged_in'] = true;

			header('location:../index.php');
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}

	function userLogin()
	{
		try {
			$email = $_POST['email'];
			$password = md5($_POST['password']);

			if (empty($email) || empty($password)) {
				return "Please, Enter email and password";
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return "You have entered an invalid email";
			}

			$query = "SELECT * FROM users WHERE EmailId=? AND Password=?";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($email, $password));

			if ($stmt->rowCount() != 1) {
				return "Invalid Credentials";
			}
			$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($user as $key => $value) {
				$id =  $value['id'];
				$name = $value['FullName'];
				$image = $value['image'];
			}

			session_name("travel");
			session_start();

			$_SESSION['id'] = $id;
			$_SESSION['image'] = $image;
			$_SESSION['user_name'] = $name;
			$_SESSION['user_logged_in'] = true;

			header('location:../index.php');
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}

	// add user posts
	function addPost()
	{
		$id = $_SESSION['id'];
		$description = $_POST['description'];
		$location = $_POST['location'];
		$filename = $_FILES["image"]["name"];
		$tempname = $_FILES["image"]["tmp_name"];
		$folder = "images/" . $filename;

		if (move_uploaded_file($tempname, $folder)) {
		} else
			return " Failed to upload image..";

		try {
			$query = "INSERT INTO posts(description, location, p_image, user_id) VALUES(?,?,?,?)";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($description,$location, $filename, $id));
			return "ok";
		} catch (\Throwable $th) {
			var_dump($th->getMessage());
		}
	}
	function getPosts()
	{
		try {
			$query = "SELECT u.FullName, u.image , p.* FROM users u join posts p ON u.id = p.user_id ORDER BY p.id DESC";
			$stmt = $this->db->prepare($query);
			$stmt->execute();

			if ($stmt->rowCount() < 1)
				return [];
			else
				return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}

	function getUserPost()
	{
		$id = $_SESSION['id'];
		$query = "SELECT * FROM posts WHERE user_id=?";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array($id));
		if ($stmt->rowCount() < 1) {
			return [];
		} else {
			return 	$stmt->fetchAll(PDO::FETCH_OBJ);
		}
	}

	function updatePost(){
		$user_id = $_SESSION['id'];
		$post_id = $_POST['post_id'];
		$description = $_POST['description'];
		try {
			$query = "UPDATE posts SET description = ? WHERE id=? and user_id=?";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($description,$post_id,$user_id));
			return 'Post updated succsussfully.';
		} catch (\Throwable $th) {
			echo $th->getMessage();
		}
		
	}

	function getUser()
	{
		$id = $_SESSION['id'];
		$query = "SELECT * FROM users WHERE id=?";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array($id));
		if ($stmt->rowCount() < 1) {
			return [];
		} else {
			return 	$stmt->fetchAll(PDO::FETCH_OBJ);
		}
	}

	function deletePost()
	{
		$id = $_POST['post_id'];
		$query = "DELETE FROM posts WHERE id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array($id));
		return "Record Deleted Successfully";
	}

	function reportPost(){
		$post_id = $_POST['post_id'];
		$user_id = $_POST['user_id'];

		try {

			$query = "SELECT * From reports where post_id = ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($post_id));

			if($stmt->rowCount() < 1){
				$query = "INSERT INTO reports(post_id) VALUES(?)";
				$stmt = $this->db->prepare($query);
				$stmt->execute(array($post_id));
				return 'ok';
			}
			else
				return 'ok';
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}

	// update profile image
	function updateProfileImage()
	{
		$filename = $_FILES["image"]["name"];
		$tempname = $_FILES["image"]["tmp_name"];
		$folder = "images/" . $filename;

		if (move_uploaded_file($tempname, $folder)) {
		} 
		// echo '<pre>' . var_export('Image updated failed', true) . '</pre>';

		$id = $_SESSION['id'];
		$query = "UPDATE users Set `image` = ? WHERE id = ?";
		$stmt = $this->db->prepare($query);
		 $stmt->execute(array( $filename ,$id));
		$_SESSION['image'] =  $filename;
		return 'ok';
	}

	function deleteProfileImage(){
		$id = $_SESSION['id'];
		try {
			$query = "UPDATE users SET image=null WHERE id=?";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($id));
			$_SESSION['image'] =  null;
			return 'ok';
		} catch (\Throwable $th) {
			echo $th->getMessage();
		}
	}
	// update profile name
	function updateProfileName()
	{
		$id = $_SESSION['id'];
		$name = $_POST['name'];
		$query = "UPDATE users Set `FullName` = ? WHERE id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array( $name,$id));
		$_SESSION['user_name'] = $name;
		// echo '<pre>' . var_export('FullName updated Successfully', true) . '</pre>';
		return "Name updated Successfully";
	}

	function change_password(){
		$id = $_SESSION['id'];
		$password = $_POST['password'];
		$new_password = $_POST['new-password'];
		$confirm_password = $_POST['confirm-password'];

		if ($new_password != $confirm_password)
				return "password confirmation does not match.";
		
		$password = md5($password);


		$query = "SELECT * FROM users Where id=? and password=?";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array($id,$password));

		if ($stmt->rowCount() != 1) {
			return "Your Current Password Is Invalid";
		}
		$new_password = md5($new_password);
		$query = "UPDATE users set password=? where id=?";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array($new_password,$id));
		return 'password changed succsussfully';

	}
	function getComments($post_id)
	{
		try {
			$query = "SELECT c.comment, c.created_at, u.FullName, u.image FROM comments c JOIN users u WHERE c.post_id = $post_id and c.user_id = u.id ORDER BY created_at DESC";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			if ($stmt->rowCount() < 1) {
				return [];
			} else {
				return $stmt->fetchAll(PDO::FETCH_OBJ);

				// $data = $stmt->fetchAll(PDO::FETCH_OBJ);
				// echo '<pre>' . var_export($data, true) . '</pre>';
			}
		} catch (\Throwable $th) {
			var_dump($th->getMessage());
		}
	}

	function addComment()
	{
		$user_id = $_POST['user_id'];
		$post_id = $_POST['post_id'];
		$comment = $_POST['comment'];

		if ($comment == "")
			return 'please enter comments';

		try {
			$query = "INSERT INTO comments(user_id,post_id,comment) VALUES(?,?,?)";
			$stmt = $this->db->prepare($query);
			$resp = $stmt->execute(array($user_id, $post_id, $comment));
			if ($resp)
				return 'ok';
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}
	function getSinglePostComments()
	{
		try {
			$post_id = $_POST['post_id'];

			$query =  "SELECT c.comment , u.FullName FROM comments c JOIN users u Where c.post_id = $post_id and c.user_id = u.id ORDER BY c.created_at DESC";
			$stmt = $this->db->prepare($query);
			$stmt->execute();

			if ($stmt->rowCount() < 1) {
				return [];
			} else
				return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}

}