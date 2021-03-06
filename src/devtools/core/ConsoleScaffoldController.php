<?php
namespace Ubiquity\devtools\core;

use Ubiquity\devtools\cmd\ConsoleFormatter;
use Ubiquity\controllers\Startup;
use Ubiquity\cache\CacheManager;
use Ubiquity\scaffolding\creators\RestControllerCreator;
use Ubiquity\controllers\rest\RestController;
use Ubiquity\controllers\rest\api\jsonapi\JsonApiRestController;

class ConsoleScaffoldController extends \Ubiquity\scaffolding\ScaffoldController {
	private $activeDir;
	const DELIMITER = '─';

	public function __construct($activeDir) {
		$this->activeDir = $activeDir;
	}

	protected function storeControllerNameInSession($controller) {
	}

	private function prefixLines($str,$prefix){
		$lines=explode("\n", $str);
		array_walk($lines, function(&$line) use($prefix){if(trim($line)!=null) $line=$prefix.$line;});
		return implode("\n", $lines);
	}

	public function showSimpleMessage($content, $type, $title = null, $icon = "info", $timeout = NULL, $staticName = null) {
		return ConsoleFormatter::showMessage($content, $type,$title);
	}

	public function getTemplateDir() {
		return $this->activeDir . "/devtools/project-files/templates/";
	}

	protected function _addMessageForRouteCreation($path, $jsCallback = "") {
		echo ConsoleFormatter::showMessage("You need to re-init Router cache to apply this update with init-cache command\n");
	}

	public function addRestController($restControllerName, $resource, $routePath = "", $reInit = true) {
		$restCreator = new RestControllerCreator( $restControllerName, RestController::class,$resource, $routePath );
		$restCreator->create ( $this ,$reInit);
	}

	public function addRestApiController($restControllerName, $routePath = "", $reInit = true){
		$restCreator = new RestControllerCreator( $restControllerName, JsonApiRestController::class,'', $routePath );
		$restCreator->create ( $this ,$reInit);
	}

	public function initRestCache($refresh = true) {
		$config = Startup::getConfig ();
		\ob_start ();
		CacheManager::initCache ( $config, "rest" );
		CacheManager::initCache ( $config, "controllers" );
		$message = \ob_get_clean ();
		echo $this->showSimpleMessage ($message, "info", "Rest", "info cache re-init");
	}
}

