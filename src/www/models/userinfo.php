<?php
	class Userinfo extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function isUserValid($username, $password) {
			if (!($username && $password))
				return false;
			$q = $this->db->select("username")
					      ->where("username", $username)
					      ->where("password", $password)
					      ->get("userInfo");
			if ($q->num_rows() > 0)
				return true;
			return false;
		}
	}
?>