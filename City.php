<?php

/**
 * City object containing a weight and a location name
 *
 * @author 1435707
 */
class City implements JsonSerializable{
    private $weight;
    private $cityname;
    
    public function __construct($weight = 0, $cityname = '') {
        $this->weight = $weight;
        $this->cityname = $cityname;
    }
    
    function getWeight(){
        return $this->weight;
    }
    
    function setWeight($weight){
        $this->weight = $weight;
    }
    
    function getCityname(){
        return $this->cityname;
    }
    
    function setCityname($cityname){
        $this->cityname = $cityname;
    }
    
    function jsonSerialize() {
        return 
        [
            'weight' => $this->weight,
            'cityname' => $this->cityname
        ];
    }
}
