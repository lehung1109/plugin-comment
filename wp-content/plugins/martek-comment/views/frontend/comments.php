<?php

if ( empty( $fileManager ) ) return;

if ( empty( $post_id ) ) $post_id = get_the_ID();

?>

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
            <input type="hidden" name="comment_post_id" value="<?php echo $post_id; ?>">
            <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
            <input type="hidden" name="comment_parent" id="comment_parent" value="0">
            <a class="js-popup-comment comment-button">GỬI</a>
        </div>
    </div>

    <?php if ( ! empty( $comments ) ): ?>
        <div class="comment-list">
            <div class="comment-list-box">
                <div class="comment-list__list">
                    <?php foreach( $comments as $comment ): ?>
                        <div class="comment-list__item <?php if ( ! $comment->comment_approved ) echo 'comment-unapprove'; ?> comment-parent">
                            <?php
                                $fileManager->includeTemplate(
                                    'frontend/comment-details.php',
                                    [
                                        'comment' => $comment,
                                        'fileManager' => $fileManager,
                                        'post_id' => $post_id,
                                    ]
                                );
                            ?>

                            <?php if ( ! empty( $comment->get_children() ) ): ?>
                                <div class="comment-children">
                                    <?php foreach( $comment->get_children() as $children ): ?>
                                        <div class="comment-list__item">
                                            <?php
                                                $fileManager->includeTemplate(
                                                    'frontend/comment-details.php',
                                                    [
                                                        'comment' => $children,
                                                        'fileManager' => $fileManager,
                                                        'post_id' => $post_id,
                                                    ]
                                                );
                                            ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

