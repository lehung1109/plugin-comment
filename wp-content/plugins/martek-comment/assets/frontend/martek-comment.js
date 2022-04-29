(($) => {
  let $js_popup_comment = $('.js-popup-comment');

  if ( $js_popup_comment.length ) {
    $(document).on('click', '.js-popup-comment', function(event) {
      event.preventDefault();

      let $comment_popup_elem = $('.comment-popup');

      $('.comment-popup-thank-you-content').removeClass('active');
      $('.comment-popup-form-content').addClass('active');

      $comment_popup_elem.addClass('is-show');
      $comment_popup_elem.removeClass('is-comment-reply');

      if ( $(this).closest('.comment-reply').length ) {
        $comment_popup_elem.addClass('is-comment-reply');
      }
    });
  }

  let $js_comment_popup_close = $('.js-comment-popup-close');

  if ( $js_comment_popup_close.length ) {
    $js_comment_popup_close.on('click', function (event) {
      $('.comment-popup').removeClass('is-show');
    });
  }

  let $js_comment_submit = $('.js-comment-submit');

  if ( $js_comment_submit.length ) {
    $js_comment_submit.on('click', function (event) {
      event.preventDefault();

      let $comment_box_elem = $(this).closest('.comment-popup-box');
      let $description;
      let $name = $('input[name="comment-name"]').val();
      let $phone = $('input[name="comment-phone"]').val();
      let $post_id;
      let $user_id;
      let $comment_parent_id;

      if ( $(this).closest('.is-comment-reply').length ) {
        $description = $('.comment-reply textarea[name="comment-description"]').val();
        $post_id = $('.comment-reply input[name="comment_post_id"]').val();
        $user_id = $('.comment-reply input[name="user_id"]').val();
        $comment_parent_id = $('.comment-reply input[name="comment_parent"]').val();
      } else {
        $description = $('textarea[name="comment-description"]').val();
        $post_id = $('input[name="comment_post_id"]').val();
        $user_id = $('input[name="user_id"]').val();
        $comment_parent_id = $('input[name="comment_parent"]').val();
      }

      $comment_box_elem.block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});


      $.ajax({
        type: 'post',
        url: comment_ajax_object.ajax_url,
        dataType : 'json',
        data: {
          action: 'handle_comment_form',
          description: $description,
          post_id: $post_id,
          user_id: $user_id,
          name: $name,
          phone: $phone,
          comment_type: 'comment',
          comment_parent_id: $comment_parent_id,
        },
        success: function (response) {
          $comment_box_elem.unblock();

          let $data = response.data;

          if ( typeof $data.errors === 'object') {
            $data.errors.map(error => {
              alert(error);
            });

            return;
          } else if ( typeof $data.errors === 'string' ) {
            alert($data.errors);

            return;
          }

          $('.comment-popup-form-content').removeClass('active');
          $('.comment-popup-thank-you-content').addClass('active');
          $('textarea[name="comment-description"]').val('');
          $('input[name="comment-name"]').val('');
          $('input[name="comment-phone"]').val('');
        },
        error: function (response) {
          $comment_box_elem.unblock();

          console.warn(response);
        }
      });
    });
  }

  // process js reply comment
  let $js_reply_comment = $('.js-reply-comment');

  if ( $js_reply_comment.length ) {
    $(document).on('click', '.js-reply-comment', function (event) {
      let $comment_id = $(this).data('commentid');
      let $post_id = $(this).data('postid');
      let $comment_author_parent = $(this).closest('.comment-container').find('.comment-author-name .name').text();
      let $comment_reply = $('.comment-reply');
      let $html;

      if ( $comment_reply.length ) {
        $html = $comment_reply[0].outerHTML;

        $comment_reply.remove();
      } else {
        let $form = $('.comment-form')[0].outerHTML;
        $html = `
          <div class="comment-reply">
              ${$form}
          </div>
        `;
      }

      $(this).closest('.comment-container').after($html);

      // set parent comment id
      setTimeout( () => {
        let $reply = $(this).closest('.comment-parent').find('.js-reply-comment');
        let $comment_id = $reply.data('commentid');

        let $textarea = $(this).closest('.comment-parent').find('textarea');

        $textarea.val('@' + $comment_author_parent + ': ');
        $textarea[0].focus();

        $(this).closest('.comment-parent').find('input[name="comment_parent"]').val($comment_id);
      });
    });
  }
})(jQuery);