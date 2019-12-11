"use strict";

var crud = {}

/* THIS INIT FUNCTION IS CALLED WHEN THE JAVASCRIPT FILE LOADS.  BASICALLY THIS FUNCTION SETS UP THE EVENT LISTENERS*/
crud.init = function(){
	/* EACH IF STATEMENT CHECKS IF THE ID IS PRESENT ON THE PAGE AND IF SO ADDS AN EVENT LISTENER TO IT.  IF I DID NOT CHECK FOR AN ID FIRST I WOULD HAVE RECEIVED AND ERROR MESSAGE WHEN I TRIED TO ADD AN EVENT LISTENER TO IT. */
	if(document.getElementById('addName')){
		document.getElementById('addName').addEventListener('click', crud.addName, false);
	}
	else if(document.getElementById('updateDeleteList')){
		document.getElementById('updateDeleteList').addEventListener('click',crud.updateDeleteList, false);
	}
}

/* THIS FUNCTION ADDS AND NAME AND OTHER INFORMATION TO THE DATBASE */
crud.addName = function(){
	var inputs, i, data = {}, res, name = '';
	inputs = document.querySelectorAll('input[type="text"]');
	i = 0;
	data.flag = 'addName';
	while(i < inputs.length){
		name = inputs[i].name;
		if(name == 'state'){
			data[name] = inputs[i].value.toUpperCase();
		}
		else{
			data[name] = inputs[i].value.charAt(0).toUpperCase() + inputs[i].value.slice(1);;
		}
		
		i++;
	}
	data = JSON.stringify(data);
	crud.sendRequest(data);
}

/* THE FOLLOWING FUNCTION WILL EITHER DELETE OR UPDATE A RECORD BASED UPON WHAT BUTTON IS CLICKED */
crud.updateDeleteList = function(e){
	var id, data = {}, i, node;
	if(e.target.value == 'Delete'){
		
		/* THIS IS A CONFIRMATION BOX. IF THE USER CLICKS OKAY THEN TRUE IS RETURNED AND THE SCRIPT CONTINUES.  IF THE USER CLICKS CANCEL THEN THE CONFIRMATION BOX RETURNS FALSE AND THE SCRIPT TERMINATES WITHT THE RETURN STATEMENT */
		if(!confirm("You are about to permanently delete this name.  If this is what you want to do click 'Ok' otherwise click 'Cancel'")){
			return;
		}

		data.id = e.target.id.substr(1);
		data.flag = 'delete';
		data = JSON.stringify(data);

		/*I ADDED THE EXTRA DELETE STRING HERE BECAUSE I HAVE A COMMONE SEND REQUEST FUNCTION AND I WANTED TO DO SOMETHING DIFFERENT WITH THE DELETE */
		crud.sendRequest(data, 'delete');

	}
	else if(e.target.value == 'Update'){
		data.id = e.target.id.substr(1);
		data.flag = 'update';
		node = e.target.parentNode.previousElementSibling;
		i = 0;
		while(i < 5){
			data[node.firstElementChild.name] = node.firstElementChild.value;
			node = node.previousElementSibling;
			i++;
		}
		data = JSON.stringify(data);						
		crud.sendRequest(data);
	}
}


/* I WROTE ONE SEND REQUEST TO SEND A REQUEST FOR ALL THE AJAX RELATED OPERATIONS.  BASED UPON WHAT WAS RETURNED DETERMINED WHAT WAS DONE. */
crud.sendRequest = function(data, specificAction){
	var xhttp = new XMLHttpRequest(), response, inputs, i;
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			
			response = JSON.parse(this.responseText);
			
			/* IF THERE WAS AN ERROR THEN DISPLAY THE ERROR MESSAGE */
			if(response.masterstatus === 'error'){
				document.getElementById('result').innerHTML = response.msg;
			}

			else if(response.masterstatus === 'success' && response.specificaction === 'clearform'){
				
				/* DISPLAY ACKNOWLEDGEMENT THAT NAME WAS ADDED */
				document.getElementById('result').innerHTML = response.msg;

				/* THEN CLEAR THE FORM */
				inputs = document.querySelectorAll('input[type="text"]');
				i = 0;
				while(i < inputs.length){
					inputs[i].value = "";					
					i++;
				}
			}

			else if(response.masterstatus === 'success' && response.specificaction === 'displaymessage'){
				document.getElementById('result').innerHTML = response.msg;
			}

			else if(response.masterstatus === 'success' && response.specificaction === 'reloadpage'){
				
				/*IF THE SPECIFIC ACTION RETURNS 'RELOAD PAGE' THE PAGE IS RELOADED THE AND TABLE WILL UPDATE. THIS IS A ONE WAY OF UPDATING THE PAGE.  I COULD REQUIRED THE DATABASE AND RECALLED CREATEINPUT FUNCTION AND RESENT THE UPDATED TABLE THE  AJAX REQUEST TO RELOAD THE TABLE .*/
				window.location.reload();
	
			}
		}
	};
	xhttp.open("POST", "server/xhrRoutes.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("data=" + data);
}

crud.init();
