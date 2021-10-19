//Log in and sign in form validations
let form = document.getElementById("form-floating");
let inputz = document.querySelectorAll("#form__floating input");  



//Expresiones regulares para la validacion de datos
const expression = {
  name: /^[a-zA-ZÀ-ÿ\s]{1,100}$/,
  lastname: /^[a-zA-ZÀ-ÿ\s]{1,100}$/,
  username: /^[a-zA-Z0-9\_\-]{4,16}$/,
  email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  password: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/,
}


const validationForm = (e) => {
    switch(e.target.name){
      case "name":
        if(expression.name.test(e.target.value)){
          document.getElementById("name__group").classList.remove("form__error");
          document.getElementById("name__group").classList.add("active");
          document.getElementById('name__msg').innerText = ''
        }else{
          document.getElementById("name__group").classList.remove("active");
          document.getElementById("name__group").classList.add("form__error");
          if(e.target.value.length == 0){
            document.getElementById('name__msg').innerText = 'El nombre no puede quedar vacio.'   
          }else if(!/^[a-zA-ZÀ-ÿ]$/.test(e.target.value)){
            document.getElementById('name__msg').innerText = 'El nombre no puede contener números o carácteres especiales.'   
          }
        }
      break;
      case "lastname":
        if(expression.lastname.test(e.target.value)){
          document.getElementById("lastname__group").classList.remove("form__error");
          document.getElementById("lastname__group").classList.add("active");
          document.getElementById('lastname__msg').innerText = ''
        }else{
          document.getElementById("lastname__group").classList.remove("active");
          document.getElementById("lastname__group").classList.add("form__error");
          
          //Crear mensaje de error          
          if(e.target.value.length == 0){
            document.getElementById('lastname__msg').innerText = 'El apellido no puede quedar vacio.'   
          }else if(!/^[a-zA-ZÀ-ÿ]$/.test(e.target.value)){
            document.getElementById('lastname__msg').innerText = 'El apellido no puede contener números o carácteres especiales.'   
          }
        }
      break;
      case "username":
        if(expression.username.test(e.target.value)){
          document.getElementById("username__group").classList.remove("form__error");
          document.getElementById("username__group").classList.add("active");
          document.getElementById('username__msg').innerText = ''  

        }else{
          document.getElementById("username__group").classList.remove("active");
          document.getElementById("username__group").classList.add("form__error");
          if(e.target.value.length == 0){
            document.getElementById('username__msg').innerText = 'El nombre de usuario no puede quedar vacio.'   
          }else if(!/^\s]$/.test(e.target.value)){
            document.getElementById('username__msg').innerText = 'El nombre de usuario no puede contener espacios.'   
          }
        }
      break;
      case "email":
        if(expression.email.test(e.target.value)){
          document.getElementById("email__group").classList.remove("form__error");
          document.getElementById("email__group").classList.add("active");
          document.getElementById('email__msg').innerText = ''  
        }else{
          document.getElementById("email__group").classList.remove("active");
          document.getElementById("email__group").classList.add("form__error");
          if(e.target.value.length == 0){
            document.getElementById('email__msg').innerText = 'El nombre de usuario no puede quedar vacio.'   
          }else if(!/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/.test(e.target.value)){
            document.getElementById('email__msg').innerText = 'Debe ser un formato de correo electrónico válido'   
          }
        }
      break;
      case "password":
        if(expression.password.test(e.target.value)){
          document.getElementById("password__group").classList.remove("form__error");
          document.getElementById("password__group").classList.add("active");
          document.getElementById('password__msg').innerText = ''  
        }else{
          document.getElementById("password__group").classList.remove("active");
          document.getElementById("password__group").classList.add("form__error");
          if(e.target.value.length < 9){
            document.getElementById('password__msg').innerText = 'La contraseña debe tener al menos 8 carácteres'   
          }else if(e.target.value.search(/[a-zA-Z]/) == -1){
            document.getElementById('password__msg').innerText = 'La contraseña debe contener al menos una letra.'   
          }else if(e.target.value.search(/[\d]/)){
            document.getElementById('password__msg').innerText = 'La contraseña debe contener al menos un numero.'   
          }
        }
        break; 
        case "confirmPassword":
          if(e.target.value == document.getElementById("password").value){
            document.getElementById("confirmPassword__group").classList.remove("form__error");
            document.getElementById("confirmPassword__group").classList.add("active");
          }else{
            document.getElementById("confirmPassword__group").classList.remove("active");
            document.getElementById("confirmPassword__group").classList.add("form__error");
            if(e.target.value != document.getElementById("password").value){
              document.getElementById('confirmPassword__msg').innerText = 'Las contraseñas no coinciden'   
            }        
          }
      break;
      case "usernameOrEmail":
        if(e.target.value.length > 0){
          document.getElementById("user__group").classList.remove("form__error");
          document.getElementById("user__msg").innerText = "";
        }
      break;
      case "passwordUser":
        if(e.target.value.length > 0){
          document.getElementById("passwordUser__group").classList.remove("form__error");
          document.getElementById("passwordUser__msg").innerText = "";
        } 
      break;
        
    }
}  

inputz.forEach((input) => {
  input.addEventListener('keyup', validationForm);
  input.addEventListener('blur', validationForm);
})
