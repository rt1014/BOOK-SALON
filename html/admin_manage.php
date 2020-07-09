<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(MODEL_TEMP . 'manage.php');
require_once(MODEL_TEMP . 'db.php');
require_once(MODEL_TEMP . 'item.php');

$db = db_connect();

// DBの商品一覧を取得
$items = get_item($db);

// タブ（種類）ごとの商品一覧を取得
$boy_tab_items = tab_get_item($db,"boy");
$youth_tab_items = tab_get_item($db,"youth");
$girl_tab_items = tab_get_item($db,"girl");
$novel_tab_items = tab_get_item($db,"novel");
$utility_tab_items = tab_get_item($db,"utility");
$photo_tab_items = tab_get_item($db,"photo");

