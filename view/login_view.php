<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="stylesheet" href="../css/login.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://fonts.googleapis.com/css?family=Economica:700" rel="stylesheet">
<title>BOOK SALON</title>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(VIEW_TEMP . 'template/head.php');
require_once(MODEL_TEMP . 'db.php');

$complete = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST["username"])){
        if (empty($_POST["username"])) {
            $errors[] = '※ユーザーIDが未入力です。';
        } elseif (!preg_match('/^([a-zA-Z0-9あ-んア-ン]{4,})$/', $_POST['username'])) {
            $errors[] = '※ユーザーは4文字以上の半角英数字、ひらがな、カタカナを入力してください。';
        } else {
            $username = $_POST["username"];
        }
    }
    if(isset($_POST["password"])){
        if (empty($_POST["password"])) {
            $errors[] = '※パスワードが未入力です。';
        } elseif (!preg_match('/^([a-zA-Z0-9]{6,})$/', $_POST['password'])) {
            $errors[] = '※パスワードは6文字以上の半角英数字を入力してください。';
        } else {
            $password = $_POST["password"];
        }
    }
}

try{
    $db = db_connect();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0 && isset($_POST['sign_up'])) {
        $sql = 'SELECT * FROM user WHERE username = ?';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1, $username,     PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        if (count($rows) > 0) {
            $errors[] = '※そのユーザーIDは既に使われています。';
        }else{
            $sql = 'INSERT INTO user (username, password) VALUES (?, ?)';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(1, $username,     PDO::PARAM_STR);
            $stmt->bindValue(2, $password,     PDO::PARAM_STR);
            $stmt -> execute();
            $name = $db -> lastinsertid();
            $complete = '登録が完了しました。' . '<br>' . 'ログインしてください。';
        }
    }else if($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0 && isset($_POST['login'])){
        $sql = 'SELECT * FROM user WHERE username = ? AND password = ?';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1, $username,     PDO::PARAM_STR);
        $stmt->bindValue(2, $password,     PDO::PARAM_STR);
        $stmt -> execute();
        $rows = $stmt -> fetchAll();
        if(count($rows) === 0){
            $errors[] = '※ユーザーIDまたはパスワードが間違っています';
        }else{
            $_SESSION['username'] = $rows[0]['username'];
            $_SESSION['userid'] = $rows[0]['userid'];
            header('Location:main_view.php');
            exit;
        }
    }
}catch (PDOExeption $e) {
    $errors['db_connect'] = 'DBエラー：'.$e->getMessage();
}
?>

</head>
<body>
    <div class="login">
        <img src="../img/logo.png" alt="logo" id="logo">
        <div class="message">
            <?php print $complete ."<br>";
            if(count($errors) > 0) {
                foreach($errors as $error) {
                    print $error ."<br>";
                }
            } ?>
        </div>
        <form method="post">
            <input type="text" name="username" placeholder="username" id="username" title="4文字以上で入力してください。"><br>
            <input type="password" name="password" placeholder="password" id="password" title="半角英数字6文字以上で入力してください。"><br>
            <input type="submit" value="login" id="login" name="login">
            <input type="submit" value="sign up" id="sign_up" name="sign_up">
        </form>
        <a href="main_view.php" id="guest">ゲストとしてログインする</a>
    </div>
</body>
</html>

<script>
$(function(){
    $("#password, #username").tooltip({
        show:false,
        hide:false
    });
});
</script>