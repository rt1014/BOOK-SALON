<!DOCTYPE html>
<html lang="ja">
<head>
    <?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
    require_once(VIEW_TEMP . 'template/head.php');
    require_once(HTML_TEMP . 'cart.php');
    $total = 0; ?>


    <link rel="stylesheet" href="../css/cart.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
    <section>
        <h1 class="title">現在のカート内</h1>
        <?php
        foreach($get_cart as $val){ ?>
            <div class="item">
                <img src="<?php echo '../img/itemimg/' . $val['img'] ?>" alt="thumbnail">
                <div class="item_text"><?php
                    echo "タイトル:" . $val['name'] . "<br>";
                    echo "価格:" . $val['price'] . "円(税込)" . "<br>"; ?>
                    <form method="post" action="detail_view.php" enctype="multipart/form-data">
                        <input type="submit" value="詳細" id="detail">
                        <input type="hidden" name="item_name" value="<?php echo $val['name'] ?>">
                    </form>
                </div>
                <form method="post" action="../html/delete.php">
                    <input type="submit" value="削除" name="delete" id="delete">
                    <input type="hidden" value="<?php echo $val['id'] ?>" name="id">
                </form>
            </div>
            <?php $total += $val['price'];
            } ?>
        <div class="cart_text">
            <h1>合計:<?php echo $total; ?>円(税込)</h1><?php
            if($total !== 0){ ?>
                <form method="post" action="../html/purchased.php" id="purchased">
                    <input type="submit" name="purchased" value="購入する" id="purchased">
                </form>
            <?php } ?>
        </div>
    <section>
</article>
</body>
</html>
