"use strict";
if(document.getElementById('getInfo')){
  document.getElementById('getInfo').addEventListener('click', getInfo, true);
}
if(document.getElementById('saveInfo')){
  document.getElementById('saveInfo').addEventListener('click', saveInfo, true);
}


function getInfo(){
  var xhr, formdata;
  if (window.XMLHttpRequest) {
    xhr = new XMLHttpRequest();
  } else {
    /*CODE FOR OLDER BROWSERS*/
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhr.onreadystatechange = function() {
    /*IF EVERYTING IS OKAY THEN DISPLAY THE RESULT */
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("result").innerHTML = this.responseText;
    }
  };
  

  formdata = new FormData();

  formdata.append('filename',document.getElementById('filename').value);
  formdata.append('file',file.files[0]);


  

  /* THIS IS A POST REQUEST IT WILL SEND AND GET INFORMATION TO/FROM SERVER */
  xhr.open("POST", "php/upload.php", true);

  /*IMPORTANT!!!!! WHEN USING THE FORMDATA OBJECT DO NOT INCLUDE THE setRequestHeader method.  LIKE WHAT WAS DONE WITH POST */
  //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  /*I USE THE DATA VARIABLE THAT I CREATED TO STORE THE ACTUAL DATA AND THEN SEND THE DATA USING THE DATA NAME I USE WITH THE SEND REQUEST.  A SEND REQUEST MUST HAVE A NAME THAT ATTACHES TO WHAT IS BEING SENT.*/
  xhr.send(formdata);
}

function saveInfo(){
  var xhr, formdata;
  if (window.XMLHttpRequest) {
    xhr = new XMLHttpRequest();
  } else {
    /*CODE FOR OLDER BROWSERS*/
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhr.onreadystatechange = function() {
    var arr, json;
    /* IF EVERYTING IS OKAY THEN DISPLAY THE RESULT */
    if (this.readyState == 4 && this.status == 200) {
      arr = this.responseText.split("^^^");
      
      if(arr[0] == 'success'){
        json = JSON.parse(arr[1]);
        console.log(json[0]);
        document.getElementById("result").innerHTML = "Here is the <a href='" + json[0].filepath + "'>" + json[0].filename + "</a>";

      }
      else{
        document.getElementById("result").innerHTML = arr[1];
      }
     }
  };
  

  formdata = new FormData();

  formdata.append('filename',document.getElementById('filename').value);
  formdata.append('file',file.files[0]);


  /* THIS IS A POST REQUEST IT WILL SEND AND GET INFORMATION TO/FROM SERVER */
  xhr.open("POST", "php/upload_save.php", true);

  xhr.send(formdata);
}