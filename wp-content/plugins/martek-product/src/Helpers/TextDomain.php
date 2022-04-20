<?php namespace Product\Helpers;

use Premmerce\SDK\V2\FileManager\FileManager;

class TextDomain {

	/**
	 * @var FileManager
	 */
	private $fileManager;

	public function __construct(FileManager $fileManager) {
		$this->fileManager = $fileManager;

		add_action('plugins_loaded', [ $this, 'loaded' ]);
	}

	/**
	 * Load plugin translations
	 */
	public function loaded()
	{
		$name = $this->fileManager->getPluginName();
		load_plugin_textdomain('martek-product', false, $name . '/languages/');
	}
}