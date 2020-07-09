<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(MODEL_TEMP . 'item.php');
require_once(MODEL_TEMP . 'db.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['id'])){
        $db = db_connect();

        delete($db, $_POST['id']);

        header('location:../view/cart_view.php');
        exit;
    }
}