<?php
class Login {
	private $error = "";
	
	#----- function to evalueate login data -----
	public function evaluate($data) {
		foreach ($data as $key=>$value) {
			if (empty($value)) {
				$this->error .=$key."empty";
			}
		
		}

		if ($this->error == "") {
			return $this->login_user($data);
		} else {
			return $this->error;
		}

	} 
	#----------

	#----- function to login user -----
	public function login_user($data) {
		$email = $data['email'];
		$password = $data['password'];

		// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$query = "SELECT email, password, user_id FROM users WHERE email = '$email'";
		$DB = new Database;
		$result = $DB->read($query);
		

		if ($result) {
			$db_password = $result[0]['password'];
		
			if ($db_password == $password) {
				$_SESSION['user_id'] = $result[0]['user_id'];
				return "";
			} else {
				$this->error = "wrong password";
				return $this->error;
			}
		} elseif (empty($result)) {
			$this->error = "user not found";
			return $this->error;

		}

	}
	#----------

	#----- function to check if a user is logged in -----
	public function check_login($id) {
		$query = "SELECT user_id from users WHERE user_id = $id";

		$DB = new Database(); 
		$result = $DB->read($query);

		if ($result) {
			return true;
		}
		return false;
	}
	#----------
}

?>
