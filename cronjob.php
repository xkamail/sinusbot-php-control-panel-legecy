<?php

session_start();
require 'config.inc.php';
require 'function.php';

if($result = query("SELECT * FROM `rent`")) {
  while ($row = $result->fetch()){ 
// Variables Date
    $start_date = $row['dueday'];
    $expire_date = $row['expireday'];
    $today_date = date("d-m-Y");

    /* Start Date */
    $start_explode = explode("-", $start_date);
    $start_day = $start_explode[0];
    $start_month = $start_explode[1];
    $start_year = $start_explode[2];

    /* Expire Date */
    $expire_explode = explode("-", $expire_date);
    $expire_day = $expire_explode[0];
    $expire_month = $expire_explode[1];
    $expire_year = $expire_explode[2];

    /* Today Date */
    $today_explode = explode("-", $today_date);
    $today_day = $today_explode[0];
    $today_month = $today_explode[1];
    $today_year = $today_explode[2];

    $start = gregoriantojd($start_month,$start_day,$start_year);
    $expire = gregoriantojd($expire_month,$expire_day,$expire_year);
    $today = gregoriantojd($today_month,$today_day,$today_year);

    $date_current = $expire-$today;
    if($date_current <= "-3"){
      echo 'Delete ->'.$row['uuid']."::\r\n";
      $query = query("SELECT * FROM `rent` WHERE `id` = ?",array($row['id']))->fetch();
      $server = query("SELECT * FROM `server` WHERE `sid` = ? LIMIT 1;",array($query['sid']))->fetch();
      require dirname(__FILE__).'/class/SinusBot.php';
      $sinusbot_admin = new SinusBot($query['url']);
      $sinusbot_admin->login($server['admin_username'], $server['admin_password']);
      $result = $sinusbot_admin->deleteUser($query['user_uuid']);
      $sinusbot_admin->killInstance($query['uuid']);
      query("UPDATE `server` SET `status`='N' WHERE  `sid`= ?;",array($query['sid']));
      query("DELETE FROM `rent` WHERE  `id`= ?;",array($row['id']));
    }else{
     /* echo "Update ->".$row['uuid']." ::".$date_current."::\r\n"; */
     query("UPDATE `rent` SET `currentday`= ? WHERE  `id`= ?;",array($date_current,$row['id']));
   }
 }
}
echo date("d-m-Y H:i:s");
?>