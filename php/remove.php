<?php

$id = $_GET['id'];

$dbh = new PDO('mysql:host=mysql1.php.starfree.ne.jp;dbname=temma_auctiondb', 'temma_0615', 'ww0615ure');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "DELETE FROM cars WHERE car_id = '$id'";
$query = $dbh->query($sql);

header('Location:mypage.php');
exit;
