<?php
session_start();

$name = $_POST['user_name'];
$id = $_POST['user_id'];
$pass = $_POST['user_pass'];

if (empty($name) or empty($id) or empty($pass)) {
} else {

  $dbh = new PDO('mysql:host=mysql1.php.starfree.ne.jp;dbname=temma_auctiondb', 'temma_0615', 'ww0615ure');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT u_id FROM auction_users WHERE u_id = '$id'";
  $rows = $dbh->query($sql);

  if ($rows->rowCount() > 0){
    echo '<font color="red">Error:このIDは既に使用されています。</font>';
  } else {
    $dbh->query("INSERT INTO auction_users (u_id, u_name, u_pass) VALUES ('$id', '$name', '$pass')");
    #セッション処理
    $_SESSION['userid'] = $id;
    $_SESSION['userpass'] = $pass;

    #メインページ遷移
    header('Location:../main.php');
    exit;
  }
  $dbh = null;
}
?>

<!DOCTYPE html>
<htm lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <p><h1>会員登録</h1></p>
  <form action="" method="post">
    <p>ユーザー名</p>
    <p><input type="text" name="user_name" value="" required></p>
    <p>ID</p>
    <p><input type="text" name="user_id" value="" required></p>
    <p>パスワード</p>
    <p><input type="password" name="user_pass" value="" required></p>
    <p><input type="submit" value="登録"></p>
  </form>
  <br>
  <p>ログインはこちら <a href="login.php"><span style="background-color: #ecf0f1; color: #236fa1;">ログイン</span></a></p>
</body>
