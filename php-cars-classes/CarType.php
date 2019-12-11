<?php
/*NEED TO INCLUDE THE CAR.PHP FILE TO USE THE CLASS.*/
include_once('Car.php');

class CarType extends Car{
	
    /* CREATES SOME PROPERTIES TO PRIVATE */
    private $type;
    private $extras;
    private $color;
        
    public function __construct($type = "car"){
    	parent::__construct();/* NEEDS TO BE CALLED SO WE CAN INHERIT THE CONSTRUCTOR, OTHERWISE IT WILL OVERWRITE IT. */
    	
        /* ADDS VALUES OR DATATYPES TO THE PROPERTIES */
        $this->extras = [];
        $this->color = "default";
        $this->type = $type;
    }
    
    
    /* I CREATED GETTER AND SETTER FUNCTIONS SO I COULD ADD VALUES AND GET VALUES OF PROPERTIES */    
    public function setColor($color){
        $this->color = $color;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function setExtras($extras){
    	array_push($this->extras, $extras);
    }  
    
    public function getExtras(){
    	return $this->extras;
    }

    public function getType(){
        return $this->type;
    }   
 
	public function carDetails(){
		
        /* I HAVE TO CALL THE GET FUNCTIONS OF THE PARENT BECAUSE I CANNOT ACCESS THE PRIVATE PROPERTIES DIRECTLY */
        $details = "Vehicle Type - " . $this->getType() . "<br>";
        $details .= "Wheels - " . $this->getWheels() . "<br>";
        $details .= "Engine - " . $this->getEngine() . "<br>";
        $details .= "Seat - " . $this->getSeat() . "<br>";
        $details .= "radio - " . $this->getRadio() . "<br>";

        foreach ($this->extras as $extra){
            $details .= "extra - " . $extra . "<br>";
        }

		return $details;
	}
}
