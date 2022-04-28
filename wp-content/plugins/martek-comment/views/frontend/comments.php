<?php if ( empty( $fileManager ) ) return; ?>

<div class="comments">
    <div class="comment-header">
        <div class="comment-title">Ý kiến của bạn</div>

        <ul class="comment-tab">
            <li class="active">
                <a href="">Mới nhất</a>
                <span>|</span>
            </li>

            <li>
                <a href="">Xem nhiều nhất</a>
            </li>
        </ul>
    </div>

    <div class="comment-form">
        <div class="comment-form-item">
            <textarea name="comment-description" cols="30" rows="10" placeholder="Bình luận của bạn"></textarea>
        </div>

        <div class="comment-form-item comment-form-action">
            <input type="hidden" name="comment_post_id" value="<?php echo get_the_ID(); ?>">
            <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
            <a class="js-popup-comment comment-button">GỬI</a>
        </div>
    </div>
</div>

