<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(MODEL_TEMP . 'db.php');

$errors = array();

// アカウント新規登録時、名前チェック
function get_user_name($db, $username){
    $sql = "SELECT username FROM user WHERE username = '{$username}'";
    return fetch_All_query($db, $sql);
}

function add_name($name){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(isset($name)){
            if(empty($name)){
                $errors[] = "ユーザー名が未入力です。";
                return $errors;
            }else if(!preg_match('/^([a-zA-Z0-9あ-んア-ンヴ]{4,})$/', $name)){
                $errors[] = "名前は4文字以上の半角英数字かひらがな、カタカナで入力してください。";
                return $errors;
            }else{
                return $name;
            }
        }
    }
}

// アカウント新規登録時、パスワードチェック
function add_pass($pass){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($pass)){
            if(empty($pass)){
                $errors[] = "パスワードが未入力です。";
                return $errors;
            }elseif(!preg_match('/^([a-zA-Z0-9]{6,})$/', $pass)) {
                $errors[] = 'パスワードは6文字以上の半角英数字を入力してください。';
                return $errors;
            }else{
                return $pass;
            }
        }
    }
}
// 名前、パスワードをDB登録
function add_user($db, $username, $password){
    $sql = " INSERT INTO user (username, password) VALUES('{$username}', '{$password}') ";
    return execute_query($db, $sql);
}

// ログイン時DBからデータ取得
function get_user($db, $username, $password){
    global $errors;
    if($errors === []){
        $sql = 'SELECT username, password FROM user WHERE username = ? AND password = ?';
        $statement = $db->prepare($sql);
        $statement ->bindvalue(1, $username, PDO::PARAM_INT);
        $statement ->bindvalue(2, $password, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}

// セッション名からユーザーIDを取得
function get_user_id($db, $username){
    $sql = "SELECT userid FROM user WHERE username = '{$username}'";
    return fetch_query($db, $sql);
}

