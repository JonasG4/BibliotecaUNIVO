<?php
    class Authors{
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        //Obtener todos los autores
        public function Get(){
            $this->db->query('SELECT Id_Author, First_Name, Last_Name, Origin_Country FROM Authors');
            $Authors = $this->db->resultSet();
            
            if(!empty($Authors)){
                return $Authors;
            } 
        }
        
        //Obtener autor por Id
        public function GetId($Id){
            $this->db->query('SELECT Id_Author, First_Name, Last_Name, Origin_Country FROM Authors WHERE Id_Author = :Id');

            $this->db->bind(':Id', $Id);

            $Author = $this->db->single();
            if(!empty($Author)){
                return $Author;
            }
        }

        //Crear un registro
        public function Create($data){
            $this->db->query('INSERT INTO Authors(First_Name, Last_Name, Origin_Country) VALUES (:First_Name, :Last_Name, :Origin_Country)');

            $this->db->bind(':First_Name', $data['First_Name']);
            $this->db->bind(':Last_Name', $data['Last_Name']);
            $this->db->bind(':Origin_Country', $data['Origin_Country']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //Actualizar registro por Id, utilizando un array
        public function Update($data){
            $this->db->query('UPDATE Authors SET First_Name = :First_Name, Last_Name = :Last_Name, Origin_Country = :Origin_Country WHERE Id_Author = :Id');

            $this->db->bind(':First_Name', $data['First_Name']);
            $this->db->bind(':Last_Name', $data['Last_Name']);
            $this->db->bind(':Origin_Country', $data['Origin_Country']);
            $this->db->bind(':Id', $data['Id_Author']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        //Eliminar un registro por Id
        public function Delete($Id){
            $this->db->query('DELETE FROM Authors WHERE Id_Author = :Id');

            $this->db->bind(':Id', $Id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
?>