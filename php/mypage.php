<?php
session_start();

$uid = $_SESSION['userid'];

echo $_POST['delete_id'];

$dbh = new PDO('mysql:host=mysql1.php.starfree.ne.jp;dbname=temma_auctiondb', 'temma_0615', 'ww0615ure');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM cars WHERE seller_id = '$uid' AND selled = 0";
$query = $dbh->query($sql);

$sql_deal = "SELECT * FROM deal_cars WHERE suc_id = '$uid'";
$deal_query = $dbh->query($sql_deal);
?>

<!DOCTYPE html>
<htm lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <h1><a href="main.php"><img src="../logo/main_logo.png" width="200" height="70"></a></h1>
  <h2>マイページ</h2>
  <?php
  if (empty($uid)) {
  } else {
    echo '<p>ログイン中:'.$uid.'</p>';
  }
  ?>
  <hr>
  <h2>出品中の車両</h2>
  <?php
  while ($row = $query->fetch(PDO::FETCH_ASSOC)) : ?>
  <div>
    <img src="<?php echo $row['image']; ?>" width="60" height="60">
    <p><?php echo $row['c_name']; ?></p>
　　<p>現在価格:￥<font color='red'><?php echo $row['now_price']; ?>  </font>
  　<a href="remove.php?id=<?php echo $row['car_id'];?>">削除</a></p>
  </div>
  <?php endwhile; ?>
  <h2>落札した車両</h2>
  <?php
  while ($row = $deal_query->fetch(PDO::FETCH_ASSOC)) : ?>
  <div>
    <img src="<?php echo $row['image']; ?>" width="60" height="60"></p>
    <p><?php echo $row['car_name']; ?></p>
    <p><a href=" info.php?id=<?php echo $row['car_id'];?>">落札情報</a></p>
  </div>
  <?php endwhile; ?>
</body>
