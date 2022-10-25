<?php

/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY FORM.  THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/
require_once('classes/StickyForm.php');
$stickyForm = new StickyForm();

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF IT IS CALLED FROM THE INDEX.PHP PAGE */
function init(){
  global $elementsArr, $stickyForm;

  /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */
  if(isset($_POST['submit'])){

    /*THIS METHODS TAKE THE POST ARRAY AND THE ELEMENTS ARRAY (SEE BELOW) AND PASSES THEM TO THE VALIDATION FORM METHOD OF THE STICKY FORM CLASS.  IT UPDATES THE ELEMENTS ARRAY AND RETURNS IT, THIS IS STORED IN THE $postArr VARIABLE */
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);

    /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND THE STATUS IS CHANGED TO "ERRORS" FROM THE DEFAULT OF "NOERRORS".  DEPENDING ON WHAT IS RETURNED DEPENDS ON WHAT HAPPENS NEXT.  IN THIS CASE THE RETURN MESSAGE HAS "NO ERRORS" SO WE HAVE NO PROBLEMS WITH OUR VALIDATION AND WE CAN SUBMIT THE FORM */
    if($postArr['masterStatus']['status'] == "noerrors"){
      
      /*addData() IS THE METHOD TO CALL TO ADD THE FORM INFORMATION TO THE DATABASE (NOT WRITTEN IN THIS EXAMPLE) THEN WE CALL THE GETFORM METHOD WHICH RETURNS AND ACKNOWLEDGEMENT AND THE ORGINAL ARRAY (NOT MODIFIED). THE ACKNOWLEDGEMENT IS THE FIRST PARAMETER THE ELEMENTS ARRAY IS THE ELEMENTS ARRAY WE CREATE (AGAIN SEE BELOW) */
      return addData($_POST);

    }
    else{
      /* IF THERE WAS A PROBLEM WITH THE FORM VALIDATION THEN THE MODIFIED ARRAY ($postArr) WILL BE SENT AS THE SECOND PARAMETER.  THIS MODIFIED ARRAY IS THE SAME AS THE ELEMENTS ARRAY BUT ERROR MESSAGES AND VALUES HAVE BEEN ADDED TO DISPLAY ERRORS AND MAKE IT STICKY */
      return getForm("",$postArr);
    }
    
  }

  /* THIS CREATES THE FORM BASED ON THE ORIGINAL ARRAY THIS IS CALLED WHEN THE PAGE FIRST LOADS BEFORE A FORM HAS BEEN SUBMITTED */
  else {
      return getForm("", $elementsArr);
    } 
}

/* THIS IS THE DATA OF THE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE THAT HAS THE VALUE OF "NAME". NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/
$elementsArr = [
  "masterStatus"=>[
    "status"=>"noerrors",
    "type"=>"masterStatus"
  ],
	"name"=>[
	  "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Name cannot be blank and must be a standard name</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"Scott",
		"regex"=>"name"
	],
	"phone"=>[
		"errorMessage"=>"<span style='color: red; margin-left: 15px;'>Phone cannot be blank and must be a valid phone number</span>",
    "errorOutput"=>"",
    "type"=>"text",
		"value"=>"999.999.9999",
		"regex"=>"phone"
  ],
   
  "state"=>[
    "type"=>"select",
    "options"=>["mi"=>"Michigan","oh"=>"Ohio","pa"=>"Pennslyvania","tx"=>"Texas"],
		"selected"=>"oh",
		"regex"=>"name"
	],
  "financial"=>[
    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>You must select at least one financial option</span>",
    "errorOutput"=>"",
    "type"=>"checkbox",
    "action"=>"required",
    "status"=>["cash"=>"", "check"=>"", "credit"=>""]
  ],
  "eyeColor"=>[
    "action"=>"notRequired",
    "type"=>"radio",
    "value"=>["blue"=>"", "brown"=>"", "hazel"=>"", "green"=>"", "other"=>""]
  ]
];


/*THIS FUNCTION CAN BE CALLED TO ADD DATA TO THE DATABASE */
function addData($post){
  global $elementsArr;  
  /* IF EVERYTHING WORKS ADD THE DATA HERE TO THE DATABASE HERE USING THE $_POST SUPER GLOBAL ARRAY */
      //print_r($_POST);
      require_once('classes/Pdo_methods.php');

      $pdo = new PdoMethods();

      $sql = "INSERT INTO contactMod (name, phone, state, financial, eye) VALUES (:name, :phone, :state, :financial, :eye)";

      /* THIS TAKE THE ARRAY OF CHECK BOXES AND PUT THE VALUES INTO A STRING SEPERATED BY COMMAS  */
      if(isset($_POST['financial'])){
        $financial = "";
        foreach($post['financial'] as $v){
          $financial .= $v.",";
        }
        /* REMOVE THE LAST COMMA FROM THE CONTACTS */
        $financial = substr($financial, 0, -1);
      }

      if(isset($_POST['eyeColor'])){
        $eyeColor = $_POST['eyeColor'];
      }
      else {
        $eyeColor = "";
      }


      $bindings = [
        [':name',$post['name'],'str'],
        [':phone',$post['phone'],'str'],
        [':state',$post['state'],'str'],
        [':financial',$financial,'str'],
        [':eye',$eyeColor,'str']
      ];

      $result = $pdo->otherBinded($sql, $bindings);

      if($result == "error"){
        return getForm("<p>There was a problem processing your form</p>", $elementsArr);
      }
      else {
        return getForm("<p>Contact Information Added</p>", $elementsArr);
      }
      
}
   

/*THIS IS THEGET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr){

global $stickyForm;
$options = $stickyForm->createOptions($elementsArr['state']);

/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
    <form method="post" action="index.php?page=addContact">
    <div class="form-group">
      <label for="name">Name (letters only){$elementsArr['name']['errorOutput']}</label>
      <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}" >
    </div>
    <div class="form-group">
      <label for="phone">Phone (format 999.999.9999) {$elementsArr['phone']['errorOutput']}</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{$elementsArr['phone']['value']}" >
    </div>

            
    <div class="form-group">
      <label for="state">State</label>
      <select class="form-control" id="state" name="state">
        $options
      </select>
    </div>

    <p>Please check all financial options (you must check at least one):{$elementsArr['financial']['errorOutput']}</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="financial[]" id="financial1" value="cash" {$elementsArr['financial']['status']['cash']}>
      <label class="form-check-label" for="financial1">Cash</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="financial[]" id="financial2" value="check" {$elementsArr['financial']['status']['check']}>
      <label class="form-check-label" for="financial2">Check</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="financial[]" id="financia3" value="credit" {$elementsArr['financial']['status']['credit']}>
      <label class="form-check-label" for="financial3">Credit</label>
    </div>
        

    <p>Please select an eye color (optional):</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="eyeColor" id="eyeColor1" value="blue"  {$elementsArr['eyeColor']['value']['blue']}>
      <label class="form-check-label" for="eyeColor1">Blue</label>
    </div>

    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="eyeColor" id="eyeColor2" value="brown"  {$elementsArr['eyeColor']['value']['brown']}>
      <label class="form-check-label" for="eyeColor2">Brown</label>
    </div>

    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="eyeColor" id="eyeColor3" value="hazel"  {$elementsArr['eyeColor']['value']['hazel']}>
      <label class="form-check-label" for="eyeColor3">Hazel</label>
    </div>

    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="eyeColor" id="eyeColor4" value="green"  {$elementsArr['eyeColor']['value']['green']}>
      <label class="form-check-label" for="eyeColor4">Green</label>
    </div>

    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="eyeColor" id="eyeColor5" value="other"  {$elementsArr['eyeColor']['value']['other']}>
      <label class="form-check-label" for="eyeColor5">Other</label>
    </div>

    <div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>

HTML;

/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
return [$acknowledgement, $form];

}

?>