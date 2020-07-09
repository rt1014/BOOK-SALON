<!DOCTYPE html>
<html lang="ja">
<head>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
    require_once(VIEW_TEMP . 'template/head.php');
    require_once(HTML_TEMP . 'admin_manage.php');
    ?>
    <link rel="stylesheet" href="../css/manage.css">
    <title>商品管理</title>
</head>
<body>
    <h1>商品管理</h1>
    <hr>
    <div class="add-wrap">
        <h2>新規追加</h2>
        <form method="post" action="../html/add_manage.php" enctype="multipart/form-data">
            <label>商品名：<input type="text" name="name"></label><br>
            <label>値段：<input type="text" name="price"></label><br>
            <label>個数：<input type="text" name="amount"></label><br>
            <label>概要：<input type="text" name="overview"></label><br>
            種類：<select name="type">
                <option value="boy">少年漫画</option>
                <option value="youth">青年漫画</option>
                <option value="girl">少女漫画</option>
                <option value="novel">小説</option>
                <option value="utility">実用書</option>
                <option value="photo">写真集</option>
            </select><br>
            ジャンル：<select name="genre">
                <option value="battle">バトル</option>
                <option value="fantasy">ファンタジー</option>
                <option value="love">恋愛</option>
                <option value="gag">ギャグ</option>
                <option value="sports">スポーツ</option>
                <option value="other">その他</option>
            </select><br>
            表紙：<input type="file" name="img" value="ファイルを選択"><br>
            <input type="submit" name="add" value="商品追加">
        </form>
    </div>
    <hr>

    <div class="change-wrap">
        <h2>商品情報変更</h2>
        <table>
            <tr>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫</th>
                <th>概要</th>
                <th>種類</th>
                <th>ジャンル</th>
                <th>削除</th>
            </tr>
            <?php
            foreach($items as $item){ ?>
            <tr>
                <td><img src="<?php echo '../img/itemimg/' . $item['img'] ?>" alt="thumbnail"></td>
                <td><?php echo $item['name'] ?> </td>
                <td><?php echo $item['price'] ?> </td>
                <td><?php echo $item['amount'] ?> </td>
                <td><?php echo $item['overview'] ?> </td>
                <td><?php echo $item['type'] ?> </td>
                <td><?php echo $item['genre'] ?> </td>
            </tr>
            <?php
            } ?>
            </table>


</body>
</html>