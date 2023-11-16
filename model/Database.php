<?php
class Database {
	private $host = "127.0.0.1";
	private $dbname = "t66g9";
	private $username = "t66g9";
	private $password = "t66g9";

	public function connect() {
		$connection = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
		return $connection;
	}

	#----- function to read from sql database -----
	public function read($query) {
		$conn = $this->connect();

		try {
			$result = mysqli_query($conn, $query);
			if($result) {
				$data = false;

				while($row = mysqli_fetch_assoc($result)) {
					$data[] = $row;
				}
				$conn->close();
				return $data;

			} else {
				throw new mysqli_sql_exception("Database read Error: $conn->error");
			}
		} catch (mysqli_sql_exception $e) {
			$conn->close();
			return $e->getMessage();
		}
	}
	#----------

	#----- function to save to SQL server ------
	public function save($query) {
		$conn = $this->connect();

		try {
			$result =$conn->query($query);
			if ($result) {
				$conn->close();
				return true;
			} else {
				throw new mysqli_sql_exception("Database Save Error: $conn->error");

			}
		} catch (mysqli_sql_exception $e) {
			$conn->close();
			return $e->getMessage();
		}
	}
	#----------
}

/* $query = "SELECT email, password FROM users WHERE email = 'b@s.com'"; */
/* $DB = new Database; */
/* $result = $DB->read($query); */
/* print_r($result[0]['email']); */

