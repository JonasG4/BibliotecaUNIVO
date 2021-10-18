//Login form validations
var inputs = document.querySelectorAll(".form-control");
var a = document.getElementById("name");
var inputAsoc = [];


//Asociar name al input
for(var i = 0; i < inputs.length; i++){
    inputAsoc[inputs[i].name] = inputs[i]
}

inputAsoc["name"].onkeydown = (e) => {
  let size =  e.target.value.length; 
  if(size < 3){
    e.target.classList.remove("form-success");
    e.target.classList.add("form-error");
}else{
    e.target.classList.remove("form-error");
    e.target.classList.add("form-success");
  }
}