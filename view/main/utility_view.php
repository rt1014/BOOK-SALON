<!DOCTYPE html>
<html lang="ja">
<head>
<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(VIEW_TEMP . 'template/head.php');
require_once(MODEL_TEMP . 'item.php');
require_once(HTML_TEMP . 'main.php');
?>

<link rel="stylesheet" href="../../css/main.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../../html/main.js"></script>
<title>BOOK SALON</title>
</head>
<body>
    <header>
        <div class="container">
            <a href="../main_view.php"><img src="../../img/logo.png" alt="logo" id="logo"></a>
            <form method="post" class="search">
                <input type="text" id="search-text" placeholder="キーワードなどを入力してください" name="search">
                <input type="submit" value="検索" id="search-button">
            </form>
        </div>
        <div class="header_user"><?php
            if(isset($_SESSION['username'])){
                echo 'ようこそ ' . $_SESSION['username'] . ' さん'; ?>
                <form method="post" action="../../html/logout.php">
                    <input type="submit" name="logout" value="ログアウト" id="logout">
                </form>
                <a href="cart_view.php" id="cart"><img src="../../img/カート.jpeg" alt="cart"></a>
                <?php
            }else{
                echo 'ようこそ　ゲスト　さん'; ?>
                <form method="post" action="../login_view.php">
                    <input type="submit" name="main_to_login" value="ログイン" id="main_to_login">
                </form><?php
            } ?>
        </div>
    </header>
    <nav>
        <a href="../main_view.php"><label class="TOP">TOP</label></a>
        <a href="boy_view.php"><label class="boy">少年漫画</label></a>
        <a href="youth_view.php"><label class="young">青年漫画</label></a>
        <a href="girl_view.php"><label class="girl">少女漫画</label></a>
        <a href="novel_view.php"><label class="novel">小説</label></a>
        <a href="utility_view.php"><label class="utility">実用書</label></a>
        <a href="photo_view.php"><label class="photo">写真集</label></a>
    </nav>
    <article>
            <section>
                <ul class="type_boy">
                    <?php show_type($utility_tab_items); ?>
                </ul>
            </section>
    </article>
</body>
</html>