<?php
/*
 * Простой шаблонизатор 
 */
class View implements Iview{
    public $content = "";
    protected $_name;
   
    
    public function __toString(){
        return (string)$this->content;
    }
    public function __construct($name){
        $this->_name = "app/view/".$name.'.php';
        try{
            if(file_exists($this->_name)){
                $this->content = file_get_contents($this->_name);                      
            }else{
                throw new Exception("Файла ".$this->_name." не существует");              
            }
       }catch(Exception $e){
           echo $e->getMessage();
           
           }
       }
   
    public static function Factory($name){
        if(empty($name))
            return;
       
        return new View($name);
    
    }
    public function render(){
        
           echo $this->content;
        
        
    }
    public function set($data = array()){
        
        ob_start();
        extract($data,EXTR_OVERWRITE);
        if(file_exists($this->_name))
            include $this->_name;
        
        $this->content = ob_get_clean();
        //return $result;
    }   
}

