<?php
    class Publishers{
        private $db;

        public function __construct() {
            $this->db = new Database;
        }   

        //Recuperar todos los registros existentes
        public function Get(){
            $this->db->query('SELECT Id_Publisher, Publisher_Name, Origin_Country, Phone_Number FROM Publishers');

            $Publishers = $this->db->resultSet();
            if(!empty($Publishers)){
                return $Publishers;
            }
        }

        //Recuperar un registro por array
        public function GetId($Id){
            $this->db->query('SELECT Id_Publisher, Publisher_Name, Origin_Country, Phone_Number FROM Publishers WHERE Id_Publisher = :Id');

            $this->db->bind(':Id', $Id);

            $Publisher = $this->db->single();
            if(!empty($Publisher)){
                return $Publisher;
            }else{
                die('No fue posible obtener el registro');
            }
        }

        public function Create($data){
            $this->db->query('INSERT INTO Publishers(Publisher_Name, Origin_Country, Phone_Number) VALUES(:Publisher_Name, :Origin_Country, :Phone_Number)');

            $this->db->bind(':Publisher_Name', $data['Publisher_Name']);
            $this->db->bind(':Origin_Country', $data['Origin_Country']);
            $this->db->bind(':Phone_Number', $data['Phone_Number']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //Actualizar un registro por Id, utilizando un array
        public function Update($data){
            $this->db->query('UPDATE Publishers SET Publisher_Name = :Publisher_Name, Origin_Country = :Origin_Country, Phone_Number = :Phone_Number WHERE Id_Publisher = :Id');

            $this->db->bind(':Publisher_Name', $data['Publisher_Name']);
            $this->db->bind(':Origin_Country', $data['Origin_Country']);
            $this->db->bind(':Phone_Number', $data['Phone_Number']);
            $this->db->bind(':Id', $data['Id_Publisher']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //Eliminar un registro
        public function Delete($Id){
            $this->db->query('DELETE FROM Publishers WHERE Id_Publisher = :Id');
            $this->db->bind(':Id', $Id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
?>