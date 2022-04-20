<?php namespace Product\Helpers;

use Premmerce\SDK\V2\FileManager\FileManager;

class TemplateFile extends FileManager {
	public function locateTemplate($template)
	{
		if ($file = locate_template('templates/martek-product/' . $template)) {
			return $file;
		}

		return $this->getPluginDirectory() . 'views/' . $template;
	}
}