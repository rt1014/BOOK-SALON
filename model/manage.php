<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(MODEL_TEMP . 'db.php');

// 商品登録
function add_item($db,$name, $price, $amount, $overview, $type, $genre, $img){
    $sql = "
        INSERT INTO manage
        (name, price, amount, overview, type, genre, img)
        VALUES('{$name}', {$price}, {$amount}, '{$overview}','{$type}', '{$genre}', '{$img}')
        ";
    return execute_query($db,$sql);
}

// 名前
function check_name($name){
    if((isset($name)) !== TRUE || mb_strlen($name) === 0){
        $errors[] = '名前を入力してください';
    }else{
        $correct_name = $name;
        return $correct_name;
    }
}

// 値段
function check_price($price){
    if((isset($price)) !== TRUE || !preg_match('/^([1-9][0-9]*|0)$/',$price)) {
        $errors[] = '値段を入力してください';
    }else{
        $correct_price = $price;
        return $correct_price;
    }
}

// 個数
function check_amount($amount){
    if((isset($amount)) !== TRUE || !preg_match('/^([1-9][0-9]*|0)$/',$amount)){
        $errors[] = '個数を入力してください';
    }else{
        $correct_amount = $amount;
        return $correct_amount;
    }
}

// 概要
function check_overview($overview){
    if((isset($overview)) !== TRUE || mb_strlen($overview) === 0){
        $errors[] = '概要を入力してください';
    }else{
        $correct_overview = $overview;
        return $correct_overview;
    }
}

// タイプ
function check_type($type){
    if((isset($type)) !== TRUE || mb_strlen($type) === 0){
        $errors[] = 'ジャンルを選択してください';
    }else{
        $correct_type = $type;
        return $correct_type;
    }
}

// ジャンル
function check_genre($genre){
    if((isset($genre)) !== TRUE || mb_strlen($genre) === 0){
        $errors[] = 'ジャンルを選択してください';
    }else{
        $correct_genre = $genre;
        return $correct_genre;
    }
}


// 画像ファイル
function check_img($img){
    if (is_uploaded_file($img['tmp_name']) === TRUE) {
    $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
    if($extension === 'jpeg' || $extension === 'png' || $extension === 'jpg'){
        $new_img_filename = sha1(uniqid(mt_rand(), true)). '.' . $extension;
        if (is_file(IMG_TEMP . 'itemimg/' . $new_img_filename) !== TRUE) {
            if (move_uploaded_file($img['tmp_name'], IMG_TEMP . 'itemimg/' . $new_img_filename) !== TRUE) {
                $errors[] = 'ファイルアップロードに失敗しました';
            }else{
                $correct_img = $new_img_filename;
                return $correct_img;
            }
        } else {
            $errors[] = 'ファイルアップロードに失敗しました。';
        }
    } else {
        $errors[] = 'ファイルの形式が違います。';
    }
    } else {
        $errors[] = 'ファイルを選択してください';
    }
}

// 取得
function get_item($db){
    $sql = '
    SELECT name, price, amount, overview, type, genre, img
    FROM manage order by id asc
    ';
    return fetch_all_query($db, $sql);
}

