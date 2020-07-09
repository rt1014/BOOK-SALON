<!DOCTYPE html>
<html lang="ja">
<head>
<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(VIEW_TEMP . 'template/head.php');
require_once(MODEL_TEMP . 'item.php');
require_once(MODEL_TEMP . 'user.php');

if(isset($_POST['in_cart'])){
    if(!isset($_SESSION['username'])){　?>
        <script>
        alert('商品をカートに入れるには、ログインが必要です。');
        location.href="main_view.php"
        </script>　<?php
    }else if(isset($_SESSION['username'])){
        $db = db_connect();
        $user_id = get_user_id($db, $_SESSION['username']);
        $get_cart = get_cart($db, $user_id[0]);
        $check_cart = check_cart($db, $_POST['item_id']);
        if(count($check_cart) === 0){
            in_cart($db, $user_id[0], $_POST['item_id']);
            ?>
            <script>
            alert('商品をカートに追加しました！');
            location.href="main_view.php"
            </script><?php
        }else{?>
            <script>
            alert('その商品は、既にカートに入っています。');
            location.href="main_view.php"
            </script><?php
        }
    }
}

?>

    <link rel="stylesheet" href="../css/detail.css">
    <title>BOOK SALON</title>
</head>
<body>
<header>
    <div class="container">
        <a href="main_view.php"><img src="../img/logo.png" alt="logo" id="logo"></a>
        <form method="post" class="search" action="main_view.php">
            <input type="text" id="search-text" placeholder="キーワードなどを入力してください" name="search">
            <input type="submit" value="検索" id="search-button">
        </form>
    </div>
    <div class="header_user"><?php
        if(isset($_SESSION['username'])){
            echo 'ようこそ ' . $_SESSION['username'] . ' さん'; ?>
            <form method="post" action="../html/logout.php">
                <input type="submit" name="logout" value="ログアウト" id="logout">
            </form>
            <a href="cart_view.php" id="cart"><img src="../img/カート.jpeg" alt="cart"></a>
            <?php
        }else{
            echo 'ようこそ　ゲスト　さん'; ?>
            <form method="post" action="login_view.php">
                <input type="submit" name="main_to_login" value="ログイン" id="main_to_login">
            </form><?php
        } ?>
    </div>
</header>
<?php
$item_detail = detail_get_item($db,$_POST['item_name']);

foreach($item_detail as $item){ ?>
    <div class="item">
        <img src="<?php echo '../img/itemimg/' . $item['img'] ?>" alt="thumbnail">
        <div class="item_text"> <?php
            echo 'タイトル:' . $item['name'] . '<br><br>';
            echo '価格:' . $item['price'] . '円(税込)' . '<br><br>';
            echo $item['overview'] . '<br><br>'; ?>
            <form method="post">
                <input type="submit" name="in_cart" value="カートに入れる" id="in_cart">
                <input type="hidden" name="item_id" value="<?php echo $item['id'] ?>">
            </form>
            <div class="return">
                <a href="main_view.php">TOPに戻る</a>
            </div>
        </div>
    </div>
<?php } ?>
</body>
</html>