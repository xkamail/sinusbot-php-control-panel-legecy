<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Controller extends CI_Controller {
public function page($id){
global $Auth;
if(check($id)){
$q = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$s = query("SELECT * FROM `server` WHERE `sid` = ?;",array($q['sid']));
$server = $s->fetch();
$page = 'Control';
$data['Auth'] = $Auth;
$data['base_url'] = base_url();
$data['q'] = $q;
$this->load->view('Page/'.$page,$data);
}else{
exit('NOT ALLOW');
}
}
public function getstatus($id){
global $Auth;
if(check($id)){
$this->load->library('SinusBot');
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ?;",array($query['sid']))->fetch();
$sinusbot = new SinusBot($query['url']);
$sinusbot->login($query['username'],$query['password']);
$uid = $query['uuid'];
$status = $sinusbot->getStatus($uid);
echo json_encode($status);
}else{
exit('NOT ALLOW');
}
}
public function getsettings($id){
global $Auth;
if(check($id)){
$this->load->library('SinusBot');
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ?;",array($query['sid']))->fetch();
$sinusbot = new SinusBot($query['url']);
$sinusbot->login($query['username'],$query['password']);
$uid = $query['uuid'];
$status = $sinusbot->getSettings($uid);
echo json_encode($status);
}else{
exit('NOT ALLOW');
}
}
public function getPlaylists($id){
global $Auth;
if(check($id)){
$this->load->library('SinusBot');
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ?;",array($query['sid']))->fetch();
$sinusbot = new SinusBot($query['url']);
$sinusbot->login($query['username'],$query['password']);
$uid = $query['uuid'];
$status = $sinusbot->getPlaylists();
echo json_encode($status);
}else{
exit('NOT ALLOW');
}
}
public function pbplist($id){
global $Auth;
if(check($id)){
$this->load->library('SinusBot');
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ?;",array($query['sid']))->fetch();
$sinusbot = new SinusBot($query['url']);
$sinusbot->login($query['username'],$query['password']);
$uid = $query['uuid'];
$playlistUUID = $this->input->post("paylist",true);
$playlistIndex = 0;
$instanceUUID = $query['uuid'];
$res = $sinusbot->playPlaylist($playlistUUID,$playlistIndex,$instanceUUID);
if($res['success'] == true){
Alert(true,"ระบบได้ทำการเล่นเพลงจากในเพลย์ลิสต์ที่คุณเลือกเรียบร้อย");
}else{
Alert(false,"ไม่สามารถเล่นเพลงได้เนื่องจากเกิดปัญหาบางอย่าง");
}
}else{
exit('NOT ALLOW');
}
}
public function button_launch($id){
global $Auth;
if(check($id)){
$this->load->library('SinusBot');
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ?;",array($query['sid']))->fetch();
$sinusbot = new SinusBot($query['url']);
$sinusbot->login($query['username'],$query['password']);
$uid = $query['uuid'];
$res = $sinusbot->spawnInstance($uid);
Alert(true,$res);
}else{
exit('NOT ALLOW');
}
}
public function button_shutdown($id){
global $Auth;
if(check($id)){
$this->load->library('SinusBot');
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ?;",array($query['sid']))->fetch();
$sinusbot = new SinusBot($query['url']);
$sinusbot->login($query['username'],$query['password']);
$uid = $query['uuid'];
$res = $sinusbot->killInstance($uid);
Alert(true,$res);
}else{
exit('NOT ALLOW');
}
}
public function button_backward($id){
global $Auth;
if(check($id)){
$this->load->library('SinusBot');
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ?;",array($query['sid']))->fetch();
$sinusbot = new SinusBot($query['url']);
$sinusbot->login($query['username'],$query['password']);
$uid = $query['uuid'];
$res = $sinusbot->playPrevious($uid);
Alert(true,$res);
}else{
exit('NOT ALLOW');
}
}
public function button_forward($id){
global $Auth;
if(check($id)){
$this->load->library('SinusBot');
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ?;",array($query['sid']))->fetch();
$sinusbot = new SinusBot($query['url']);
$sinusbot->login($query['username'],$query['password']);
$uid = $query['uuid'];
$res = $sinusbot->playNext($uid);
Alert(true,$res);
}else{
exit('NOT ALLOW');
}
}
public function button_start($id){
global $Auth;
if(check($id)){
$this->load->library('SinusBot');
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ?;",array($query['sid']))->fetch();
$sinusbot = new SinusBot($query['url']);
$sinusbot->login($query['username'],$query['password']);
$uid = $query['uuid'];
$res = $sinusbot->getStatus($uid);
$trackUUID = $res['currentTrack']['uuid'];
$res = $sinusbot->playTrack($trackUUID,$uid);
Alert(true,$res);
}else{
exit('NOT ALLOW');
}
}
public function editSettings($id){
global $Auth;
if(check($id)){
$this->load->library('SinusBot');
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ?;",array($query['sid']))->fetch();
$sinusbot = new SinusBot($query['url']);
$sinusbot->login($query['username'],$query['password']);
$uid = $query['uuid'];
$data = array();
$data['nick'] = $this->input->post("nick",true);
$data['serverHost'] = $this->input->post("server_ip",true);
$data['serverPassword'] = $this->input->post("server_password",true);
$res = $sinusbot->editSettings($data,$uid);
if($res['success'] == true){
Alert(true,"เปลียนเเปลงข้อมูลเรียบร้อย",array("redirect"=>"reload"));
}else{
Alert(false,"มีบางอย่างผิดพลาด");
}
}else{
exit('NOT ALLOW');
}
}
public function repeat($id){
global $Auth;
if(check($id)){
$this->load->library('SinusBot');
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ?;",array($query['sid']))->fetch();
$sinusbot = new SinusBot($query['url']);
$sinusbot->login($query['username'],$query['password']);
$uid = $query['uuid'];
$val = $this->input->get("val",true);
$res = $sinusbot->playRepeat($val,$uid);
exit(json_encode($res));
}else{
exit('NOT ALLOW');
}
}
public function setVolume($id){
global $Auth;
if(check($id)){
$this->load->library('SinusBot');
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ?;",array($query['sid']))->fetch();
$sinusbot = new SinusBot($query['url']);
$sinusbot->login($query['username'],$query['password']);
$uid = $query['uuid'];
$vol = $this->input->get("setVolume",true);
$res = $sinusbot->setVolume($vol,$uid);
exit(json_encode($res));
}else{
exit('NOT ALLOW');
}
}
public function renew($id){
global $Auth;
if(check($id)){
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$price = 90;
if($Auth['point']>=$price){
$date = new DateTime($query['expireday']);
$date->add(new DateInterval('P30D'));
$update_date = $date->format('d-m-Y');
query("UPDATE `rent` SET `expireday`= ? WHERE  `id`= ?;",array($update_date,$id));
query("UPDATE `member` SET `point`= `point` - ? WHERE `uid`= ?;",array($price,$Auth['uid']));
Alert(true,"ต่ออายุการใช้งานเรียบร้อย",array("redirect"=>"reload"));
}else{
Alert(false,"จำนวนเงินไม่เพียงพอ");
}
}else{
exit('NOT ALLOW');
}
}
public function cancel($id){
global $Auth;
if(check($id)){
$query = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
$server = query("SELECT * FROM `server` WHERE `sid` = ? LIMIT 1;",array($query['sid']))->fetch();
$this->load->library('SinusBot');
$sinusbot_admin = new SinusBot($query['url']);
$sinusbot_admin->login($server['admin_username'],$server['admin_password']);
$result = $sinusbot_admin->deleteUser($query['user_uuid']);
$sinusbot_admin->killInstance($query['uuid']);
if($result['success'] != true){
Alert(false,"มีบางอย่างผิดพลาด | Delete User.");
}
query("UPDATE `server` SET `status`='N' WHERE  `sid`= ?;",array($query['sid']));
query("DELETE FROM `rent` WHERE  `id`= ?;",array($id));
Alert(true,"ขอบคุณที่ใช้บริการ! คุณได้ยกเลิกบริการเรียบร้อยเเล้ว",array("redirect"=>base_url()));
}else{
exit('NOT ALLOW');
}
}
}; ?>