  //Se obtienen los inputs como array
  var inputs = document.querySelectorAll(".form-control");
  //Se obtiene la lista de labels
  var labels = document.querySelectorAll(".floating-label");
    
  for (var i = 0; i < inputs.length; i++) {
      const label = labels[i];
      let initialValue =  inputs[i].value.length;

    if(initialValue > 0){
        label.classList.add("active");
        inputs[i].classList.add("active");
    }

      inputs[i].onblur = (evt) => {
          let hasValue = evt.target.value.length; 
          if (hasValue > 0 && !label.classList.contains("active")) {
              label.classList.add("active");
              evt.target.classList.add("active");
          } else {
              if (hasValue == 0 && label.classList.contains("active")) {
                  label.classList.remove("active");
                  evt.target.classList.remove("active");
              }
          }
      }
  }

  //Togle contraseña button
  var pw = document.getElementById("password");
  var pwIcon = document.getElementById("pw-icon");
  pwIcon.onclick = () =>{
      if(pwIcon.classList.contains("fa-eye")){
        pwIcon.classList.remove("fa-eye");
        pwIcon.classList.add("fa-eye-slash");
        pw.type = "password";
      }else{
        pwIcon.classList.remove("fa-eye-slash");
        pwIcon.classList.add("fa-eye");
        pw.type = "text";
      }
  }