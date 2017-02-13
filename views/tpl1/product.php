<?php defined("CATALOG") or die("Access denied"); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= strip_tags($breadcrumbs) ?></title>
    <link rel="stylesheet" href="<?= PATH.VIEW ?>css/style.css">
    <link rel="stylesheet" href="<?= PATH.VIEW ?>css/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?= PATH.VIEW ?>css/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="<?= PATH.VIEW ?>css/jquery-ui.min.css">

</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <?php include 'sidebar.php'; ?>
    </div>
    <?php include 'menu.php'; ?>
    <div class="content">
        <p><?= $breadcrumbs; ?></p>
        <br>
        <hr>
        <?php if ($get_one_product): ?>
            <?php print_arr($get_one_product); ?>
        <?php else: ?>
            Такого товара нет
        <?php endif; ?>
        <br>
        <hr>
        <h3> Отзывы о товаре: (<?=$count_comments?>)</h3>
        <br>
        <ul class="comments">
            <?php echo $comments; ?>
        </ul>
        <button class="open-form">Добавить отзыв</button>
        <div id="form-wrap">
            <form action="<?= PATH ?>add_comment" method="post" class="form">
                <?php if(isset($_SESSION['auth']['user'])):?>
                    <p style="display: none">
                        <label for="comment-author">Имя:</label>
                        <input type="text" name="comment-author" id="comment-author"
                               value="<?= htmlspecialchars($_SESSION['auth']['user']);?>">
                    </p>
                    <?php else:?>
                    <p>
                        <label for="comment-author">Имя:</label>
                        <input type="text" name="comment-author" id="comment-author">
                    </p>

                <?php endif;?>
                <p>
                    <label for="comment-text">Текст:</label>
                    <textarea name="comment-text" id="comment-text" cols="30" rows="5"></textarea>
                </p>
                <input type="hidden" name="parent" id="parent" value="0">
                <!--					<p>-->
                <!--						<input type="submit" value="Добавить отзыв" name="submit">-->
                <!--					</p>-->
            </form>
        </div>
        <div id="loader"><span></span></div>
        <div id="errors"></div>
    </div>

</div>
<script src="<?= PATH.VIEW ?>js/jquery-1.9.0.min.js"></script>
<script src="<?= PATH.VIEW ?>js/jquery-ui.min.js"></script>
<script src="<?= PATH.VIEW ?>js/jquery.accordion.js"></script>
<script src="<?= PATH.VIEW ?>js/jquery.cookie.js"></script>
<script>
    $(document).ready(function () {
        $(".category").dcAccordion();
        $('#errors').dialog({
            autoOpen: false,
            width: 450,
            modal: true,
            title: 'Сообщение об ошибке',
            show: {effect: 'slide', duration: 700},
            hide: {effect: 'explode', duration: 700},
        });

        $('#form-wrap').dialog({
            autoOpen: false,
            width: 450,
            modal: true,
            title: 'Добавление сообщения',
            resizable: false,
            draggable: false,
            show: {effect: 'slide', duration: 700},
            hide: {effect: 'explode', duration: 700},
            buttons: {
                "Добавить отзыв": function () {
                    var commentAuthor = $.trim($('#comment-author').val());
                    var commentText = $.trim($('#comment-text').val());
                    var parent = $('#parent').val();
                    var productId = <?=$product_id?>;
                    if (commentText == '' || commentAuthor == '') {
                        alert('Все поля обязательны к заполнению');
                        return;
                    }
                    $('#comment-text').val('');
                    $(this).dialog('close');

                    $.ajax({
                        url: '<?=PATH?>add_comment',
                        type: 'post',
                        data: {
                            commentAuthor: commentAuthor, comment_Text: commentText,
                            parent: parent, productId: productId
                        },
                        beforeSend: function (){
                            $('#loader').fadeIn();
                        },
                        success: function (res) {
                            var result = JSON.parse(res);
                            if (result.answer == 'Комментарий добавлен!') {
                                var showComment = '<li class="new-comment" id="comment-' + result.id + '">' + result.code + '</li>';
                                if (parent == 0) {
                                    $('ul.comments').append(showComment);
                                } else {
                                    // если ответ
                                    // находим родителя li
                                    var parentComment = $this.closest('li');
                                    // смотрим, есть ли ответы
                                    var childs = parentComment.children('ul');
                                    //console.log(childs);
                                    if (childs.length) {
                                        // если ответы есть
                                        childs.append(showComment);
                                    } else {
                                        // если ответов пока нет
                                        parentComment.append('<ul>' + showComment + '</ul>');
                                    }
                                }
                                $('#comment-' + result.id).delay(1000).show('shake', 1000);
                            } else {
                                //если не добавлен
                                $('#errors').text(result.answer);
                                $('#errors').delay(1000).queue(function () {
                                    $(this).dialog('open');
                                    $(this).dequeue();
                                });
                                /*$('#errors').delay(1000).queue(function(next){
                                 $(this).dialog('open');
                                 next();
                                 });*/
                            }
                        },
                        error: function () {
                            alert("Ошибка!");
                        },
                        complete: function () {
                            $('#loader').delay(1000).fadeOut();
                        }
                    });
                },
                "Отмена": function () {
                    $(this).dialog('close');
                    $('#comment-text').val('');
                }
            }
        });
        $('.open-form').click(function () {
            $('#form-wrap').dialog('open');
            var parent = $(this).children().attr('data');
            $this = $(this);
            if (!parseInt(parent)) parent = 0;
            $('input[name="parent"]').val(parent);
        });
    });
</script>
<script src="<?=PATH.VIEW?>js/workscript.js"></script>
</body>
</html>