<?php 
class Rent extends CI_Controller {
public function buy(){
global $Auth;
global $Main;
$price = 90;
$s = query("SELECT * FROM `server` WHERE `status` = ? LIMIT 1;",array("N"));
if($s->rowCount()==1){
$server = $s->fetch();
}else{
Alert(false,"ไม่เหลือ Music Bot ในระบบ");
}
if($Auth['point']>=$price){
$this->load->library('SinusBot');
$sinusbot = new SinusBot("http://".$server['ip'].":".$server['port']);
$sinusbot->login($server['admin_username'],$server['admin_password']);
$privileges = 127421;
$create_username = strtolower(random(10));
$create_password = random(10);
$create_user_res = $sinusbot->addUser($create_username,$create_password,$privileges);
if($create_user_res['success'] != true){
Alert(false,"มีบางอย่างผิดพลาด | ไม่สามารถสร้าง User จัดการบอทได้");
}
$create_user_res = $sinusbot->getUsers();
foreach ($create_user_res as $value) {
if($value['username'] == strtolower($create_username)){
$user_uuid = $value['id'];
}
}
$get_instances = $sinusbot->getInstances();
$get_instances = $get_instances[0]['uuid'];
$generate_url = "http://".$server['ip'].":".$server['port'];
$dueday = date("d-m-Y");
$expireday = date("d-m-Y",strtotime(date("d-m-Y").' + 30 days'));
$insert = array(
$Auth['uid'],
$server['sid'],
$get_instances,
$user_uuid,
$create_username,
$create_password,
$generate_url,
$dueday,
30,
$expireday
);
query("INSERT INTO `rent` (`owner_uid`, `sid`, `uuid`, `user_uuid`, `username`, `password`, `url`, `dueday`, `currentday`, `expireday`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);",$insert);
query("UPDATE `server` SET `status`='Y' WHERE  `sid`= ?;",array($server['sid']));
query("UPDATE `member` SET `point`= `point` - ? WHERE `uid`= ?;",array($price,$Auth['uid']));
Alert(true,"ระบบได้ทำการสั่งซื้อ Music bot เรียบร้อย!");
}else{
Alert(false,"จำนวนเงินของคุณไม่เพียงพอ");
}
}
}; ?>