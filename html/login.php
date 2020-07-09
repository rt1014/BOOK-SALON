<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(MODEL_TEMP . 'db.php');
require_once(MODEL_TEMP . 'user.php');

$errors = array();

$db = db_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $get_user_name = get_user_name($db, $_POST['username']);
    $username = add_name($_POST['username']);
    $password = add_pass($_POST['password']);

    if (isset($_POST['login']) === TRUE) {
        // エラーが配列に入っていない時
        if(!is_array($username) || !is_array($password)){
            $user_index = get_user($db, $username, $password);

            $_SESSION['username'] = $user_index['username'];
            $_SESSION['password'] = $user_index['password'];
            // 合わない時のエラー表示が必要

            if(isset($username, $password)){
                header('location:../view/main_view.php');
                exit;
            }else{
                header('location:../view/login_view.php');
                exit;
            }
        }else{
            // エラーが配列に入っている時
            $c = 'ログインに失敗しました。';
            $login_miss=urlencode($c);
            header("location:../view/login_view.php?login_miss=" . $login_miss);
            exit;
        }
    }else if(isset($_POST['sign_up']) === TRUE) {
        if(!is_array($username) || !is_array($password) || !is_array($get_user_name)){
            add_user($db, $username, $password);
            $c = '登録が完了しました。' . '<br>' . 'ログインしてください。';
            $comp=urlencode($c);
            // header("location:../view/login_view.php?comp=" . $comp);
            // exit;
            echo '完了';
            var_dump($get_user_name);
            var_dump($password);
            var_dump($username);
        }else{
            // エラーが配列に入っている時
            $c = '登録に失敗しました。';
            $login_miss=urlencode($c);
            // header("location:../view/login_view.php?login_miss=" . $login_miss);
            // exit;
            var_dump($username);
            echo '失敗';
        }
    }
}

