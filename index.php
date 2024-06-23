<?php
    require "vendor/autoload.php";
    use App\DB;
    $db = new DB();
    if (isset($_GET["category_id"])) {
        $goods = $db->get_filtred_goods($_GET["category_id"]);
    }
    else {
        $goods = $db->get_all_goods();
    }

    $categories = $db->get_categories();
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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include "include/header.php"; ?>

<main>
    <button class="nav_button">
        <img src="assets/images/menu-svgrepo-com.svg" alt="">
    </button>
    <nav>
        <ul>
            <?php foreach ($categories as $category): ?>
            <li><a href="?category_id=<?= $category["id"] ?>"><?= $category["Name"] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <div class="goods">
        <?php foreach ($goods as $good): ?>
        <a href="good.php?id=<?= $good["id"]?>" class="good">
            <div class="image">
                <img src="assets/goods/<?= $good["Cover"] ?>" alt="">
            </div>
            <p class="price"><?= number_format($good["Price"], 0, null,  "") ?></p>
            <p class="name"><?= $good["Name"] ?></p>
            <button class="add_to_cart" data-id="<?= $good["id"] ?>">В корзину</button>
        </a>
        <?php endforeach; ?>
    </div>
</main>

<?php include "include/footer.php"; ?>

<script src="assets/js/index.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>