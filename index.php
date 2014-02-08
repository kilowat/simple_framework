<?php
/* 
 * point of entry
 * autoload file
 */
define('PROTECTED', true);




set_include_path(get_include_path()
					.PATH_SEPARATOR.'lib'
					.PATH_SEPARATOR.'app/controller'
                                        .PATH_SEPARATOR.'app/controller/manager'
                                        .PATH_SEPARATOR.'app/controller/index'
					.PATH_SEPARATOR.'app/model'
					.PATH_SEPARATOR.'app/view'
					);
                                    
function __autoload($name){
    include $name.'.php';
}

$mc = MainController::getInstance();
$mc ->route();




