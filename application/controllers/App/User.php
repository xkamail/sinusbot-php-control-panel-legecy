<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
public function changepw(){
	global $Auth;
	if($Auth){
	$current_pw = $Auth['password'];
	if($new_pw == $current_pw){
		Alert(true,"เปลียนรหัสผ่านใหม่เรียบร้อย");
	}else{
		Alert(false,"กรุณากรอกรหัสผ่านปัจจุบันให้ถูกต้อง");
	}
	}else{
		Alert(false,"กรุณาเข้าสู่ระบบ");
	}
	
}
}