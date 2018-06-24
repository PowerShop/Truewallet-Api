<?php
//Show all error, remove it once you finished you code.
ini_set('display_errors', 1);
include_once 'config.php';
//Include TrueWallet class.
include_once('manager/TrueWallet.php');
$wallet = new TrueWallet();
//Login with your username and password.
$username = "aaaxcvg@gmail.com";
$password = "Dekdee111";

//////////////
$ref = $_POST['wallet'];
$member = $_POST['member'];
//////////////
//Logout incase your previous session still exist, no need if you only use 1 user.
$wallet->logout();
//Login into TrueWallet
if($wallet->login($username,$password)){

	if($transaction = $wallet->get_transactions()){
    for ($i=0; $i <= 10; $i++) { //จำนวนที่ดึกมาเช็ค
      $report = $wallet->get_report($transaction[$i]->reportID);
      $ref_t = $report->section4->column2->cell1->value;
      $money = $report->section3->column1->cell1->value;
      $moneys = str_replace(',','',$money);
      if ($ref_t === $ref) {
        $sql = "update member set point = point + '$moneys' where name='$member'";
        $con->query($sql);
        echo "ทำรายการสำเร็จ!!!";
        break;
      }
    }

	}
	//Logout
	$wallet->logout();
}else{
	echo 'Login Failed!';
}
 ?>
