<?php 

class Auth extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }
    //Metodo Login
    public function Login(){
        //Se establecen los valores de los inputs y errores
        $data = [
            'title' => 'Iniciar sesion',
            'usernameOrEmail' => '',
            'password' => '',
            'usernameOrEmailError' => '',
            'passwordError' => '',
            'LogError' => ''
        ];
        
        //Si hay un peticion POST se ejecutará la validacion del LOGIN
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'usernameOrEmail' => trim($_POST['usernameOrEmail']),
                'password' => trim($_POST['password']),
                'usernameOrEmailError' => '',
                'passwordError' => ''
            ];

            //Validar nombre de usuario o correo electronico
            if(empty($data['usernameOrEmail'])){
                $data['usernameOrEmailError'] = "Por favor, ingrese su nombre de usuario o correo eléctronico.";
            }

            //Validar contraseña
            if(empty($data['password'])){
                $data['passwordError'] = "Por favor, escriba su contraseña.";
            }

            //Si no hay errores en los campos
            if(empty($data['usernameOrEmailError']) && empty($data['passwordError'])){
                
                //Se comprueba si existe un registro con Email y Username 
                $isEmailExist = $this->userModel->findUserByEmail($data['usernameOrEmail']);
                $isUsernameExist= $this->userModel->findUserByUsername($data['usernameOrEmail']);
                
                //Si existe el usuario, entonces procedera a Iniciar Sesion
                if($isEmailExist || $isUsernameExist){
                    $loggedInUser = $this->userModel->login($data['usernameOrEmail'], $data['password']);
                    
                    //Se crea la sesion
                    if($loggedInUser){
                        $this->createUserSession($loggedInUser);
                    }else{
                        $data["logError"] = "El usuario o la contraseña son incorrectos";
                    }
                } else {
                    $data['logError'] = "Este usuario aún no esta registrado.";
                }
                
            }
        }

        //Al ingresar al dominio, retornará la vista con los datos. 
        $this->view('auth/login', $data);
    }


    //Se registro la session de los google  
    public function GLogin(){

        //Si hay un usuario logeado, redirigirá al inicio
        if(isset($_SESSION['user_id'])){
            header('location: ' .urlroot.'/');
        }

        require_once approot . '/Config/google_credentials.php';
        
        $data = [
            "username" => "",
            "email" => "",
            "password" => "",
            "logError" => ""
        ];
        
        //Si existe el codigo de 0auth2 de google entonces retornara los datos
        if(isset($_GET['code'])){
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token);
            
            $gauth = new Google_Service_Oauth2($client);
            $google_info = $gauth->userinfo->get();
            // $name = $google_info->name;
            $data['email'] = $google_info->email;
            // $picture = $google_info->picture;

            //Comprobar si el usuario existe
            $userIsRegistered = $this->userModel->findUserByEmail($data['email']);
            
            //Si el usuario existe, entonces procedera a crear la sesion
            if($userIsRegistered){
                $loggedInUser = $this->userModel->glogin($data['email']);
                $this->createUserSession($loggedInUser);
            }else{
                $data["logError"] = "El usuario aun no está registrado.";
                header("Location: " . urlroot . "/auth/login?logError=" . $data["logError"]);
            }

        }else{
                header('location: ' . urlroot . '/');
            }
    }

    //Registro de usuario con google 
    public function GRegister(){
        
        //Si el hay un usuario logeado, redirigirá al inicio
        if(isset($_SESSION['user_id'])){
            header('location: ' .urlroot.'/');
        }

        //Credenciales de google
        require_once approot . '/Config/google_credentials.php';

        $data = [
            "username" => "",
            "email" => "",
            "password" => "",
            "name" => "",
            "lastname" => " ",
        ];

        //Valida que google aprovara el permiso de datos
        if(isset($_GET['code'])){
            $token = $clienteR->fetchAccessTokenWithAuthCode($_GET['code']);
            $clienteR->setAccessToken($token);
            
            $gauth = new Google_Service_Oauth2($clienteR);
            $google_info = $gauth->userinfo->get();
            $data['name'] = $google_info->name;
            $data['email'] = $google_info->email; 
            $data['username'] = str_replace(" ", "",$google_info->name) . rand(1, 50);
            // $picture = $google_info->picture;

            //Settearle una contraseña
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $data['password'] = substr(str_shuffle($permitted_chars), 0, 10);
            
            //Hashear la contraseña
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $userIsRegistered = $this->userModel->findUserByEmail($data['email']);
            
            if($userIsRegistered){
                $loggedInUser = $this->userModel->glogin($data['email']);
                $this->createUserSession($loggedInUser);
            }else{
              $registerSuccesful = $this->userModel->register($data);
              if($registerSuccesful){
                  header('location: ' .urlroot .'/');
              }else{
                  die('Internal Error');
              }
            }
        }else{
                header('location: ' . urlroot . '/');
            }        
    }

    public function register(){
        $data = [
            'title' => 'Registro',
            'name' => '',
            'lastname' => '',
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'nameError' => '',
            'lastnameError' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => '',
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            //Capturar los datos del fomulario
            $data = [
                'name' => trim($_POST['name']),
                'lastname' => trim($_POST['lastname']),
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'nameError' => '',
                'lastnameError'=> '',
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
            ];
            
            //El nombre de usuario no puede contener espacios
            $usernameValidation = "/^[a-zA-Z0-9]*$/";
            //La contraseña no puede contener espacios
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validacion del nombre
            if (empty($data['name'])){
                $data['nameError'] = 'Por favor, ingrese su nombre';
            }

            //Validacion del apellido
            if(empty($data['lastname'])){
                $data['lastnameError'] = 'Por favor, ingrese su apellido';
            }

            //Validacion del nombre de usuario
            if (empty($data['username'])){
                $data['usernameError'] = 'Por favor, ingrese un nombre de usuario.';
            } elseif (!preg_match($usernameValidation, $data['username'])) {
                $data['usernameError'] = 'El nombre de usuarios no puede contener espacios.';
            }else{
                if($this->userModel->findUserByUsername($data['username'])){
                    $data['usernameError'] = 'Este nombre de usuario ya está en uso.';
                }
            }

            //Validacion del correo electronico
            if(empty($data['email'])){
                $data['emailError'] = 'Por favor, ingrese un correo electrónico.';
            }else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['emailError'] = 'Por favor, ingrese un formato válido de correo eléctronico.';
            }else{
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['emailError'] = 'El correo electrónico ya está en uso.';
                }
            }
            
            //Validacion de contraseña
            if(empty($data['password'])){
                $data['passwordError'] = 'Por favor, ingrese una contraseña.';
            }else if(strlen($data['password'] > 6)){
                $data['passwordError'] = 'La contraseña debe tener al menos 8 carácteres.';
            }else if(preg_match($passwordValidation, $data['password'])){
                $data['passwordError'] = 'La debe tener al menos un número.';
            }

            //Validacion de confirmar contraseña
            if(empty($data['confirmPassword'])){
                $data['confirmPasswordError'] = "Por favor, ingrese una contraseña.";
            }else{
                if($data['password'] != $data['confirmPassword']){
                    $data['confirmPasswordError'] = 'Las contraseñas no coinciden.';
                }
            }

            //Comprobar que no hayan errores
            if(empty($data['nameError']) && empty($data['lastnameError']) && empty($data['usernameError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])){

                //Encriptar contraseña
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                
                //Registrar el usuario
                if($this->userModel->register($data)){
                    header('location: ' . urlroot . '/Auth/login');
                }else{
                    die('Algo salio mal.');
                }
            }
        }

        //Se retorna la vista
        $this->view('auth/register', $data); 
    }

        //Se crea la sessión
        public function createUserSession($user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['name'] = $user->name;
            $_SESSION['lastname'] = $user->lastname;
            $_SESSION['username'] = $user->username;
            $_SESSION['email'] = $user->email;
            header('location: ' . urlroot . '/');
        }
        
        //Se cierra la session
        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['name']);
            unset($_SESSION['lastname']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            header('location: ' . urlroot . '/auth/login');
        }
}