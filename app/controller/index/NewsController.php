<?php
defined('PROTECTED') or die('No direct script access.');

class NewsController extends Controller{
   
    public function indexAction() {
        
        $index = View::Factory("templates/default/index");
        
        $this->template->set(array("index"=>$index));
		
        
    }
}

