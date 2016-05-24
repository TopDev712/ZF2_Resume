<?php
namespace Application\Entity;

abstract class BaseEntity {
	
	protected abstract function getProperties();

	public function toArray($ignore = array()){
		$out = array();
		$props = $this->getProperties();
		foreach($props as $field=>$value ){
			if(!in_array($field, $ignore) && !strstr($field, "_")){
				if(!$value instanceof BaseEntity){
					if($value instanceof \DateTime){
						$out[$field] = $value->format("m/d/Y H:i");
					}else{
						$out[$field] = $value;
					}
				}
			}
		}
		return $out;
	}
}

