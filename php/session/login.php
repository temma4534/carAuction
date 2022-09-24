<?php
session_start();

$id = $_POST['user_id'];
$pass = $_POST['user_pass'];

if (empty($id) or empty($pass)) {
} else {
  $dbh = new PDO('mysql:host=mysql1.php.starfree.ne.jp;dbname=temma_auctiondb', 'temma_0615', 'ww0615ure');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT u_id, u_pass FROM auction_users WHERE u_id = '$id'";
  $query = $dbh->query($sql);
  $row = $query->fetch();

  $db_getId = $row['u_id'];
  $db_getPass = $row['u_pass'];

  if (($db_getId == $id) && ($db_getPass == $pass)){
    #セッション処理
    $_SESSION['userid'] = $id;
    $_SESSION['userpass'] = $pass;

    #メインページ遷移
    header('Location:../main.php');
    exit;
  } else {
    echo '<p><font color="red">※IDまたはパスワードが間違っています</font></p>';
    echo '<p><font color="red">※会員登録はお済みですか？</font></p>';
  }
}
?>
<!DOCTYPE html>
<htm lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <p><h1>ログイン</h1></p>
  <form action="" method="post">
    <p>ID</p>
    <p><input type="text" name="user_id" session/value="" required></p>
    <p>パスワード</p>
    <p><input type="password" name="user_pass" value="" required></p>
    <p><input type="submit" value="ログイン"></p>
  </form>
  <br>
  <p>会員登録はこちら <a href="register.php"><span style="background-color: #ecf0f1; color: #236fa1;">新規会員登録</span></a</p>
</body>
