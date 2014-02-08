<?php
defined('PROTECTED') or die('No direct script access.');
/**
 * Главный контроллер
 * 
 */
class MainController implements IController{
    
    private static $_instance = null;
    private $_controller;
    private $_action;
    private $_param;


    private function __construct() {
       $query = substr($_SERVER["REQUEST_URI"],1);
       $arrQuery = explode('/', $query);
       $this->_controller = ucfirst(array_shift($arrQuery)).'Controller';
       $this->_action = array_shift($arrQuery).'Action';
	   if($this->_action =='Action')
			$this->_action = 'indexAction';
       $this->_param = $arrQuery;
       
      
    }
    
    private function __clone() {
        
    }
    
    function __destruct() {
        
    }
    
    public static function getInstance(){
        if(!self::$_instance){
            return self::$_instance = new MainController();
        }else{
            return self::$_instance;
        }
    }
    public function route(){
        /**
         * Инициализация маршрута
         */
		if(class_exists($this->getController())){
			$rc = new ReflectionClass($this->getController());
			if($rc->implementsInterface('IController')){
				if($rc->hasMethod($this->getAction())){
					$controller = $rc->newInstance();
                                        
                                        if($rc->hasMethod('before')){       //метод исполняющися первым всегда;
                                            $method = $rc->getMethod('before');
                                            $method->invoke($controller);
                                        }
					$method = $rc->getMethod($this->getAction());
					$method->invoke($controller);
                                        
                                        if($rc->hasMethod('after')){       //метод исполняющися последним всегда;
                                            $method = $rc->getMethod('after');
                                            $method->invoke($controller);
                                        }
				}else{
					throw new Exception('action');
				}
			}else{
				throw new Exception('Interface');
			}
		}else{
			throw new Exception('Controller');
		}
	}
    public function getController(){
        return $this->_controller;
    }
    
    public function getAction(){
        return$this->_action;
    }
    
   
    /**
     * Если не передать аргументы возвращает индексированный массив со всеми переданными get параметрами
     * @param string $name названия ключей в возвращймом массиве, задаются последовательно
     * @return type array
     */
    public function getParam(){
        
        if(empty(func_get_args())){
            return $this->_param;
        }
        $args = func_get_args();
       
        
        $countParams = count($this->_param);
        $countArgs = func_num_args();
        //Проверка на соответствие кол-во переданных параметров и принимаймых
        if($countArgs != $countParams){
            if ($countArgs>$countParams)
                $args = array_intersect_key($args ,$this->_param);
            else
                $this->_param = array_intersect_key($this->_param,$args);
        }
        $arrParams = array_combine ($args, $this->_param );// Делаем ассоциативный массив, в качесве ключей переданный аргументы
                                                           //Если количество ожидаймых параметров больше, чем полученных, 
                                                                                      //Получаем недостающие параметры, присваиваю им значение пустой строки, и добавляю в результат
        $flip = array_flip(func_get_args());
        $emptyArgs = array_map(function($value){
                    $value = "";
                    }, $flip);
         $resultEmpty = array_diff_key ($emptyArgs,array_flip($args));           
            
        return $arrParams + $resultEmpty;
        
        //Sreturn $this->_param;
    }
    
	
	
}

