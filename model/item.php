<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(HTML_TEMP . 'admin_manage.php');
require_once(MODEL_TEMP . 'db.php');

// 商品詳細を取得
function detail_get_item($db,$name){
    $sql = '
    SELECT id, img, name, price, overview FROM manage WHERE name = ?
    ';
    $statement = $db->prepare($sql);
    $statement ->bindvalue(1, $name, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
}

// タイプごとの商品を取得
function tab_get_item($db,$type){
    $sql = '
    SELECT img, name FROM manage WHERE type = ? order by id asc
    ';
    $statement = $db->prepare($sql);
    $statement ->bindvalue(1, $type, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
}

// メイン画面の商品表示
function show_item($items){
    $items_num = count($items);
    $max_page = ceil($items_num / MAX);
    if(!isset($_GET['page_id'])){
        $now = 1;
    }else{
        $now = $_GET['page_id'];
    }
    $start_no = ($now - 1) * MAX;
    $disp_data = array_slice($items, $start_no, MAX, true);

    foreach($disp_data as $val){ ?>
        <div class="item">
            <form method="post" action="detail_view.php" enctype="multipart/form-data">
                <input type="image" alt="thumbnail" width="150px" height="200px" src="<?php echo '../img/itemimg/' . $val['img']?>">
                <li><?php echo $val['name'] ?></li>
                <input type="hidden" name="item_name" value="<?php echo $val['name'] ?>">
            </form>
        </div>
    <?php } ?>

    <div class="page_num">
    <?php for($i = 1; $i <= $max_page; $i++){
        if ($i == $now) {
            echo $now. '　';
        } else {
            echo '<a href=\'?page_id='. $i. '\'>'. $i. '</a>'. '　';
        }
    } ?>
    </div>
<?php }

// タイプごとの商品
function show_type($items){
    $items_num = count($items);
    $max_page = ceil($items_num / MAX);
    if(!isset($_GET['page_id'])){
        $now = 1;
    }else{
        $now = $_GET['page_id'];
    }
    $start_no = ($now - 1) * MAX;
    $disp_data = array_slice($items, $start_no, MAX, true);

    foreach($disp_data as $val){ ?>
    <div class="item">
        <form method="post" action="../detail_view.php" enctype="multipart/form-data">
            <input type="image" alt="thumbnail" width="150px" height="200px" src="<?php echo '../../img/itemimg/' . $val['img']?>">
            <li><?php echo $val['name'] ?></li>
            <input type="hidden" name="item_name" value="<?php echo $val['name'] ?>">
        </form>
    </div>
    <?php } ?>

    <div class="page_num">
    <?php for($i = 1; $i <= $max_page; $i++){
        if ($i == $now) {
            echo $now. '　';
        } else {
            echo '<a href=\'?page_id='. $i. '\'>'. $i. '</a>'. '　';
        }
    } ?>
    </div>
<?php }

// カートに入れる
function in_cart($db, $user_id, $item_id){
    $sql = "INSERT INTO cart (user_id, item_id) VALUES({$user_id}, {$item_id})";
    return execute_query($db,$sql);
}

// カートの中身をユーザーIDで取得
function get_cart($db, $user_id){
    $sql = "
    SELECT name, price, img, manage.id
    FROM manage INNER JOIN cart ON manage.id = cart.item_id
    WHERE cart.user_id = '{$user_id}'
    ";
    return fetch_all_query($db, $sql);
}

// カートの中身をアイテムIDで取得、重複✔
function check_cart($db, $item_id){
    $sql = "SELECT id FROM cart WHERE item_id = '{$item_id}'";
    return fetch_all_query($db, $sql);
}

// キーワードで検索
function search_items($db, $search){
    $sql = "SELECT name, img FROM manage
    WHERE overview LIKE '%{$search}%' OR name LIKE '%{$search}%'";
    return fetch_all_query($db, $sql);
}

// カートから削除
function delete($db, $id){
    $sql = "DELETE FROM cart WHERE item_id = '{$id}'";
    return execute_query($db, $sql);
}

// 購入完了でカート削除
function delete_cart($db, $id){
    $sql = "DELETE FROM cart WHERE user_id = '{$id}'";
    return execute_query($db, $sql);
}