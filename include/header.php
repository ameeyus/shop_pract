<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
}
$user_id= $_SESSION["user_id"] ?? 0;
?>

<header>
    <a href="index.php" class="logo">
        <img src="assets/images/nvidia-logo-svgrepo-com.svg" alt="logo">
    </a>
    <div class="contacts">
        <div class="link"><a href="tel:+77070707070"><img src="assets/images/phone-circle-fill-svgrepo-com.svg" alt=""></a></div>
        <div class="link"><a href=""><img src="assets/images/facebook-svgrepo-com.svg" alt=""></a></div>
        <div class="link"><a href=""><img src="assets/images/twitter-svgrepo-com.svg" alt=""></a></div>
        <div class="link"><a href=""><img src="assets/images/instagram-167-svgrepo-com.svg" alt=""></a></div>
        <div class="link"><a href=""><img src="assets/images/vk-svgrepo-com.svg" alt=""></a></div>
        <?php if ($user_id): ?>
            <li>
                <a href = "scripts/logout.php">Выход</a>
            </li>
        <?php endif; ?>
    </div>
    <div class="user">
        <a href="user.php">
            <img src="assets/images/user.svg" alt="">
        </a>
        <a href="cart.php">
            <img src="assets/images/cart-2-svgrepo-com.svg" alt="">
        </a>
        <button id="show_popup_search" class="icon">
            <img src="assets/images/search-svgrepo-com.svg" alt="">
        </button>
    </div>
    <div id="popup_search">
        <div class="inner_container">
            <form action="">
                <div>
                    <label for="query">Поисковой запрос</label>
                    <input type="text" id="query">
                </div>
                <button id="search">Искать</button>
            </form>
            <div class="result" id="search_result">
            </div>
        </div>
    </div>
    <div id="popup_login">
        <div class="inner_container">
            <form action="">
                <div>
                    <label for="name_user">Логин</label>
                    <input type="text" name="name" id="name_user">
                    <label for="pass_user">Пароль</label>
                    <input type="password" name="password" id="pass_user">
                </div>
                <button>Войти</button>
            </form>
        </div>
    </div>
</header>