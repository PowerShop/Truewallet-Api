<?php
$con = new mysqli('localhost','root','','devexp');
if ($con->connect_error) {
  die('เชื่อมต่อไม่ได้ '.$con->connect_error);
}
 ?>
