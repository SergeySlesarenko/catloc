<?php defined("CATALOG") or die("Access denied");

include 'main_controller.php';
include "models/{$view}_model.php";

$get_one_product = get_one_product($product_alias);
// получаем ID категории
$id = $get_one_product['parent'];

$product_id = $get_one_product['id'];
//получаем количество коментариев к товару
$count_comments = count_comments($product_id);

 //получаем масив коментариев к продукту
$get_comments = get_comments($product_id);
//полуаем дерево
$comments_tree = map_tree($get_comments);
$comments = categories_to_string($comments_tree, 'comments_template.php');


include 'libs/breadcrumbs.php';

include VIEW."{$view}.php";

?>