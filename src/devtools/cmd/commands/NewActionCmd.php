<?php

namespace Ubiquity\devtools\cmd\commands;

use Ubiquity\devtools\core\ConsoleScaffoldController;
use Ubiquity\devtools\cmd\ConsoleFormatter;

class NewActionCmd extends AbstractCmd{
	public static function run(&$config,$options,$what,$activeDir){
		$what=self::requiredParam($what, 'controller.action');
		$scaffold=new ConsoleScaffoldController($activeDir);
		@list($controller,$action)=explode('.', $what);
		if($controller!=null && $action!=null){
			$controller=self::getCompleteClassname($config, $controller,'controllers');
			if(class_exists($controller)){
				$parameters=self::getOption($options, 'p', 'params');
				$routePath=self::getOption($options, 'r', 'route');
				$createView=self::getOption($options, 'v', 'create-view',false);
				$routeInfo=null;
				if($routePath!=null){
					$routeInfo=["path"=>$routePath,"methods"=>null];
				}
				$scaffold->_newAction($controller, $action,$parameters,'',$routeInfo,$createView);
			}
			else{
				echo ConsoleFormatter::showMessage("The controller class <b>{$controller}</b> does not exists!",'error','new-action');
			}
		}else{
			echo ConsoleFormatter::showMessage("You must use <b>controller.action</b> notation!",'error','new-action');
		}
	}
}

