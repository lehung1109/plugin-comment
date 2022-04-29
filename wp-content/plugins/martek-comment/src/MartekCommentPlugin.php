<?php namespace MartekComment;

use Premmerce\SDK\V2\FileManager\FileManager;
use MartekComment\Admin\Admin;
use MartekComment\Frontend\Frontend;
use MartekComment\Ajax\Ajax;

/**
 * Class MartekCommentPlugin
 *
 * @package MartekComment
 */
class MartekCommentPlugin {

	/**
	 * @var FileManager
	 */
	private $fileManager;

	/**
	 * MartekCommentPlugin constructor.
	 *
     * @param string $mainFile
	 */
    public function __construct($mainFile) {
        $this->fileManager = new FileManager($mainFile);

        add_action('plugins_loaded', [ $this, 'loadTextDomain' ]);

	}

	/**
	 * Run plugin part
	 */
	public function run() {
		if ( is_admin() ) {
			new Admin( $this->fileManager );
		} else {
			new Frontend( $this->fileManager );
		}

        new Ajax( $this->fileManager );
	}

    /**
     * Load plugin translations
     */
    public function loadTextDomain()
    {
        $name = $this->fileManager->getPluginName();
        load_plugin_textdomain('martek-comment', false, $name . '/languages/');
    }

	/**
	 * Fired when the plugin is activated
	 */
	public function activate() {
		// TODO: Implement activate() method.
	}

	/**
	 * Fired when the plugin is deactivated
	 */
	public function deactivate() {
		// TODO: Implement deactivate() method.
	}

	/**
	 * Fired during plugin uninstall
	 */
	public static function uninstall() {
		// TODO: Implement uninstall() method.
	}
}