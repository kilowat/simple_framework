<?php
defined('PROTECTED') or die('No direct script access.');
    /** 
     *Класс для работы с БД
     * 
     * Методы:
     * 
     * @static select() запрос select к бд
     * 
     * 
     */
    class DataBase implements IDataBase {

        protected static $_db;
        protected $_bdName = "light";
        protected $_bdType = "mysql";
        protected $_host = "127.0.0.1";
        protected $_user = "root";
        protected $_pass = "";

        function __construct() {
            try{
              self::$_db = new PDO("$this->_bdType:host=$this->_host;dbname=$this->_bdName", $this->_user, $this->_pass);
            }  catch (PDOException $e){
                echo $e->getMessage();
            }
        }

        function __destruct() {
            unset($this->_db);
        }

            /**@param string $query - текст запроса к бд
             * 
             * Пример "select * from test where id=?"
             * 
             * @param string $param - параметры подстановки в запрос 
             */
        static public function Connect(){
            return new self;
            
            
             
         }
         
             
         
        
    }

