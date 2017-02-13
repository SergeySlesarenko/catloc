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
            <div class="content-page">
                <h1 class="product_title"><?=$page['text']?></h1>
            </div>
            <video src='https://www.youtube.com/watch?v=7vGb4EG7AHo' width="300" height="200" controls="controls">Ваш браузер
                не поддерживает элемент video.</video>
        </div>
        <div class="clr"></div
<?php require_once 'footer.php' ?>