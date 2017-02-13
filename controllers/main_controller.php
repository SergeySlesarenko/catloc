<?php defined("CATALOG") or die("Access denied");

include 'config.php';
include 'models/main_model.php';

$categories = get_cat();
//print_arr($categories);
$categories_tree = map_tree($categories);

$categories_menu = categories_to_string($categories_tree);
//получение страниц меню
$pages = get_pages();
//print_arr($pages);
?>