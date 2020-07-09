<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(MODEL_TEMP . 'db.php');
require_once(MODEL_TEMP . 'item.php');

$db = db_connect();

if(isset($_POST['search']) === TRUE){
    $search_items = search_items($db, $_POST['search']);
}
