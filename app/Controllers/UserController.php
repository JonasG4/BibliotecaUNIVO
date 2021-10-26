<?php
class UserController extends Controller{

    public function __construct()
    {
        $this->userModel = $this->model("User");
        $this->azureService = $this->model("BlobService");
    }

    public function Profile(){
        
        if(!isLoggedIn()){
            header('location: ' .urlroot . '/auth/login');
        }

        $userInfo = $this->userModel->findUserById($_SESSION['user_id']);

        $data = [
            'name' => $userInfo->name,
            'lastname' => $userInfo->lastname,
            'username' => $userInfo->username,
            'email' => $userInfo->email,
            'avatar' => $userInfo->avatar,
            'idUser'=> $_SESSION['user_id']
        ];


        $this->view('Users/profile', $data);
    }

    public function updateSession($data){
        $_SESSION['name'] = $data['name'];
        $_SESSION['lastname'] = $data['lastname'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
    }

    public function updateAvaterSession($avatar){
        $_SESSION['avatar'] = $avatar;
    }

    public function uploadUserPhoto(){
        $data = [
            'title' => 'Actualizar avatar',
            'file'=> ''
        ]; 
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        //Extraer extension
         $extension = new SplFileInfo($_FILES['userPhoto']['name']); 
         $extension = $extension->getExtension();
         
         //Cadena con valores aleatorios
         $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
         $randomName = substr(str_shuffle($permitted_chars), 0, 30); 
        
         //Renombrando archivo
         $renameFile = $_SESSION['username'] . '_' . $randomName . '.' .$extension;
         $img = $_FILES['userPhoto'];
         $img['name'] = $renameFile;
         
         $data =[
             'avatar' => $renameFile,
             'userId' => $_SESSION['user_id']
         ];
            if(!empty($img['tmp_name'])){
                $this->azureService->upload($img);
                
                $this->userModel->updateAvatar($data);
                $this->updateAvaterSession($data['avatar']);

                header('location: ' . urlroot . '/user/profile/');  
                }else{
                    echo 'No se puedo subir';
                }
            }

        $this->view('Users/changeUserPhoto', $data);
    }


    public function Edit(){
        $data = [
            "title" => 'Editar perfil',
            "userId" => '',
            "name" => '',
            "lastname" => '',
            "username" => '',
            "email" => '',
            "nameError" => '',
            "lastnameError" => '',
            "usernameError" => '',
            "emailError" => ''
        ];
        
        if (!isLoggedIn()){           
            header('location:' . urlroot . '/auth/login');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $data['userId'] = $_SESSION['user_id'];
            $data['name'] = $_POST['name'];
            $data['lastname'] = $_POST['lastname'];
            $data['username'] = $_POST['username'];
            $data['email'] = $_POST['email'];

            if(empty($data['name'])){
                $data['nameError'] = "Por favor, ingrese su nombre.";
            }

            if(empty($data['lastname'])){
                $data['lastnameError'] = 'Por favor, ingrese su apellido.';
            }

            if(empty($data['username'])){
                $data['usernameError'] = 'Por favor, ingrese su nombre de usuario.';
            }

            if(empty($data['email'])){
                $data['emailError'] = 'Por favor, ingrese su correo electronico';
            }


            if(empty($data['nameError']) && empty($data['lastnameError']) && empty($data['usernameError'])
            && empty($data['emailError'])){

              $isUpdated = $this->userModel->updateUser($data);

              if($isUpdated){
               $this->updateSession($data);
                  header('location: ' . urlroot . '/user/profile');
              }else{
                  die('Ha ocurrido un problama con la consulta');
              }
            }

        }else{
            $userInfo = $this->userModel->findUserById($_SESSION['user_id']); 
            
            $data['userId'] = $_SESSION['user_id'];
            $data['name'] = $userInfo->name;
            $data['lastname'] = $userInfo->lastname;
            $data['username'] = $userInfo->username;
            $data['email'] = $userInfo->email;
        }

        $this->view('Users/Edit', $data);
    }

    public function changePassword(){
        $data = [
            'title' => 'Cambiar contraseña',
            'oldPassword' => '',
            'newPassword' => '',
            'confirmPassword' => '',
            'oldPasswordErr' => '',
            'newPasswordErr' => '',
            'confirmPasswordErr' => ''
        ];

        if(!isLoggedIn()){
            header('location: ' . urlroot . '/auth/login');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data['userId'] = $_SESSION['user_id'];
            $data['oldPassword'] = $_POST['oldPassword'];
            $data['newPassword'] = $_POST['newPassword'];
            $data['confirmPassword'] = $_POST['confirmPassword'];

            
            $userInfo =  $this->userModel->findUserById($data['userId']);

            if(empty($data['oldPassword'])){
                $data['oldPasswordErr'] = "Por favor, ingresa su antigua contraseña.";
            }else if(!password_verify($data['oldPassword'], $userInfo->password)){
                $data['oldPasswordErr'] = "Esta contraseña es incorrecta. Intentelo de nuevo.";
            }

            if(empty($data['newPassword'])){
                $data['newPasswordErr'] = "Por favor, ingrese su nueva contraseña.";
            }

            if(empty($data['confirmPassword'])){
                $data['confirmPasswordErr'] = "Por favor, ingrese la contrasña.";
            }else if($data['confirmPassword'] != $data['newPassword']){
                $data['confirmPasswordErr'] = 'Las contraseñas no coinciden.';
            }

            if(empty($data['oldPasswordErr']) && empty($data['newPasswordErr']) && empty($data['confirmPasswordErr'])){

                //Encriptar contraseña.
                $data['newPassword'] = password_hash($data['newPassword'], PASSWORD_DEFAULT);

                //Hacer la consulta a la base de datos.
                $isUpdatedPassword = $this->userModel->updatePassword($data);

                //Si la contraseña de actualizo correctamente, rediridira al perfil, de lo contrario dara error
                if($isUpdatedPassword){
                    header('location: ' . urlroot . '/user/profile');
                }else{
                    die('Se ha producido un error en la consulta');
                }
            }
        }
            $this->view('Users/changePassword', $data);     
    }
}
