<?php 
 try { 
 $Main = (object) array( "sql" => new PDO("mysql:host=".$ConfigKM["mysql"]["host"].";dbname=".$ConfigKM["mysql"]["dbname"].";charset=utf8", $ConfigKM["mysql"]["username"], $ConfigKM["mysql"]["password"]) );
 } catch (Exception $e) { exit("Error -> Database Connect");
 } function rdr($url){ header("location: ".$url);
 exit();
 } 
 function query($sql,$array=array()){ global $Main;
 $q = $Main->sql->prepare($sql);
 $q->execute($array);
 return $q;
 } 
 function Alert($status,$msg,$arr = array()){ $a = new CI_Controller;
 $name = $a->security->get_csrf_token_name();
 $hash = $a->security->get_csrf_hash();
 $token = array('csrf' => array('name' => $name,'hash' => $hash));
 $output = array('status'=>$status,'msg'=>$msg);
 $output = array_merge($output,$arr);
 exit(json_encode(array_merge($output,array('csrf' => array('name' => $name,'hash' => $hash)))));
 } 
 function random($length = 7,$mode = 'all'){ switch($mode){ case 'char': $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 break;
 case 'num': $char = '0123456789';
 break;
 default: $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
 break;
 } $res = '';
 for($i = 0;
$i < $length;
$i++){ $res .= $char[rand(0, strlen($char) - 1)];
 } return $res;
 } function check($id){ global $Auth;
 $q = query("SELECT * FROM `rent` WHERE `id` = ?",array($id))->fetch();
 if($Auth){ if($Auth['uid'] == $q['owner_uid']){ return true;
 }else{ return false;
 } }else{ return false;
 } }
 ?>