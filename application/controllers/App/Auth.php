<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function login(){
		global $Auth;
		global $Main;
		if(!$Auth){
			$u = $this->input->post("username",true);
			$p = $this->input->post("password", true);
			$q = query("SELECT * FROM `member` WHERE `username` = ?",array($u));
			if($q->rowCount()==1){
				$q = $q->fetch();
				if($q['password'] == $p){
					$s = random(100);
					query("UPDATE `member` SET `session` = ? WHERE `uid` = ?",array($s,$q['uid']));
					$_SESSION['Auth'] = $s;
					Alert(true,"เข้าสู่ระบบสำเร็จ",array("redirect" => site_url()));
					return true;
				}else{
					Alert(false,"ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
					return false;
				}
			}else{
				Alert(false,"ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
				return false;;
			}
		}else{
			Alert(false,'กรุณาออกจากระบบ');
		}
	}
	public function logout(){
		global $Auth;
		session_destroy();
		rdr(base_url());
	}
	public function info(){
		global $Main;
		global $Auth;
		if($Auth){
			Alert(true,$Auth['point']);
		}else{
			exit('PLEASE LOGIN');
		}
	}
	public function register(){
		global $Auth;
		global $Main;
		if(!$Auth){
			$u = $this->input->post("username",true);
			$p = $this->input->post("password",true);
			$rep = $this->input->post("repassword",true);
			$email = $this->input->post("email",true);
			if(strlen($u) < 6){
				Alert(false,"ชื่อผู้ใช้ ความยาวต้องมากกว่า 6 ตัวขึ้นไป");
			}
			if(strlen($p) < 6){
				Alert(false,"รหัสผ่าน ความยาวต้องมากกว่า 6 ตัวขึ้นไป");
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				Alert(false,"กรุณากรอกอีเมล์ให้ถูกต้อง");
			}
			if($rep!=$p){
				Alert(false,"กรุณากรอกรหัสผ่านให้ตรงกัน");
			}
			$q = query("SELECT * FROM `member` WHERE `username` = ?",array($u));
			if($q->rowCount()==0){
				try {
					$ses = random(50);
					$insert = array(
						$u,
						$p,
						0,
						$ses,
						$email,
						'member'
						);
					query("INSERT INTO `member` (`username`, `password`, `point`, `session`, `email`, `rank`) VALUES (?, ?, ?, ?, ?, ?);",$insert);
					$_SESSION['Auth'] = $ses;
					Alert(true,"สมัคสมาชิกเรียบร้อย",array("redirect" => "reload"));
				} catch (Exception $e) {
					Alert(false,$e);
				}
			}else{
				Alert(false,"ชื่อผู้ใช้ดังกล่าวได้ถูกใช้ไปเเล้ว");
			}
		}else{
			Alert(false,"กรุณาออกจากระบบ");
		}
	}
}
?>