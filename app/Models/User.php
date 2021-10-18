<?php
class User{
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data){
        $this->db->query('INSERT INTO users (name, lastname, username, email, password) VALUES(:name, :lastname, :username, :email, :password)');
        
        //Unir valores
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password'] ); 

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
}
