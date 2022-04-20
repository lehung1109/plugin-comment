<?php namespace Product;

use Premmerce\SDK\V2\FileManager\FileManager;
use Product\Admin\Admin;
use Product\Ajax\AjaxVariations;
use Product\Helpers\TemplateFile;
use Product\Helpers\TextDomain;
use Product\Taxonomy\TaxonomyCategory;
use Product\Widget\PopularProducts;

/**
 * Class ProductPlugin
 *
 * @package Product
 */
class ProductPlugin {

	/**
	 * @var FileManager
	 */
	private $fileManager;

	/**
	 * @var TemplateFile
	 */
	private $templateFile;

	/**
	 * ProductPlugin constructor.
	 *
	 * @param string $mainFile
	 */
	public function __construct( $mainFile ) {
		$this->fileManager  = new FileManager( $mainFile );
		$this->templateFile = new TemplateFile( $mainFile );
	}

	/**
	 * Run plugin part
	 */
	public function run() {
		new TextDomain( $this->fileManager );
		new ProductType();
		new TaxonomyCategory();
		new AjaxVariations( $this->templateFile );

		if ( is_admin() ) {
			new Admin( $this->fileManager );
		}

		add_action( 'widgets_init', [ $this, 'widgets' ] );
	}

	/**
	 * Register widgets
	 */
	public function widgets() {
		register_widget(PopularProducts::class);
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