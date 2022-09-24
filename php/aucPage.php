<?php
date_default_timezone_set('Asia/Tokyo');
session_start();

$uid = $_SESSION['userid'];
$id = $_GET['id'];

$dbh = new PDO('mysql:host=mysql1.php.starfree.ne.jp;dbname=temma_auctiondb', 'temma_0615', 'ww0615ure');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM cars WHERE car_id = '$id'";
$query = $dbh->query($sql);
$row = $query->fetch();

$seller_id = $row['seller_id'];
$now_price = $row['now_price'];
$sell_price = $row['sell_price'];
$regist_time = $row['regist_time'];

$json_regist_time = json_encode($regist_time);

function unsold($getPrice, $getId)
{
  $dbh = new PDO('mysql:host=mysql1.php.starfree.ne.jp;dbname=temma_auctiondb', 'temma_0615', 'ww0615ure');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->query("UPDATE cars SET now_price = '$getPrice', selled = 1 WHERE car_id = '$getId'");
}


$datetime = new DateTime($row['regist_time']);
$current  = new DateTime('now');

$time = $datetime->diff($current);

?>
<!DOCTYPE html>
<htm lang="ja">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/aucPage.css">
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
  <dl>
    <dt><img src="<?php echo $row['image']; ?>" width="200" height="200"></dt>
    <dt>車名:<?php echo $row['c_name']; ?></dt>
    <dt>メーカー:<?php echo $row['c_maker']; ?></dt>
    <dt>出品者:<?php echo $row['seller_id']; ?></dt>
    <dt>コメント:<?php echo $row['car_comment']; ?></dt>
    <dt>最高入札者:<?php echo $row['suc_id']; ?></dt>
    <dt>即決価格:￥<?php echo $row['sell_price']; ?></dt>
    <dt>現在価格:￥<?php echo $row['now_price']; ?></dt>
    <dt>終了日:<?php echo $row['regist_time']; ?></dt>
  </dl>
  <table border="0" style="font-size: 20pt; font-weight: 700;">
    <tr>
      <td>残り:</td>
  <?php
  if (($time->days) == 0) {
    if ($current >= $datetime){
      unsold($row['now_price'], $id);
      header('Location:main.php');
      exit;
    } else {
      echo '<script>let js_regist_time =' .$json_regist_time. '</script>
            <script src="../js/countDown.js"></script>';
      echo "<td id='hour'></td>
            <td id='min'></td>
            <td id='sec'></td>";
    }
  } else {
    echo "<td>".$time->days."日</td>";
  }
  ?>
  </tr></table>
  <?php
  if (empty($uid)) {
    echo '<h3><font color="red">※入札にはログインが必要です</font></h3>';
  } elseif ($seller_id == $uid) {
    echo '<h3><font color="red">※出品者は入札できません</font></h3>';
  } else {
    echo '<form action="bid.php" method="post">';
    echo '<p><input type="hidden" name="bid_id" value="'.$uid.'"></p>';
    echo '<p><input type="hidden" name="car_id" value="'.$id.'"></p>';
    echo '<p><input type="hidden" name="seller_id" value="'.$seller_id.'"></p>';
    echo '<p><input type="hidden" name="now_price" value="'.$now_price.'"></p>';
    echo '<p><input type="hidden" name="sell_price" value="'.$sell_price.'"></p>';
    echo '<p><input type="number" step="1000" name="price" value="" required>';
    echo '<p><input type="submit" value="入札"></p>';
    echo '</form>';
  }
  ?>
</body>
