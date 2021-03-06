<?php

/*
 * This file is part of bhittani/kk-star-ratings.
 *
 * (c) Kamal Khan <shout@bhittani.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Bhittani\StarRating\core\wp\actions;

use function Bhittani\StarRating\core\functions\action;

if (! defined('KK_STAR_RATINGS')) {
    http_response_code(404);
    exit();
}

function save_post($id): void
{
    if (wp_verify_nonce($_POST[kksr('slug').'-metabox'] ?? '', __FUNCTION__)
        && ! (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        && current_user_can('edit_post', $id)
    ) {
        action('metabox/save', $id, $_POST);
    }
}
