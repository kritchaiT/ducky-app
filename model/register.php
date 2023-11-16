<?php
    class Register { 
	private $error = "";

	public function evaluate($data) {
		foreach ($data as $key => $value) {
			if(empty($value) && ($key != 'profile_picture_path' && $key != 'bio')) {
				$this->error .=$key."empty";
			}
		}

		if($this->error == "") {
			return $this->create_user($data);
		} else {
			return $this->error;
		}
	}

	public function create_user($data) {
        require_once("../public/connection.php"); // require a database from this statement
		$name = $data['name'];
		$email = $data['email'];
		$bio = $data['bio'];
		$password = $data['password'];
		$profile_picture_path = $data['profile_picture_path'];
		$is_seller = $data['is_seller'];

		// $hashed_password = password_hash($password, PASSWORD_DEFAULT); // do we have to hash?

		$query = "INSERT INTO users(name, email, bio, password, profile_picture_path, is_seller) VALUES ('$name', '$email', '$bio', '$password', '$profile_picture_path', '$is_seller')";
        $result = mysqli_query($db, $query);

		if ($result === true) {
			return "";
		} else {
			$this->error = $result;
			return $this->error;
		}

	}

}