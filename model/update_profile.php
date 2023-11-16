<?php
class Update_profile {

	private $error = "";

	public function evaluate($data) {
		foreach ($data as $key => $value) {
			if(empty($value) && ($key != 'profile_picture_path' && $key != 'bio')) {
				$this->error .=$key."empty";
			}
		}
		if($this->error == "") {
			// return $data;
			return $this->update_profile($data);
		} else {
			return $this->error;
		}
	}

	public function update_profile($data) {
		$user_id = $_SESSION['user_id'];
		$name = $data['name'];
		$bio = $data['bio'];
		$password = $data['password'];
		// $profile_picture_path = $data['profile_picture_path'];

		// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$query = "UPDATE users SET name='$name', bio='$bio', password='$password' WHERE user_id=$user_id";

		$DB = new Database();
		$result = $DB->save($query);

		if ($result === true) {
			return "";
		} else {
			$this->error = $result;
			return $this->error;

		}

	}

}
