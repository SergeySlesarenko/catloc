<li>
    <div class="comment-content<?php if($category['is_admin']) echo ' manager'; ?>">
        <div class="comment-meta">
            <em><b><span><?=htmlspecialchars($category['comment_author'])?></span></b>
                <?=$category['created']?></em>
        </div>
        <div>
            <?= nl2br(htmlspecialchars($category['comment_text']))?>
            <p class="open-form">
                <a class="reply" data="<?=$category['comment_id']?>">Ответить</a>
            </p>
        </div>
    </div>
    <?php if( isset($category['childs']) && $category['childs'] ): ?>
        <ul>
            <?php echo categories_to_string($category['childs'], 'comments_template.php'); ?>
        </ul>
    <?php endif; ?>
</li>