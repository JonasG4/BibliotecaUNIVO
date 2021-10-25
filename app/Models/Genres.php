<?php
    class Genres{
        private $db;

        public function __construct(){
            $this->db = new database;
        }

        //Recuperar todos los géneros
        public function Get(){
            $this->db->query('SELECT Id_Genre, Genre_Name, Genre_Description FROM Genres');

            $Genres = $this->db->resultSet();

            if(!empty($Genres)){
                return $Genres;
            }
        }

        //Recuperar un género por Id
        public function GetId($Id){
            $this->db->query('SELECT Id_Genre, Genre_Name, Genre_Description FROM Genres WHERE Id_Genre = :Id');

            $this->db->bind(':Id', $Id);

            $Genre = $this->db->single();

            if(!empty($Genre)){
                return $Genre;
            }else{
                die('No fue posible obtener el registro');
            }
        }

        //Buscar si existe un género determinado
        public function Find_Genre_Name($Genre_Name){
            $this->db->query('SELECT Id_Genre, Genre_Name, Genre_Description FROM Genres WHERE Genre_Name = :Genre_Name');
            $this->db->bind(':Genre_Name', $Genre_Name);

            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        //Crear un nuevo género
        public function Create($data){
            $this->db->query('INSERT INTO Genres(Genre_Name, Genre_Description) VALUES (:Genre_Name, :Genre_Description)');

            $this->db->bind(':Genre_Name', $data['Genre_Name']);
            $this->db->bind(':Genre_Description', $data['Genre_Description']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
        //Actualizar un registro por Id, utilizando un array
        public function Update($data){
            $this->db->query('UPDATE Genres SET Genre_Name = :Genre_Name, Genre_Description = :Genre_Description WHERE Id_Genre = :Id');
            $this->db->bind(':Id', $data['Id_Genre']);
            $this->db->bind(':Genre_Name', $data['Genre_Name']);
            $this->db->bind(':Genre_Description', $data['Genre_Description']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        } 
        //Eliminar un registro
        public function Delete($Id){
            $this->db->query('DELETE FROM Genres WHERE Id_Genre = :Id');

            $this->db->bind(':Id', $Id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
?>