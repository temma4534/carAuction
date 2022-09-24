<?php
session_start();

$uid = $_SESSION['userid'];

$dbh = new PDO('mysql:host=mysql1.php.starfree.ne.jp;dbname=temma_auctiondb', 'temma_0615', 'ww0615ure');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM cars WHERE selled = 0";
$query = $dbh -> query($sql);
?>
<!DOCTYPE html>
<htm lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <h1><a href=""><img src="../logo/main_logo.png" width="200" height="70"></a></h1>
  <?php
  if (empty($uid)) {
  } else {
    echo '<p>ログイン中:'.$uid.'</p>';
  }
  ?>
  <ul id="user_nav">
  <?php
  if (empty($uid)){
    echo '<li><a href="session/login.php">出品</a></li>';
    echo '<li><a href="session/login.php">マイページ</a></li>';
  } else {
    echo '<li><a href="sell.php">出品</a></li>';
    echo '<li><a href="mypage.php">マイページ</a></li>';
  }
  ?>
  </ul>
  <hr>
  <h2>現在出品中</h2>
  <?php
  while ($row = $query->fetch(PDO::FETCH_ASSOC)) : ?>
   <div align="left">
     <a href="aucPage.php?id=<?php echo $row['car_id'];?>">
     <img src="<?php echo $row['image']; ?>" width="100" height="100"></a>
     <p>現在価格:￥<font color='red'><?php echo $row['now_price']; ?></font></p>
   </div>
  <?php endwhile; ?>
  <hr>
  <?php
  if (empty($uid)){
    echo '<p>ログイン <a href="session/login.php"><span style="background-color: #ecf0f1; color: #236fa1;">ログイン</span></a></p>';
    echo '<p>会員登録はこちら <a href="session/register.php"><span style="background-color: #ecf0f1; color: #236fa1;">新規会員登録</span></a></p>';
  } else {
    echo '<p><a href="session/logout.php"><span style="background-color: #ecf0f1; color: #236fa1;">ログアウト</span></a></p>';
  }
  ?>
</body>
