<?php
    session_start();
    $goods_id = $_POST['goods_id'];
$_SESSION['cart'][$goods_id]--;
    if ($_SESSION['cart'][$goods_id] === 0) {
        unset($_SESSION['cart'][$goods_id]);
    }
    else {

    }

