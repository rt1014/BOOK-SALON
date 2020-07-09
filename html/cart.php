<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');
require_once(MODEL_TEMP . 'item.php');
require_once(MODEL_TEMP . 'db.php');
require_once(MODEL_TEMP . 'user.php');

$db = db_connect();

$user_id = get_user_id($db, $_SESSION['username']);

$get_cart = get_cart($db, $user_id[0]);


