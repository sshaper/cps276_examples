<?php

class Validation{
	/* USED AS A FLAG CHANGES TO TRUE IF ONE OR MORE ERRORS IS FOUND */
	private $error = false;
	public function Validate($obj){
		$i = 0;
		$test = '';
		
		/* LOOP THROUGH THE OBJECT AND CHECK THE REGEX IT SHOULD BE USING.  SEND THE OBJECT TO THE APPROPRIATE REGEX FUNCTION.*/
		while($i < count($obj)){
			switch($obj[$i]['regex']){
				case 'name': $obj[$i] = $this->name($obj[$i]); break;
				case 'address': $obj[$i] = $this->address($obj[$i]); break;
				case 'phone': $obj[$i] = $this->phone($obj[$i]); break;
				case 'email': $obj[$i] = $this->email($obj[$i]); break;
			}
			$i += 1;
		}

		/* IF THERE ARE ANY ERRORS FOUND THEN THE ERROR PROPERTY IS CHANGED TO TRUE AND THE MODIFIED OBJECT THAT WAS SENT IS RETURNED.*/
		if($this->error){
			return $obj;
		}
		/* IF EVERYTHING IS GOOD THEN A MESSAGE OF SUCCESS IS RETURNED */
		else {
			return 'success';
		}
	}

	/* THE REST OF THE FUNCTIONS ARE THE INDIVIDUAL REGEEX FUNCTIONS*/
	private function name($obj){
		$match = preg_match('/^[a-z-\']{1,50}$/i', $obj['value']);
		return $this->setMatch($match, $obj);
	}

	private function address($obj){
		$match = preg_match('/^\d+([A-Z\s-.])+$/i', $obj['value']);
		return $this->setMatch($match, $obj);
	}

	private function phone($obj){
		$match = preg_match('/[0-9]{9}/', $obj['value']);
		return $this->setMatch($match, $obj);
	}

	private function email($obj){
		$match = preg_match('/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i', $obj['value']);
		return $this->setMatch($match, $obj);
	}

	/* THE SET MATCH FUNCTION ADDS THE KEY VALUE PAR OF THE STATUS TO THE ASSOCIATIVE ARRAY */
	private function setMatch($match, $obj){
		if($match){
			$obj += ['status' => "success"];
		}
		else if(!$match){
			/* IF NO MATCH THEN ERROR EQUALS TRUE */
			$this->error = true;
			$obj += ['status' => "error"];
		}
		return $obj;
	}
	
}