<?php namespace Product\Admin;

use Premmerce\SDK\V2\FileManager\FileManager;

/**
 * Class Admin
 *
 * @package Product\Admin
 */
class Admin {

	/**
	 * @var FileManager
	 */
	private $fileManager;

	/**
	 * Admin constructor.
	 *
	 * Register menu items and handlers
	 *
	 * @param FileManager $fileManager
	 */
	public function __construct( FileManager $fileManager ) {
		$this->fileManager = $fileManager;

        add_filter('wp_import_post_terms', [$this, 'change_product_tag_to_post_tag_in_post_term'], 10, 3);
        add_filter('wp_import_post_data_raw', [$this, 'remove_span_has_style_in_content']);
        add_action('import_end', [$this, 'remap_gallery_images'], 10);
        add_filter('wp_import_terms', [$this, 'change_product_tag_to_post_tag_in_term']);
	}

    /**
     * support import post_tag default
     *
     * @param $terms
     * @param $post_id
     * @param $parse_data
     * @return mixed
     */
    public function change_product_tag_to_post_tag_in_post_term($terms, $post_id, $parse_data) {
        if (empty($terms)) return $terms;

        foreach ($terms as $index => $term) {
            if (isset($term['domain']) && $term['domain'] == 'product_tag') {
                $terms[$index]['domain'] = 'tag';
            }
        }

        if ($parse_data['post_type'] == 'product') {
            $this->import_acf_meta_field($post_id, $parse_data);
        }

        return $terms;
    }

    /**
     * remove span has style
     *
     * @param $post
     * @return mixed
     */
    public function remove_span_has_style_in_content($post) {
        try {
            $post['post_content'] = preg_replace('/(<span[^>]+style[^>]+>)(.*?)(<\/span>)/', '${2}', $post['post_content']);
            $post['post_content'] = str_replace(
                [
                    'http://ttbv.lndo.site:8000/',
                    'https://thietbibepviet.vn/',
                    'http://thietbibepviet.vn/',
                    'https://dev-thietbibepviet.pantheonsite.io/',
                    'http://dev-thietbibepviet.pantheonsite.io/',
                ],
                [
                    '/',
                    '/',
                    '/',
                    '/',
                    '/',
                ],
                $post['post_content']
            );
        } catch (\Throwable $th) {
            error_log($th->getMessage());
        }

        return $post;
    }

    /**
     * Import acf field for new post
     *
     * @param $post_id
     * @param $parse_data
     */
    public function import_acf_meta_field($post_id, $parse_data) {
        try {
            $rows = array();
            $row = array();
            $row['field_61042900642ae'] = ''; // Name
            $row['field_610408570175c'] = ''; // SKU
            $row['field_610408c242ccd'] = array(
                'field_610408d042cce' => '', // Regular price
                'field_610408fd42ccf' => '', // Sale price
            );
            $row['field_6104094d7e630'] = ''; // Quantity
            $row['field_61040a7dec0fd'] = $parse_data['post_excerpt'] ?? ''; // Description
            $row['field_61040a91ec0fe'] = ''; // Image

            if (!empty($parse_data['postmeta'])) {
                foreach ($parse_data['postmeta'] as $post_meta) {
                    if (empty($post_meta['key'])) continue;

                    if ($post_meta['key'] == '_sku') {
                        $row['field_610408570175c'] = !empty($post_meta['value']) ? $post_meta['value'] : $parse_data['post_id'];
                    } elseif ($post_meta['key'] == '_regular_price') {
                        $row['field_610408c242ccd']['field_610408d042cce'] = $post_meta['value'];
                    } elseif ($post_meta['key'] == '_sale_price') {
                        $row['field_610408c242ccd']['field_610408fd42ccf'] = $post_meta['value'];
                    } elseif ($post_meta['key'] == '_stock') {
                        $row['field_6104094d7e630'] = $post_meta['value']; // Quantity
                    }
                }
            }

            $rows[] = $row;

            update_field( 'field_61040391c4fd4', $rows, $post_id );
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    /**
     * @param $import
     */
    public function remap_gallery_images($import) {
        $post = $import->processed_posts;
        $gallery_images = array();

        if (empty($post)) return;

        try {
            foreach ($post as $post_id) {
                $images = get_post_meta($post_id, '_product_image_gallery', true);

                if (empty($images)) {
                    $gallery_images[$post_id] = array(0);
                    continue;
                }

                $images = explode(',', $images);
                array_walk($images, function (&$image_id, $index, $post) {
                    $image_id = (int) $image_id;
                    $image_id = $post[$image_id] ?? 0;
                }, $post);
                $images = array_filter($images, function ($image_id) {
                    return $image_id !== 0;
                });

                $gallery_images[$post_id] = $images;
            }

            if (empty($gallery_images)) return;

            foreach ( $gallery_images as $post_id => $images ) {
                update_field('field_6103ff4119b63', $images, $post_id);
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function change_product_tag_to_post_tag_in_term($terms) {
        if (empty($terms)) return $terms;

        foreach ($terms as $index => $term) {
            if (isset($term['term_taxonomy']) && $term['term_taxonomy'] == 'product_tag') {
                $terms[$index]['term_taxonomy'] = 'post_tag';
            }

            $term['term_description'] = preg_replace('/(<span[^>]+style[^>]+>)(.*?)(<\/span>)/', '${2}', $term['term_description']);
            $term['term_description'] = str_replace(
                [
                    'http://ttbv.lndo.site:8000/',
                    'https://thietbibepviet.vn/',
                    'http://thietbibepviet.vn/',
                    'https://dev-thietbibepviet.pantheonsite.io/',
                    'http://dev-thietbibepviet.pantheonsite.io/',
                ],
                [
                    '/',
                    '/',
                    '/',
                    '/',
                    '/',
                ],
                $term['term_description']
            );

            $terms[$index]['term_description'] = $term['term_description'];
        }

        return $terms;
    }
}