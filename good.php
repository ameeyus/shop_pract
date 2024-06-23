<?php
    require_once "vendor/autoload.php";
    use App\DB;
    $db = new DB();
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $good = $db->get_good_by_id($id);
        if (count($good)) {
            $good["Images"] = json_decode($good["Images"], true);
            $good["Specs"] = json_decode($good["Specs"], true);
            $good["Info"] = explode("\n", $good["Info"]);
        }
        else {
            header("Location:index.php");
            exit;
        }
    }
    else
    {
        header("location:index.php");
        exit;
    }

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/common.css">
    <link rel="stylesheet" href="assets/css/good.css">
    <title>Document</title>
</head>
<body>

<?php include "include/header.php"; ?>

<main>
    <div class="general">
        <div class="photos">
            <div class="current">
                <div class="image">
                    <img src="assets/goods/<?= $good["Images"][0] ?>" alt="">
                </div>
            </div>
            <div class="preview">
                <div class="image active">
                    <img src="assets/goods/<?= $good["Images"][0] ?>" alt="">
                </div>
                <?php for ($index = 1; $index < count($good["Images"]); $index++): ?>
                <div class="image">
                    <img src="assets/goods/<?= $good["Images"][$index] ?>" alt="">
                </div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="info">
            <h1><?= $good["Name"] ?></h1>
            <div class="price">
                <p><?= number_format($good["Price"], 0, null, "") ?></p>
                <button>Купить</button>
            </div>
            <ul>
                <?php foreach ($good["Info"] as $info): ?>
                <li><?= $info ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="detail">
        <div class="tab_names">
            <div class="tab_name" data-id="1">Характеристики</div>
            <div class="tab_name" data-id="2">Описание</div>
            <div class="tab_name" data-id="3">Отзыва</div>
        </div>
        <div class="tabs">
            <div class="tab active" data-id="1">
                <h2>Технические характеристики</h2>
                <div class="table">
                    <?php foreach ($good["Specs"] as $spec): ?>
                    <p><?= $spec["name"] ?></p>
                    <p><?= $spec["value"] ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tab" data-id="2">
                <?= $good["Description"] ?>
            </div>
            <div class="tab" data-id="3">
                <h2>Отзывы</h2>
                <div class="reviews">
                    <div class="review">
                        <div class="score">5</div>
                        <div class="text">
                            <p class="name">Юрий</p>
                            <p class="date">11 ноября</p>
                            <p>Отличное обслуживание, все работает как часы. </p>
                        </div>
                    </div>
                    <div class="review">
                        <div class="score">5</div>
                        <div class="text">
                            <p class="name">Юрий</p>
                            <p class="date">11 ноября</p>
                            <p>Отличное обслуживание, все работает как часы. </p>
                        </div>
                    </div>
                    <div class="review">
                        <div class="score">5</div>
                        <div class="text">
                            <p class="name">Юрий</p>
                            <p class="date">11 ноября</p>
                            <p>Отличное обслуживание, все работает как часы. </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>

<?php include "include/footer.php"; ?>

<script src="assets/js/good.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>