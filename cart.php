<?php
    require_once "vendor/autoload.php";
    use App\DB;
    $db = new DB();
    session_start();
    $cart = $_SESSION["cart"] ?? [];
    $goods = [];
    $total_price = 0;
    foreach ($cart as $key => $count) {
        $goods[] = [
          "good" =>  $db->get_good_by_id($key),
          "count" => $count
        ];

//        var_dump($db->get_good_by_id($key));

        $total_price += $count * $goods[$key].$goods;
    }

//foreach ($cart as $key => $count) {
//    $good = $db->get_good_by_id($key);
//    $goods[] = [
//        "good" => $good,
//        "count" => $count
//    ];
//    $total_price += $count * $good["Price"];
//}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset=" ">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/common.css">
    <link rel="stylesheet" href="assets/css/cart.css">
</head>
<body>

<?php include "include/header.php"; ?>

<main>
    <h1>Корзина</h1>
    <div class="goods">
        <?php foreach ($goods as $good): ?>
            <a href="good.php?id=<?= $good["good"]["id"] ?>" class="good">
                <div class="image">
                    <img src="assets/goods/<?= $good["good"]["Cover"] ?>" alt="">
                </div>
                <div class="text">
                    <p class="name"><?= $good["good"]["Name"] ?></p>
                    <p class="id"><?= $good["good"]["Price"]?> * <?= $good["count"] ?></p>
                </div>
                <div class="price">
                    <p><?= $good["good"]["Price"] * $good["count"] ?></p>
                    <button class="delete_button">
                        <img src="assets/images/delete-svgrepo-com.svg" alt="">
                    </button>
                </div>
            </a>
    </div>
    <?php endforeach; ?>
    <div class="actions">
        <button>Удалить</button>
    </div>
    <div class="total">
        <p class="text">Общая стоимость:</p>
        <p class="price"><?= number_format($total_price, 0, null, " ") ?></p>
    </div>
    <div class="order">
        <form action="" autocomplete="off">
            <label for="phone">Телефон</label>
            <input type="text" id="phone">
            <label for="mail">Эл.почта</label>
            <input type="text" id="mail">
            <label for="comment">Комментарий</label>
            <textarea name="" id="comment" cols="30" rows="10" ></textarea>
            <button>Заказать</button>
        </form>
    </div>
</main>

<?php include "include/footer.php"; ?>

<script src="assets/js/script.js"></script>
</body>
</html>