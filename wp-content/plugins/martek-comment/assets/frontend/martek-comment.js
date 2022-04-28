(($) => {
  let $js_popup_comment = $('.js-popup-comment');

  if ( $js_popup_comment.length ) {
    $js_popup_comment.on('click', function(event) {
      event.preventDefault();

      $('.comment-popup').addClass('is-show');
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
      let $description = $('textarea[name="comment-description"]').val();
      let $name = $('input[name="comment-name"]').val();
      let $phone = $('input[name="comment-phone"]').val();
      let $post_id = $('input[name="comment_post_id"]').val();
      let $user_id = $('input[name="user_id"]').val();

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
        },
        success: function (response) {
          $comment_box_elem.unblock();

          let $data = response.data;

          console.warn(response);
        },
        error: function (response) {
          $comment_box_elem.unblock();

          console.warn(response);
        }
      });
    });
  }
})(jQuery);