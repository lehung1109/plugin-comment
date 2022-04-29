<?php if ( empty( $comment ) || empty( $fileManager ) ) return; ?>

<?php
    if ( empty( $post_id ) ) $post_id = get_the_ID();
?>

<div class="comment-container">
    <div class="comment-top">
        <div class="comment-avatar">
            <?php echo substr( $comment->comment_author, 0, 1 ); ?>
        </div>

        <div class="comment-author-name">
            <span class="name"><?php echo esc_html( $comment->comment_author ); ?></span>
        </div>

        <?php
            if ( $comment->user_id ) {
                $user_comment = get_user_by( 'id', $comment->user_id );

                $is_admin = user_can($user_comment, 'administrator');
            }

            if ( ! empty( $is_admin ) ):
        ?>
            <div class="admin-name">Quản trị viên</div>
        <?php endif; ?>
    </div>

    <div class="comment-text">
        <div class="comment-info">
            <div class="comment-description">
                <?php echo $comment->comment_content; ?>
            </div>
        </div>

        <div class="comment-bottom">
            <div class="reply">
                <a class="reply__link js-reply-comment" data-commentid="<?php echo $comment->comment_ID; ?>" data-postid="<?php echo $post_id; ?>">Trả lời</a>
            </div>

            <span style="margin-right: 5px;"> - </span>

            <?php
                $space_year = date( 'Y') - get_comment_date( 'Y', $comment->comment_ID );
                $space_month = date( 'm') - get_comment_date( 'm', $comment->comment_ID );
                $space_day = date( 'd') - get_comment_date( 'd', $comment->comment_ID );
                $space_hour = date( 'G') - get_comment_date( 'G', $comment->comment_ID );
                $space_minute = date( 'i') - get_comment_date( 'i', $comment->comment_ID );
                $space_second = date( 's') - get_comment_date( 's', $comment->comment_ID );
            ?>
            <time class="reply__published-date" datetime="<?php echo get_comment_date( 'c', $comment->comment_ID ); ?>">
                <?php
                    if ( $space_year > 0 ) {
                        echo $space_year . ' năm trước đây';
                    } elseif ( $space_month > 0 ) {
                        echo $space_month . ' tháng trước đây';
                    } elseif ( $space_day > 0 ) {
                        echo $space_day . ' ngày trước đây';
                    } elseif ( $space_hour > 0 ) {
                        echo $space_hour . ' giờ trước đây';
                    } elseif ( $space_minute > 0 ) {
                        echo $space_minute . ' phút trước đây';
                    } elseif ( $space_second > 0 ) {
                        echo $space_second . ' giây trước đây';
                    } else {
                        echo get_comment_date( 'd/m/Y', $comment->comment_ID );
                    }
                ?>
            </time>
        </div>
    </div>
</div>