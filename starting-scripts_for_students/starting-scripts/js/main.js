"use strict";

let name = {}

name.init = function(){
	Util.addLis(Util.getEl('#addName')[0], 'click', name.addName);
	Util.addLis(Util.getEl('#getNames')[0], 'click', name.displayNames);
}

name.addName = function(){
	let data = {}
	if(Util.getEl('#flname')[0].value === ""){
		Util.getEl('#errorMsg')[0].innerHTML = "You must enter a name";
		return;
	}

	data.name = Util.getEl('#flname')[0].value;

	data = JSON.stringify(data);

	Util.sendRequest('php/addDisplayName.php', function(res){
		let json;

		//json = JSON.parse(res.responseText);

		console.log(res.responseText);
		
		/*
		if(json.masterstatus == 'error'){
			Util.getEl('#errorMsg')[0].innerHTML = json.msg;
		}
		else {
			Util.getEl('#displayNames')[0].value = json.names;
		}*/
		
	}, data);
}

name.displayNames = function(){

	Util.sendRequest('php/displayNames.php', function(res){
		let json;
		json = JSON.parse(res.responseText);
		

		console.log(json);
		if(json.masterstatus == 'error'){
			Util.getEl('#errorMsg')[0].innerHTML = json.msg;
		}
		else {
			Util.getEl('#displayNames')[0].value = json.names;
		}
	});
}

name.init();