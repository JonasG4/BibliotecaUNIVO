<?php
class User{
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }
    public function register($data){
        $this->db->query('INSERT INTO users (name, lastname, username, email, password, is_google_account) VALUES(:name, :lastname, :username, :email, :password, :isGoogleAccount)');
        
        //Unir valores
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password'] ); 
        $this->db->bind(':isGoogleAccount', $data['is_google_account'] ); 

        if($this->db->execute()){
         return true;
        }else{ 
         return false;
        }
    }

    public function login($usernameOrEmail, $password) {

        if(filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)){
            $field= "email";
        }else{
            $field= "username";
        }

        $this->db->query('SELECT * FROM users WHERE '.$field.' = :'.$field);    
        $this->db->bind(':'.$field, $usernameOrEmail);
        
        $row = $this->db->single();

        $hashedPassword = $row->password;

        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }

    public function glogin($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if(!empty($row)){
            return $row;
        }else{
            die("Algo salio mal");
        }
    }

    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');

        $this->db->bind(':email', $email);
        //Comprobar si el correo electronico existe
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function findUserById($Id){
        $this->db->query('SELECT * FROM users WHERE id = :id');

        $this->db->bind(':id', $Id);

        $result = $this->db->single();

        return $result;
    }

     public function findUserByUsername($username){
        $this->db->query('SELECT * FROM users WHERE username = :username');

        $this->db->bind(':username', $username);
        //Comprobar si existe este nombre de usuario
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function updateUser($data){
        $this->db->query('UPDATE users SET name = :name, lastname = :lastname, username = :username, email = :email WHERE id = :userId');
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':userId', $data['userId']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updatePassword($data){
        $this->db->query('UPDATE users SET password = :password WHERE id = :userId');

        $this->db->bind(':password', $data['newPassword']);
        $this->db->bind(':userId', $data['userId']);
    
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateAvatar($data){
        $this->db->query('UPDATE users SET avatar = :avatar WHERE id = :userId');
        
        $this->db->bind(':avatar', $data['avatar']);
        $this->db->bind(':userId', $data['userId']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function findAllUser(){
        $this->db->query('SELECT * FROM users');

        $result = $this->db->resultSet();

        return $result;
    }


    public function getUserByUsername($username){
        $this->db->query('SELECT * FROM users WHERE username = :username');

        $this->db->bind(':username', $username);

        $row = $this->db->execute();

        if(isset($row)){
            return $row;
        }else{
            return false;
        }
    }
}
