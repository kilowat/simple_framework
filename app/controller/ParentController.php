<?php
defined('PROTECTED') or die('No direct script access.');
/*
 * @property View $temppate
 */
class ParentController implements IController{
	
	public $mainController;
        public $template = 'templates/default/base';
        
	function __construct(){
		$this->mainController= MainController::getInstance();		
  
	}
        
         public function before(){
           
             $this->template = View::Factory($this->template);  
             
        }
        
        public function after(){
            $this->template->render();
            
        }
 	
}