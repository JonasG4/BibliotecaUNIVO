<?php

class Database{

    //Se instancian los parametros para la conexion con la base de datos
    private $dbHost = db_host;
    private $dbUser = db_user;
    private $dbPass = db_pass;
    private $dbName = db_name;
    
    //Se crean algunos helpers
    private $statement;
    private $dbHandler;
    private $error;

    public function __construct()
    {
        $conn = 'mysql:host=' . $this->dbHost . ";dbname=" . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            //Se crea la conexion con la BD
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //Se hacen las consultas a la BD
    public function query($sql){
        $this->statement = $this->dbHandler->prepare($sql);
    }

    //Une los valores, les asigna un tipo segun la BD
    public function bind($parameter, $value, $type = null){
        switch (is_null($type)){
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):   
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }

        $this->statement->bindValue($parameter, $value, $type);
    }
    
    //Ejecuta la consulta
    public function execute(){
       return $this->statement->execute();
    }

    //Devulve un array con los registros solicitados
    public function resultSet(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }


     //Devuelve un registro solicitado       
    public function single(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ); 
    }

    //Cuenta la cantidad de filas 
    public function rowCount(){
        $this->execute();
        return $this->statement->rowCount();
    }

}