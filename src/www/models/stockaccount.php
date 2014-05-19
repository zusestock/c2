<?php
	class Stockaccount extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function isNationalIdValid($nationalid, $moneyaccount) {
			$q = $this->db->select("accountId")
						  ->where("nationalId", $nationalid)
						  ->where("moneyAccountId", $moneyaccount)
						  ->get("StockAccount");
			return $q->num_rows() > 0;
		}

		public function isStockAccountValid($nationalid, $stockaccount) {
			$q = $this->db->select("accountId")
						  ->where("nationalId", $nationalid)
						  ->where("accountId", $stockaccount)
						  ->get("StockAccount");
			return $q->num_rows() > 0;
		}

		public function setMoneyAccout($stockaccount, $moneyaccount) {
			$this->db->where("accountId", $stockaccount);
			$this->db->set("moneyAccountId", $moneyaccount);
			$this->db->update("StockAccount");
		}

		public function getStockAccountId($moneyaccount) {
			$q = $this->db->select("accountId")
						  ->where("moneyAccountId", $moneyaccount)
						  ->get("StockAccount");
			$r = $q->num_rows();
			return $r['accountId'];
		}
	}
?>