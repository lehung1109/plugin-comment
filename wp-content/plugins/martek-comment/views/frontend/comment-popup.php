<?php if ( empty( $fileManager ) ) return; ?>

<div class="comment-popup">
    <div class="comment-popup__inner">
        <div class="comment-popup-box">
            <div class="comment-popup__content">
                <div class="comment-popup__title">GỬI Bình luận</div>

                <div class="comment-popup__subtitle">Nhập thông tin của bạn</div>

                <div class="comment-popup__form">
                    <div class="comment-form-item">
                        <input name="comment-name" type="text" placeholder="Họ tên*:">
                    </div>

                    <div class="comment-form-item">
                        <input name="comment-phone" type="tel" placeholder="Điện thoại*:">
                    </div>

                    <div class="comment-form-item comment-form-action">
                        <a class="comment-button js-comment-submit">HOÀN THÀNH</a>
                    </div>
                </div>

                <div class="comment-popup-close js-comment-popup-close">
                    <svg viewBox="0 0 40 40">
                        <path class="close-x" d="M 10,10 L 30,30 M 30,10 L 10,30"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
