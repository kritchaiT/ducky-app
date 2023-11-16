<?php
class Shop {
	private $error = "";

	public function evaluate($data) {
		foreach ($data as $key => $value) {
			if (empty($value) && ($key != 'profile_picture_path' && $key != 'description')) {
				$this->error .=$key."empty";
			}
		}

		if ($this->error == "") {
			return $this->create_shop($data);
		} else {
			return $this->error;
		}
	}

	public function create_shop($data) {
		$user_id = $_SESSION['user_id'];
		$shop_name = $data['shop_name'];
		$description = $data['description'];
		$type = $data['type'];
		// $profile_picture_path = "../shop_imgs/".$shop_name.".".'png';

		$query = "INSERT INTO shops(user_id, shop_name, description, type, profile_picture_path) VALUES ('$user_id', '$shop_name', '$description', '$type', NULL)";

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


?>
