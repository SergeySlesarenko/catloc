<div class='comment-content <?php if($comment['is_admin']) echo 'manager'?>'>
    <div class='comment-meta'>
        <em><b><span><?=htmlspecialchars($comment['comment_author'])?></span></b> <?=$comment['created']?></em>
    </div>
    <div><?=nl2br(htmlspecialchars($comment['comment_text']))?></div>
</div><?php