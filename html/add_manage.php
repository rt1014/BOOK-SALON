<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(MODEL_TEMP . 'manage.php');
require_once(MODEL_TEMP . 'db.php');

$db = db_connect();
$errors = array();

// 商品要素のエラーチェックをしたうえで、DBに登録
if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0 && isset($_POST['add']) === TRUE) {
    $name = check_name($_POST['name']);
    $price = check_price($_POST['price']);
    $amount = check_amount($_POST['amount']);
    $overview = check_overview($_POST['overview']);
    $type = check_type($_POST['type']);
    $genre = check_genre($_POST['genre']);
    $img = check_img($_FILES['img']);

    if(count($errors) === 0){
        add_item($db, $name, $price, $amount, $overview, $type, $genre, $img);
        header('manage_view.php');
        exit;
    }else{
        echo $errors;
    }
}

