"use strict"

var main = {}

main.util = function(){
	if (document.getElementById('submitBtn')){
		document.getElementById('submitBtn').addEventListener('click', main.processForm, false);
	}
}

main.processForm = function(){
	/* INPUTS VARIBLE IS A NODE LIST OF ALL THE INPUT BOXES THAT HAVE THE TYPE ATTRIBUTE OF TEXT*/
	var i = 0, j = 0, inputs = document.querySelectorAll('input[type="text"]'), obj;
	
	/* CLEAR ALL THE LABEL ERROR MESSAGES */
	main.clearLabels();

	/*THIS OBJECT IS AN ARRAY OF OBECTS THAT STORES THE "FOR" ATTRIBUTE VALUE, THE REGEX NAME, AND ERROR MESSAGE THIS IS USED SO THAT WE CAN LATER MATCH THE ERROR MESSAGE TO THE APPROPRIATE LABEL ELEMENT. */
	obj = [
		{for: 'fname', regex: 'name', msg: "Not in name format"},
		{for: 'lname', regex: 'name', msg: "Not in name format"},
		{for: 'address', regex: 'address', msg: "Not in address format (just number and street)"},
		{for: 'phone', regex: 'phone', msg: "Not in phone format (just write the numbers)"},
		{for: 'email', regex: 'email', msg: "Not in email format"}
	]
	
	/* LOOP THROUGH ALL THE TEXT ELEMENTS AND GET THEIR VALUES AND ADD TO THE OBJECT */
	
	while(i < inputs.length){
		j = 0;
		while(j < obj.length){
			if(inputs[i].id == obj[j].for){
				obj[j].value = inputs[i].value;
				break;
			}
			j++;
		}
		i++;
	}
	var data = JSON.stringify(obj);
	var xhttp = new XMLHttpRequest();

	/* SEND THE OBJECT TO THE BACKEND PHP FILE */
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			
			/* THE PHP FILE WILL EITHER RETURN A MESSAGE OF 'SUCCESS' OR AN OBJECT */
			if(this.responseText == 'success'){
				alert('all is well')
			}
			/* IF AN OBJECT IS RETURNED THEN THE DISPLAY ERRORS FUNCTION WILL DISPLAY THE ERRORS. */
			else{
				main.displayError(JSON.parse(this.responseText));
			}
			
		}
	};
	xhttp.open("POST", "xhr/val.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("data=" + data);
}

/* ALL THIS FUNCTION DOES IS LOOP THROUGH THE OBJECT AND DISPLAY THE APPROPRIATE ERROR MESSAGE TO THE APPROPRIATE LABEL*/
main.displayError = function (obj){
	var i = 0, label;
	while(i < obj.length){
		if(obj[i].status == 'error'){
			label = document.querySelectorAll('label[for="' + obj[i].for + '"]')[0];
			label.innerHTML += '<span class="error">' + obj[i].msg + '</span>';
		}
		i++;
	}
}

/* THIS METHOD CLEARS ALL THE SPAN ELEMENTS FROM THE LABEL ELEMENTS */
main.clearLabels = function(){
	var labels, i = 0;

	labels = document.querySelectorAll('label');
	while(i < labels.length){
		if(labels[i].lastChild.nodeName.toLowerCase() == 'span'){
			labels[i].removeChild(labels[i].lastChild);
		}
		i++;
	}

}

main.util();

