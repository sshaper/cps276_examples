<?php
class Car{
	/* CREATE SOME PRIVATE PROPERTIES.  I SET THE DATATYPES AND VALUES LATER BUT I COULD DO IT HERE AS WELL */
    private $wheels;
    private $engine;
    private $seat;
    private $radio;

    
    public function __construct(){
    	
         /* ASSIGNS VALUES TO THE PROPERTIES. CONSTRUCTOR FUNCTIONS ARE USED TO SET THINGS UP.*/
        $this->wheels = "Aluminum";
        $this->engine = "8 cylinder";
        $this->seat = "4 Cloth Black";
        $this->radio = "AM/FM";
    }
     
    public function setWheels($wheels){
    	$this->wheels=$wheels;
    }  
    
    public function setEngine($engine){
    	$this->engine=$engine;
    }  
    
    public function setSeat($seat){
    	$this->seat=$seat;
    }  
    
    public function setRadio($radio){
    	$this->radio=$radio;
    }   
	
	public function getWheels(){
		return $this->wheels;
	}
	
	public function getEngine(){
		return $this->engine;
	}
	
	public function getSeat(){
		return $this->seat;
	}
	
	public function getRadio(){
		return $this->radio;
	}
}
