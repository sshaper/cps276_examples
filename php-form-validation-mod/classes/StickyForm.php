<?php
require_once('Validation.php');
/* THIS CLASS WILL RETURN ALL INPUT, CHECKBOX, AND RADIO BUTTON VALUES ALONG WITH ERROR MESSAGES ON THE INPUT BOXES.  THIS CLASS WOULD NEED TO BE EXTENDED (ADDED TO) TO UTILIZE ALL FORM ELEMENTS.*/

class StickyForm extends Validation {
	/* THIS FUNCTION VALIDATES THE INPUT SENT FROM THE FORM.  IT TAKES THE POST ARRAY AS THE FIRST PARAMETER AND THE ELEMENTS ARRAY AS THE SECOND  BASICALLY IT CHECKS ALL TEXT FIELDS FOR CORRECT INPUT AND ALSO CHECKS SELECT OPTIONS, CHECKBOXES AND RADIO BUTTONS FOR THE VALUES THAT WERE SELECTED.  IN ADDITION IT MAKES THE FORM STICKY */
	public function validateForm($GlobalPost, $elementsArr){
		foreach($elementsArr as $k=>$v){
			
			/*IF THE TYPE IS TEXT THEN IT IS A TEXTBOX OR TEXTAREA FIELD THE TYPE IS DETERMINED BY WHAT IS SET UP IN THE ELEMENTS ARRAY */
			if($elementsArr[$k]['type'] === "text"){
				$error = $this->checkFormat($GlobalPost[$k], $elementsArr[$k]['regex']);
				if($error == 'error'){
					$elementsArr[$k]['errorOutput'] = $elementsArr[$k]['errorMessage'];
					$elementsArr['masterStatus']['status'] = "error";
				}
				/*HERE I PUT THE VALUES INTO THE ARRAY TO MAKE IS STICKY.*/
				$elementsArr[$k]['value'] = htmlentities($GlobalPost[$k]);
			}

			/*IF THE TYPE IS SELECT THEN IT CHECKS TO MAKE SURE WHAT WAS SELECTED IS STICY.  IT DOES NOT CHECK ANY VALIDATION ISSUES AS A SELECT BOX TECHNICALLY WILL BE CORRECT. HOWEVER IT COULD BE SET UP TO CHECK FOR CORRECT INPUT */ 
			else if($elementsArr[$k]['type'] === "select"){
				$elementsArr[$k]['selected'] = $GlobalPost[$k];
			}

			/*THIS CHECKS FOR ANY CHECKBOXES THAT ARE CHECKED AND IT ALSO HAS AN OPTIONAL SETTING (REQUIRED OR NOTREQUIRED).  THE CHECKBOXES CAN BE CHECKED OR NOT CHECKED BY DEFAULT.  IF THE BOXES ARE TO BE CHECKED BY DEFAULT AND THEY ARE NOT, THEN AN ERROR MESSAGE WILL APPEAR.  NOTE THIS ONLY CHECKS IF ALL THE CHECKBOXES ARE LEFT UNCHECKED AND AT LEAST ONE NEEDS TO BE CHECKED. THIS WILL MAKE THE CHECKBOXES STICKY AS WELL*/
			else if($elementsArr[$k]['type'] === 'checkbox'){
				if($elementsArr[$k]['action'] == "required" && !isset($GlobalPost[$k])){
					$elementsArr[$k]['errorOutput'] =  $elementsArr[$k]['errorMessage'];
					$elementsArr['masterStatus']['status'] = "error";
				}
				else {
					if(isset($GlobalPost[$k])){
						foreach($elementsArr[$k]['status'] as $ek=>$ev){
							foreach($GlobalPost[$k] as $gv){
								if($ek === $gv){
									$elementsArr[$k]['status'][$ek] = "checked";
									break;
								}
							}
						}
					}
				}
			}

			/*THIS CHECKS FOR ANY RADIO BUTTONS THAT ARE SELECTED. IT ALSO WILL CHECK IF A RADION GROUP IS REQUIRED TO BE SELECTED BY CHECKING THE ACTION (REQUIRED OR NOT REQUIRED).  IT ALSO MAKE THE FORM STICKY */
			else if($elementsArr[$k]['type'] === 'radio'){
				if($elementsArr[$k]['action'] == "required" && !isset($GlobalPost[$k])){
					$elementsArr[$k]['errorOutput'] =  $elementsArr[$k]['errorMessage'];
					$elementsArr['masterStatus']['status'] = "error";
				}
				else{
					if(isset($GlobalPost[$k])){
						foreach($elementsArr[$k]['value'] as $ek=>$ev){
								if($GlobalPost[$k] === $ek){
								$elementsArr[$k]['value'][$ek] = "checked";
								break;
							}
						}	
					}
				}
			}
		}
		return $elementsArr;
	}

	/* THIS FUNCTION CREATES THE OPTIONS FOR THE SELECT BOXES SO THEY DON'T HAVE TO BE MANUALLY CREATED. */
	public function createOptions($elementsArr){
		$options = '';
		foreach($elementsArr['options'] as $k=>$v){
			if($elementsArr['selected'] == $k){
				$options .= "<option selected value=$k>$v</option>";
			}
			else {
				$options .= "<option value=$k>$v</option>";
			}
		}
		return $options;
	}
}
?>