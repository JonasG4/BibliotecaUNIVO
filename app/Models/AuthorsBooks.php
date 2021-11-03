<?php
    class AuthorsBooks{
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        //Recuperar todos los registros
        public function Get(){
            $this->db->query('SELECT A.Id_AuthorBook, B.Id_Author, B.First_Name, B.Last_Name, C.Id_Book, C.Book_Title, C.Book_Synopsis, C.Publication_Date, C.Number_Pages
            FROM AuthorsBooks A
            INNER JOIN Authors B ON A.Id_Author = B.Id_Author
            INNER JOIN Books C ON A.Id_Book = C.Id_Book');

            $AuthorsBooks = $this->db->resultSet();

            if(!empty($AuthorsBooks)){
                return $AuthorsBooks;
            }
        }

        //Recuperar un registro por Id
        public function GetId($Id){
            $this->db->query('SELECT A.Id_AuthorBook, B.Id_Author, C.Id_Book 
            FROM AuthorsBooks A 
            INNER JOIN Authors B ON A.Id_Author = B.Id_Author
            INNER JOIN Books C ON A.Id_Book = C.Id_Book
            WHERE Id_AuthorBook = :Id');

            $this->db->bind(':Id', $Id);
            $AuthorsBook = $this->db->single();

            if(!empty($AuthorsBook)){
                return $AuthorsBook;
            }else{
                die('No fue posible obtener el registro');
            }
        }

        //Crear un nuevo registro
        public function Create($data){
            $this->db->query('INSERT INTO AuthorsBooks(Id_Author, Id_Book) VALUES (:Id_Author, :Id_Book)');

            $this->db->bind(':Id_Author', $data['Id_Author']);
            $this->db->bind(':Id_Book', $data['Id_Book']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //Actualizar registro por Id, utilizando un array
        public function Update($data){
            $this->db->query('UPDATE AuthorsBooks SET Id_Author = :Id_Author WHERE Id_Book = :Id_Book');

            $this->db->bind(':Id_Author', $data['Id_Author']);
            $this->db->bind(':Id_Book', $data['Id_Book']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        } 

        //Eliminar un registro
        public function Delete($Id){
            $this->db->query('DELETE FROM AuthorsBooks WHERE Id_AuthorBook = :Id');

            $this->db->bind(':Id', $Id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

       public function GetAuthorByIdBook($Id){
           $this->db->query('SELECT Id_Author From AuthorsBooks WHERE Id_Book = :Id_Book');

           $this->db->bind(':Id_Book', $Id);

          if($result = $this->db->single()){
                return $result;
          }else{
              return false;
          }
       }
    }
?>