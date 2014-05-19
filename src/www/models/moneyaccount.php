<?php
	class Moneyaccount extends CI_Model {
		public function __construct() {
			$this->load->database();
		}
		public function addaccount($dealpass, $withdrawpass) {
			$q = $this->db->select("maxMoneyAccountId")
						  ->get("global");
			$r = $q->row_array();
			$id = $r['maxMoneyAccountId'] + 1;
			$this->db->set("maxMoneyAccountId", $id);
			$this->db->update("global");
			$data = array("accountId"=>$id,
			              "dealPassword"=>md5($dealpass),
						  "withDrawPassword"=>md5($withdrawpass));
			$this->db->insert("MoneyAccount", $data);
			return $id;
		}
		public function isMoneyAccountValid($moneyaccount, $withdrawpass) {
			$q = $this->db->select("accountId")
						  ->where("accountId", $moneyaccount)
						  ->where("withDrawPassword", md5($withdrawpass))
						  ->get("MoneyAccount");
			return $q->num_rows() > 0;
		}
		public function addmoney($moneyaccount, $withdrawmoney) {
			$q = $this->db->select("moneyLeft")
					      ->where("accountId", $moneyaccount)
					      ->get("MoneyAccount");
			$r = $q->row_array();
			$withdrawmoney += $r['moneyLeft'];
			$this->db->where("accountId", $moneyaccount);
			$this->db->set("moneyLeft", $withdrawmoney);
			$this->db->update("MoneyAccount");
			return true;
		}
		public function submoney($moneyaccount, $withdrawmoney) {
			$q = $this->db->select("moneyLeft")
					      ->where("accountId", $moneyaccount)
					      ->get("MoneyAccount");
			$r = $q->row_array();
			$r['moneyLeft'] -= $withdrawmoney;
			if ($r['moneyLeft'] < 0) {
				return false;
			}
			$this->db->where("accountId", $moneyaccount);
			$this->db->set("moneyLeft", $r['moneyLeft']);
			$this->db->update("MoneyAccount");
			return true;
		}
		public function changeState($moneyaccount, $state) {
			$this->db->where("accountId", $moneyaccount);
			$this->db->set("accountState", $state);
			$this->db->update("MoneyAccount");
		}
	}
?>