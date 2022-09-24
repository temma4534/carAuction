<?php
session_start();
$uid = $_SESSION['userid'];
$bid_id = $_POST['bid_id'];
$seller_id = $_POST['seller_id'];
$car_id = $_POST['car_id'];
$now_price = $_POST['now_price'];
$sell_price = $_POST['sell_price'];
$price = $_POST['price'];

if ($price <= $now_price) {
  echo "<h2><font color='red'>Error:現在価格以上の金額を入力してください。</font><h2>";
}
elseif ($price >= $sell_price) {
  $_SESSION['bid_id'] = $bid_id;
  $_SESSION['car_price'] = $price;
  $_SESSION['car_id'] = $car_id;
  header('Location:buy_out.php');
  exit;
}
else {
  $dbh = new PDO('mysql:host=mysql1.php.starfree.ne.jp;dbname=temma_auctiondb', 'temma_0615', 'ww0615ure');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $dbh->query("UPDATE cars SET now_price = '$price', suc_id = '$bid_id' WHERE car_id = '$car_id'");

  header('Location:aucPage.php?id='.$car_id);
  exit;
}
?>
