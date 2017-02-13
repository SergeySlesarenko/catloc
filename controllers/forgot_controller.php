<?php defined("CATALOG") or die("Access denied");

include 'main_controller.php';
include "models/{$view}_model.php";
if( isset($_SESSION['auth']['user']) ) redirect(PATH);

// если запрошено восстановление пароля
if(isset($_POST['fpass'])){
    forgot();
    redirect();
}
// если есть ссылка на восстановление пароля
elseif(isset($_GET['forgot'])){
    //d($_GET);
    access_change();
    $breadcrumbs = "<a href='" . PATH . "'>Главная</a> / Восстановление пароля";
    include VIEW."{$view}.php";
}
// отправлен новый пароль
elseif(isset($_POST['change_pass'])){
    change_forgot_password();
    redirect(PATH . "forgot/?forgot=" . $_POST['hash']);
}
else{
    redirect(PATH);
}
