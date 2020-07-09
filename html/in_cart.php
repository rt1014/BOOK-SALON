<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(MODEL_TEMP . 'db.php');
require_once(MODEL_TEMP . 'user.php');
require_once(MODEL_TEMP . 'item.php');

if(isset($_POST['in_cart'])){
    if(!isset($_SESSION['username'])){
        $errors = '商品をカートに入れるには、ログインが必要です。';
        header('location:../view/detail_view.php');
        exit;
    }else if(isset($_SESSION['username'])){
        $db = db_connect();
        $user_id = get_user_id($db, $_SESSION['username']);
        $get_cart = get_cart($db, $user_id);
        $check_cart = check_cart($db, $_POST['item_id']);
        if(count($check_cart) === 0){
            in_cart($db, $user_id[0], $_POST['item_id']);
            // header('location:../view/main_view.php');
            // exit;
            var_dump($check_cart);
        }else{
            echo 'e';
        }
    }
}

