 <?php
 require 'config.inc.php';
 require 'function.php';
 if($_SERVER['REMOTE_ADDR'] != '203.146.127.112'){ exit('ACCESS DENIED');
 die();
 } if($_GET){ $transaction_id = $_GET['transaction_id'];
 $password = $_GET['password'];
 $amount = $_GET['real_amount'];
 $status = $_GET['status'];
 if($status == 1){ $user = query("SELECT * FROM `payment_tmpay` WHERE `truemoney` = ?",array($password))->fetch();
 query("UPDATE `member` SET `point` = `point` + ? WHERE `uid` = ?",array($amount,$user['owner_id']));
 query("UPDATE `payment_tmpay` SET `amount`= ?, `status`= ?, `msg`='สำเร็จ' WHERE  `txid`= ?;
",array($amount,$status,$transaction_id));
 die('SUCCEED|TOPPED_UP_THB_'.$amount.'_TO_'.$user['owner_id']);
 }else if($status == 3){ query("UPDATE `payment_tmpay` SET `amount`= ?, `status`= ?, `msg`='ไม่สำเร็จ' WHERE  `txid`= ?;
",array($amount,$status,$transaction_id));
 die('SUCCEED|TOPPED_UP_THB_'.$amount.'_TO_'.$user['owner_id']);
 die('SUCCEED| 3 ');
 }else if($status == 4){ query("UPDATE `payment_tmpay` SET `amount`= ?, `status`= ?, `msg`='ไม่สำเร็จ' WHERE  `txid`= ?;
",array($amount,$status,$transaction_id));
 die('SUCCEED| 4');
 }else if($status == 5){ query("UPDATE `payment_tmpay` SET `amount`= ?, `status`= ?, `msg`='ไม่สำเร็จ' WHERE  `txid`= ?;
",array($amount,$status,$transaction_id));
 die('SUCCEED| 5 ');
 } die('ERROR|ANY_REASONS');
 }
?>