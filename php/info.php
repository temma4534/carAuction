<?php
session_start();

$uid = $SESSION['userid'];
$id = $_GET['id'];

$dbh = new PDO('mysql:host=mysql1.php.starfree.ne.jp;dbname=temma_auctiondb', 'temma_0615', 'ww0615ure');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM deal_cars WHERE car_id = '$id'";
$query = $dbh->query($sql);
$row = $query->fetch();

?>
<!DOCTYPE html>
<htm lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <h1><a href="main.php"><img src="../logo/main_logo.png" width="200" height="70"></a></h1>
  <h2>落札情報</h2>
  <?php
  if (empty($uid)) {
  } else {
    echo '<p>ログイン中:'.$uid.'</p>';
  }
  ?>
  <hr>
  <dl>
  <dt><img src="<?php echo $row['image']; ?>" width="100" height="100"></dt>
  <dt>車名:<?php echo $row['car_name']; ?></dt>
  <dt>落札者:<?php echo $row['suc_id']; ?></dt>
  <dt>落札価格:￥<?php echo $row['buy_out_price']; ?></dt>
  <dt>落札日時:<?php echo $row['buy_out_time']; ?></dt>
  </dl>
</body>
