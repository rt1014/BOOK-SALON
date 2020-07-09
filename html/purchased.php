<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(MODEL_TEMP . 'item.php');
require_once(MODEL_TEMP . 'db.php');

session_start();

$db = db_connect();

delete_cart($db,$_SESSION['userid']);

header('location:../view/purchased_view.php');