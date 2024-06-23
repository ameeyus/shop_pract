<?php
require_once "vendor/autoload.php";
use App\DB;
$db = new DB();
session_start();
$user_id = $_SESSION["user_id"] ?? 0;
?>

<!doctype html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport"
          content = "width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
    <title>Shop</title>
    <link rel = "stylesheet" href = "assets/css/common.css">
    <?php if ($user_id): ?>
        <link rel = "stylesheet" href = "assets/css/new_post.css">
    <?php else: ?>
        <link rel = "stylesheet" href = "assets/css/user.css">
    <?php endif; ?>
</head>
<body>
<script src="assets/js/common.js" defer></script>

<?php include "include/header.php"?>

<?php
if ($user_id) {
    include "good.php";
}
else{
    include "include/user_login.php";
}
?>

<?php if ($user_id): ?>
    <script src="assets/js/new_post.js" defer></script>
<?php else: ?>
    <script src="assets/js/user.js" defer></script>
<?php endif; ?>

<?php include "include/footer.php"?>

</body>
</html>