<?php defined("CATALOG") or die("Access denied"); ?>
<?php require_once 'header.php' ?>
<body>
<div class="page-wrap">
    <div class="sidebar">
        <?php include 'sidebar.php'; ?>
    </div>

    <div class="content">
        <ul class="breadcrumbs">
            <?= $breadcrumbs; ?>
        </ul>
       <?php if ($get_one_product): ?>
        <div class="content-page">

            <h1 class="product_title"><?=$get_one_product['title']?></h1>

            <div class="img-product"><img src="<?= PATH.PRODUCTIMG.$get_one_product['image']?>" alt="картинка" /></div>


            <div class="product-txt">
                <?=$get_one_product['content']?>

            </div>

            <div class="product-inf">
                Просмотров: 210  /  Комментариев: <?=$count_comments?>
            </div>

            <div class="clr"></div>


            <?php else: ?>
            Такого товара нет
        <?php endif; ?>
    </div>

</div>
    <div class="clr"></div
<?php require_once 'footer.php' ?>