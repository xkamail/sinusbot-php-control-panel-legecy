<?php
//MID: SE17042422
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller {
	public function wallet(){
		global $Auth;
        $usernameTW = "xjoops@gmail.com";
        $passwordTW = "Qq0912871659";
        $mobileNumber = "0800543635";
        $truewallet = new TrueWallet($usernameTW,$passwordTW);
       try{
           $a = ($truewallet->RequestLoginOTP());
           Alert(false,$a);

       }catch (Exception $e){
           Alert(false,$e);
       }
		exit();
		if(!$Auth){
		  $tel = $this->input->post("telephone",true);
			$reference_id = $this->input->post("refer",true);
			$amount = $this->input->post("amount",true);
			$truewallet = new TrueWallet($usernameTW,$passwordTW);
            print_r($truewallet->RequestLoginOTP());

            // $truewallet->SubmitLoginOTP($OTP,$mobileNumber,$OTP_REFERENCE);
           return $referenceToken = $truewallet->reference_token;
            $transactions = $tw->getTransaction(50); // Fetch last 50 transactions. (within the last 30 days)
            foreach ($transactions["data"]["activities"] as $report) {
                // Fetch transaction details.
                print_r($tw->GetTransactionReport($report["report_id"]));
            }
            $truewallet = new TrueWallet("","",$referenceToken);
        }
		return Alert(false,"กรุณาเข้าสู่ระบบสมาชิก เพื่อดำเนินการต่อ");
	}
	public function truemoney(){
		global $Auth;
		if($Auth){
			$truemoney = $this->input->post("truemoney",true);
			if(is_numeric($truemoney) && strlen($truemoney) == 14){
				try {
					$resp = site_url('tmpay_resp.php');
					$res = file_get_contents('https://www.tmpay.net/TPG/backend.php?merchant_id=OF17040821&password='.$truemoney.'&resp_url='.$resp);
					$res = explode('|', $res);
					if($res[0] == 'SUCCEED'){
						$insert = array($res[1],$Auth['uid'],'0',$truemoney,$_SERVER['REMOTE_ADDR'],'pending','รอดำเนินการ');
						query("INSERT INTO `payment_tmpay` ( `txid`, `owner_id`, `amount`, `truemoney`, `ip`, `status`, `msg`) VALUES (?, ?, ?, ?, ?, ?, ?);",$insert);
						Alert("checktruemoney",NULL,array("txid" => $res[1]));
					}else{
						switch($res[1]){
							case 'INVALID_PASSWORD':
							Alert(false,'รหัสบัตรทรูมันนี่ไม่ถูกต้อง');
							break;
							default:
							Alert(false,'ระบบทรูมันนี่ผิดพลาดเกิดจาก: '.$res[1]);
							break;
						}
					}
				} catch (Exception $e) {
					Alert(false,"ERROR TRUEMONEY (12)");
				}
			}else{
				Alert(false,"รหัสบัตรทรูมันนี่ไม่ถูกต้อง");
			}
		}else{
			Alert(false,"กรุณาเข้าสู่ระบบสมาชิก เพื่อดำเนินการต่อ");
		}
	}
	public function truemoney_status($txid){
		global $Auth;
		if($Auth){
			$q = query("SELECT * FROM `payment_tmpay` WHERE `txid` = ?",array($txid))->fetch();
			if($q['status'] == "pending"){
				Alert(false,"pending");
			}
			if($q['status'] == 1){
				Alert(true,"สำเร็จ! รหัสบัตรเงินสดทรูมันนี่ถูกต้อง");
			}
			if($q['status'] == 3){
				Alert(true,"ไม่สำเร็จ! รหัสบัตรเงินสดถูกใช้ไปเเล้ว");
			}
			if($q['status'] == 4){
				Alert(true,"ไม่สำเร็จ! รหัสบัตรเงินสดไม่ถูกต้อง");
			}
			if($q['status'] == 5){
				Alert(true,"ไม่สำเร็จ! รหัสบัตรทรูมูฟไม่ใช่บัตรทรูมันนี่");
			}
		}else{
			exit('NOT ALLOW');
		}
	}
}