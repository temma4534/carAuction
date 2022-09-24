<?php
date_default_timezone_set('Asia/Tokyo');
session_start();

$uid = $_SESSION['userid'];
$bid_id = $_SESSION['bid_id'];
$car_id = $_SESSION['car_id'];
$car_price = $_SESSION['car_price'];
$now_time = date("Y-m-d H:i:s");

$dbh = new PDO('mysql:host=mysql1.php.starfree.ne.jp;dbname=temma_auctiondb', 'temma_0615', 'ww0615ure');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dbh->query("UPDATE cars SET now_price = '$car_price', suc_id = '$bid_id', buy_out_time = '$now_time', selled = 1 WHERE car_id = '$car_id'");

$sql = "SELECT * FROM cars WHERE car_id = '$car_id'";
$query = $dbh->query($sql);
$row = $query->fetch();

$car_name = $row['c_name'];

$dbh->query("INSERT INTO deal_cars (car_name, car_id, suc_id, buy_out_price, buy_out_time)
VALUES ('$car_name', '$car_id', '$bid_id', '$car_price', '$now_time')");
?>
<!DOCTYPE html>
<htm lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <h1><a href="main.php"><img src="../logo/main_logo.png" width="200" height="70"></a></h1>
  <?php
  if (empty($uid)) {
  } else {
    echo '<p>ログイン中:'.$uid.'</p>';
  }
  ?>
  <hr>
  <h2><font color='red'>おめでとうございます！落札しました！</font></h2>
  <h3>落札情報</h3>
  <dl>
  <dt>車名:<?php echo $row['c_name']; ?></dt>
  <dt>メーカー:<?php echo $row['c_maker']; ?></dt>
  <dt>出品者:<?php echo $row['seller_id']; ?></dt>
  <dt>コメント:<?php echo $row['car_comment']; ?></dt>
  <dt>落札者:<?php echo $row['suc_id']; ?></dt>
  <dt>落札価格:￥<?php echo $car_price; ?></dt>
  <dt>落札日時:<?php echo $row['buy_out_time']; ?></dt>
  </dl>
  <p><a href="main.php"><span style="background-color: #ecf0f1; color: #236fa1;">トップページ</span></a></p>
</body>
