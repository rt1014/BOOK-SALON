<!DOCTYPE html>
<html lang="ja">
<head>
<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(VIEW_TEMP . 'template/head.php');

?>

    <link rel="stylesheet" href="../css/purchased.css">
    <title>BOOK SALON</title>
</head>
<body>
<header>
    <div class="container">
        <a href="main_view.php"><img src="../img/logo.png" alt="logo" id="logo"></a>
        <div class="header_user"><?php
            if(isset($_SESSION['username'])){
                echo 'ようこそ ' . $_SESSION['username'] . ' さん'; ?>
                <form method="post" action="../html/logout.php">
                    <input type="submit" name="logout" value="ログアウト" id="logout">
                </form>
                <?php
            } ?>
        </div>
    </div>
</header>
<article>
    <div class="thank_you">
        <img src="../img/thank you.png" alt="thank_you">
        <p>購入が完了しました。</p>
        <p>ありがとうございます！</p>
        <a href="../view/main_view.php">TOPに戻る</a>
    </div>
</article>
</body>
</html>