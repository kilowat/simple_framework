<?php

class Model implements IModel{
	
	public static function Factory($name){
		$name = ucfirst($name).'Model';
		if (class_exists($name)){
			$rm = new ReflectionClass($name);
			if ($rm->implementsInterface('IModel')){
				$model = $rm->newInstance();
				return $model;
			}else{
				throw new Exception('Inteface');
			}
		}else{
			throw new Exception('warning model not find');
		}
	}
	
}
