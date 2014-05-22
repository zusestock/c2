<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Dashboard extends CI_Controller {
		var $username;
		var $password;
		var $user_type;
		public function __construct()
        {
            parent::__construct();
            $this->load->library('session');
            $this->username = $this->session->userdata("user");
            $this->password = $this->session->userdata("key");
            $this->load->model("stockaccount");
            $this->load->model("moneyaccount");
            $this->load->model("userinfo");
            if (!$this->userinfo->isUserValid($this->username, $this->password)) {
            	header("location: /login");
            	return;
            }
            $this->data['account_name'] = $this->username;
            $this->data['user_type'] = $this->user_type;
			$this->data['copyright'] = COPYRIGHT;
			define("NORMAL", '0');
			define("CANNTFIND", '1');
			define("DEAD", '2');
        }


		public function index() {
			$this->load->view("dashboard/useraccount/newuser", $this->data);
			// header("location: /dashboard/viewactivitystateone");
		}

		public function newaccount($method = "") {
			if ($_SERVER['REQUEST_METHOD'] == "GET") {
				;// if ($method == "password")
					// $this->data['inputpassword'] = true;
			} else {
				$nationalid = $this->input->post("nationalid", true);
				$stockaccount = $this->input->post("stockaccount", true);
				$error = array();
				if ($method == "checkvalid") {
					if (@$nationalid && $nationalid != "") {
						if (@$stockaccount && $stockaccount != "") {
							if ($this->stockaccount->isStockAccountValid($nationalid, $stockaccount)) {
								$this->data['stockaccount'] = $stockaccount;
								$this->data['inputpassword'] = true;
								$this->data['nationalid'] = $nationalid;
							} else {
								$error[] = "身份证账户不匹配";
							}
						} else {
							$error[] = "证券帐号不为空";
						}
					} else {
						$error[] = "身份证不为空";
					}
				} else if ($method == "updatepassword") {
					$dealpass = $this->input->post("dealpass", true);
					$dealpassagain = $this->input->post("dealpassagain", true);
					$withdrawpass = $this->input->post("withdrawpass", true);
					$withdrawpassagain = $this->input->post("withdrawpassagain", true);
					$this->data['stockaccount'] = $stockaccount;
					$this->data['inputpassword'] = true;
					$this->data['nationalid'] = $nationalid;
					if ($dealpass && $dealpassagain && $withdrawpass && $withdrawpassagain) {
						//if(){ if there has existed moneyaccount 
							if ($dealpass == $dealpassagain) {
								if ($withdrawpassagain == $withdrawpass) {
									//// BUG why not $withdrawpassagain == $withdrawpass?
									$this->data['account'] = $this->moneyaccount->addaccount($dealpass, $withdrawpass);
									$this->stockaccount->setMoneyAccout($stockaccount, $this->data['account']);
								} else {
									$error[] = "取款密码不一样";
								}
							} else {
								$error[] = "交易密码不一样";
							}
						//}wait for zhuge
					} else {
						$error[] = "所有密码必填";
					}
				}
				$this->data['error'] = $error;
			}
			$this->load->view("dashboard/useraccount/newuser", $this->data);
		}

		public function addmoney() {
			if ($_SERVER['REQUEST_METHOD'] == "GET") {
				;
			} else {
				$error = array();
				$moneyaccount = $this->input->post("moneyaccount", true);
				$withdrawpass = $this->input->post("withdrawpass", true);
				$withdrawmoney = $this->input->post("withdrawmoney", true);
				$dealtype = $this->input->post("dealtype", true);
				if ($moneyaccount && $withdrawpass && $withdrawmoney && $dealtype != "") {
					if($this->moneyaccount->getState($moneyaccount)==NORMAL){
						if ($this->moneyaccount->isMoneyAccountValid($moneyaccount, $withdrawpass)) {
							$re = "操作成功";
							if ($dealtype == "1") {
								if (!$this->moneyaccount->addmoney($moneyaccount, $withdrawmoney))
									$re = "增加存款失败";
							} else {
								if (!$this->moneyaccount->submoney($moneyaccount, $withdrawmoney)) {
									$re = "取款失败";
								}
							}
							$error[] = $re;
						} else {
							$error[] = "账户密码不匹配";
	 					}
	 				} else if($this->moneyaccount->getState($moneyaccount)==DEAD){
	 					$error[] = "账户已被注销";
	 				} else if($this->moneyaccount->getState($moneyaccount)==CANNTFIND){
	 					$error[] = "账户挂失中";
	 				}
	 			} else {
					$error[] = "所有都为必填项";
	 			}
				$this->data['error'] = $error;
			}
			$this->load->view("dashboard/money/changemoney", $this->data);
		}

		public function cantfind() {
			$this->data['method'] = "cantfind";
			if ($_SERVER['REQUEST_METHOD'] == "GET") {
				;
			} else {
				$error = array();
				$nationalid = $this->input->post("nationalid", true);
				$moneyaccount = $this->input->post("moneyaccount", true);
				$dealpass = $this->input->post("dealpass", true);
				if ($nationalid && $moneyaccount && $dealpass) {
					if ($this->moneyaccount->isdealMoneyAccountValid($moneyaccount, $dealpass)) {
						if ($this->stockaccount->isNationalIdValid($nationalid, $moneyaccount)) {
							$this->moneyaccount->changeState($moneyaccount, CANNTFIND);
							$this->data['state'] = "挂失中";
						} else {
							$error[] = "账户密码不匹配";
						}
					} else {
						$error[] = "账户密码不匹配";
	 				}
	 			} else {
					$error[] = "所有都为必填项";
	 			}
				$this->data['error'] = $error;
			}
			$this->load->view("dashboard/cantfind/cantfind", $this->data);
		}

		public function atlastfind() {
			$this->data['method'] = "atlastfind";
			if ($_SERVER['REQUEST_METHOD'] == "GET") {
				;
			} else {
				$error = array();
				$nationalid = $this->input->post("nationalid", true);
				$moneyaccount = $this->input->post("moneyaccount", true);
				$withdrawpass = $this->input->post("withdrawpass", true);
				if ($nationalid && $moneyaccount && $withdrawpass) {
					if ($this->moneyaccount->isMoneyAccountValid($moneyaccount, $withdrawpass)) {
						if ($this->stockaccount->isNationalIdValid($nationalid, $moneyaccount)) {
							$this->moneyaccount->changeState($moneyaccount, NORMAL);
							$this->data['state'] = "正常";
						} else {
							$error[] = "账户密码不匹配";
						}
					} else {
						$error[] = "账户密码不匹配";
	 				}
	 			} else {
					$error[] = "所有都为必填项";
	 			}
				$this->data['error'] = $error;
			}
			$this->load->view("dashboard/cantfind/cantfind", $this->data);
		}

		public function atlastnotfind() {
			$this->data['method'] = "atlastnotfind";
			if ($_SERVER['REQUEST_METHOD'] == "GET") {
				;
			} else {
				$error = array();
				$nationalid = $this->input->post("nationalid", true);
				$moneyaccount = $this->input->post("moneyaccount", true);
				$withdrawpass = $this->input->post("withdrawpass", true);
				if ($nationalid && $moneyaccount && $withdrawpass) {
					if ($this->moneyaccount->isMoneyAccountValid($moneyaccount, $withdrawpass)) {
						if ($this->stockaccount->isNationalIdValid($nationalid, $moneyaccount)) {
							$this->moneyaccount->changeState($moneyaccount, DEAD);
							$stock_detail = $this->stockaccount->getStockAccountId($moneyaccount);
							$this->data['state'] = "死亡";
							$this->data['stockaccount'] = $stock_detail['stockaccount'];
							$this->data['inputpassword'] = true;
							$this->data['nationalid'] = $nationalid;
							$this->load->view("dashboard/useraccount/newuser", $this->data);
							return;
						} else {
							$error[] = "账户身份证不匹配";
						}
					} else {
						$error[] = "账户密码不匹配";
	 				}
	 			} else {
					$error[] = "所有都为必填项";
	 			}
				$this->data['error'] = $error;
			}
			$this->load->view("dashboard/cantfind/cantfind", $this->data);
		}

		public function cancelaccount() {
			if ($_SERVER['REQUEST_METHOD'] == "GET") {
				;
			} else {
				$error = array();
				$nationalid = $this->input->post("nationalid", true);
				$moneyaccount = $this->input->post("moneyaccount", true);
				$dealmoneypass = $this->input->post("dealmoneypass", true);
				if ($moneyaccount && $dealmoneypass) {
					if ($this->moneyaccount->isdealMoneyAccountValid($moneyaccount, $dealmoneypass)) {
						if ($this->stockaccount->isNationalIdValid($nationalid, $moneyaccount)) {
							if ($this->moneyaccount->getMoneyLeft($moneyaccount) > 0) {
								$error[] = "请取完余额再进行操作";
							} else {
								$this->moneyaccount->changeState($moneyaccount, DEAD);
								$this->data['success'] = true;
							}
						} else {
							$error[] = "账户身份证不匹配";
						}
					} else {
						$error[] = "账户密码不匹配";
	 				}
	 			} else {
					$error[] = "所有都为必填项";
	 			}
				$this->data['error'] = $error;
			}
			$this->load->view("dashboard/destroy/cancelaccount", $this->data);
		}


		private function getStateWord($state) {
			switch ($state) {
			case NORMAL:
				return "正常状态";
			case DEAD:
				return "已销户";
			case CANNTFIND:
				return "挂失";
			}
		}
		public function change_deal_psd($method = "") {
			if ($_SERVER['REQUEST_METHOD'] == "GET") {
				;// if ($method == "password")
					// $this->data['inputpassword'] = true;
			} else {
				$moneyaccount = $this->input->post("moneyaccount", true);
				$dealpasswdold = $this->input->post("passwdold", true);
				$dealpasswdnew = $this->input->post("passwdnew", true);
				$dealpassagain = $this->input->post("passwdnewagain", true);
				$error = array();

				if ($moneyaccount && $dealpasswdold && $dealpasswdnew && $dealpassagain) {
					
					 if ($this->moneyaccount->isdealMoneyAccountValid($moneyaccount,$dealpasswdold)){
					 	if ( ($state = $this->moneyaccount->getState($moneyaccount)) == NORMAL) {
							if($dealpasswdnew==$dealpassagain){
								//to be continue
								$this->moneyaccount->update_deal_passwd($moneyaccount,$dealpasswdnew);
								$this->data['moneyaccount'] = $moneyaccount;
								$this->data['inputpassword'] = true;
								$this->data['success'] = true;
							}
							else{
								$error[] = "两次输入交易密码不一样";
							}
					 	} else {
							$error[] = "帐号".$tchange_withdraw_psdhis->getStateWord($state);
					 	}
					}
					else{
						$error[] = "账号密码不匹配";	
					}
				}
				else {
					$error[] = "所有都为必填项";
	 			}
				$this->data['error'] = $error;
				$this->data['post'] = true;
			}
			$this->load->view("dashboard/useraccount/change_deal_psd", $this->data);
		}


		public function change_withdraw_psd($method = "") {
			if ($_SERVER['REQUEST_METHOD'] == "GET") {
				;// if ($method == "password")
					// $this->data['inputpassword'] = true;
			} else {
				$moneyaccount = $this->input->post("moneyaccount", true);
				$withdraw_passwdold = $this->input->post("passwdold", true);
				$withdraw_passwdnew = $this->input->post("passwdnew", true);
				$withdraw_passagain = $this->input->post("passwdnewagain", true);
				$error = array();

				if ($moneyaccount && $withdraw_passwdold && $withdraw_passwdnew && $withdraw_passagain) {
					
					 if ($this->moneyaccount->isMoneyAccountValid($moneyaccount,$withdraw_passwdold)){
					 	if ( ($state = $this->moneyaccount->getState($moneyaccount)) == NORMAL) {
							if($withdraw_passwdnew==$withdraw_passagain){
								//to be continue
								$this->moneyaccount->update_withdraw_passwd($moneyaccount,$withdraw_passwdnew);
								$this->data['moneyaccount'] = $moneyaccount;
								$this->data['inputpassword'] = true;
								$this->data['success'] = true;
							}
							else{
								$error[] = "两次输入取款密码不一样";
							}
						} else {
							$error[] = "帐号".$tchange_withdraw_psdhis->getStateWord($state);
						}
					}
					else{
						$error[] = "账号密码不匹配";	
					}
				}
				else {
					$error[] = "所有都为必填项";
	 			}
				$this->data['error'] = $error;
			}
			$this->load->view("dashboard/useraccount/change_withdraw_psd", $this->data);
		}

		public function viewmoneyleft() {
			if ($_SERVER['REQUEST_METHOD'] == "GET") {
			} else {
				$moneyaccount = $this->input->post("moneyaccount", true);
				$withdrawpass = $this->input->post("withdrawpass", true);
				if ($this->moneyaccount->isMoneyAccountValid($moneyaccount, $withdrawpass)) {
					$this->data['left'] = $this->moneyaccount->getMoneyLeft($moneyaccount);
				} else {
					$this->data['error'] = "取款密码不正确";
				}
			}
			$this->load->view("dashboard/useraccount/viewmoneyleft", $this->data);
		}

	}
?>