<?php

class Content{
    
    protected $fileName;
    protected $fileContent;
    protected $error = null;
    
            
       function __construct($fileName, $fileContent ) {
        $this->fileName = 'include/'.$fileName;
        $this->fileContent = $fileContent;
    }      
         function save(){
             
            if($f = fopen($this->fileName,"w"))
        {
            if(fwrite($f,serialize($this->fileContent)))
            {
                fclose($f);
            }
            else die($this->error = "Error write".$this->fileName);
        }
        else die($this->error = "Error open".$this->fileName); 
            
        }
      
        function open(){
            if (file_exists($this->fileName))
                return unserialize(file_get_contents($this->fileName));
            else
                return "ERROR READ".$this->fileName;
           
        } 
        static function fcontent($fileName, array $fileContent = array()){
            
            $obj = new Content($fileName, $fileContent);
            if($obj->error===null)
                return $obj;
            else 
                return $obj->error;
        }
    
} 

