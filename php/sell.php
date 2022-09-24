<?php
session_start();

$uid = $_SESSION['userid'];

$car_name = $_POST['car_name'];
$car_maker = $_POST['car_maker'];
$auc_comment = $_POST['auc_comment'];
$st_price = $_POST['st_price'];
$buy_out_price = $_POST['buy_out_price'];
$end_time = $_POST['auc_end_time'];


if (empty($car_name)) {
} else {
 if (empty($_FILES['car_img']['name'])) {
  $upload = '../logo/noimage.jpg';
 } else {
  $imgDir = './images/';
  $upload = $imgDir . basename($_FILES['car_img']['name']).uniqid();

  move_uploaded_file($_FILES['car_img']['tmp_name'], $upload);
 }


  $dbh = new PDO('mysql:host=mysql1.php.starfree.ne.jp;dbname=temma_auctiondb', 'temma_0615', 'ww0615ure');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $dbh->query("INSERT INTO cars (c_name, c_maker, car_comment, sell_price, now_price, seller_id, regist_time, image, selled)
  VALUES ('$car_name', '$car_maker', '$auc_comment', '$buy_out_price', '$st_price', '$uid', '$end_time', '$upload', 0)");


  header('Location:main.php');
  exit;
}

?>
<!DOCTYPE html>
<htm lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <h1><a href="main.php"><img src="../logo/main_logo.png" width="200" height="70"></a></h1>
  <h2>車両出品</h2>
    <?php
    if (empty($uid)) {
    } else {
     echo '<p>ログイン中:'.$uid.'</p>';
    }
    ?>
  <hr>
  <form action="" enctype="multipart/form-data" method="post">
    <p>車名</p>
    <p><input type="text" name="car_name" value="" required></p>
    <p>メーカー</p>
    <p><input type="text" name="car_maker" value="" required></p>
    <p>商品画像</p>
    <p><input type="file" name="car_img" value="" ></p>
    <p>コメント</p>
    <p><input type="text" name="auc_comment" value="" required></p>
    <p>開始金額</p>
    <p><input type="number" name="st_price" value="" required></p>
    <p>即決金額</p>
    <p><input type="number" name="buy_out_price" value="" required></p>
    <p>終了日時</p>
    <p><input type="datetime-local" name="auc_end_time" value=""></p>
    <p><input type="submit" value="出品"></p>
  </form>
</body>
