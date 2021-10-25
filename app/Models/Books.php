<?php 
    class Books{
        private $db;

        public function __construct() {
            $this->db = new Database;
        }
        
        //recuperar todos los libros
        public function Get(){
            $this->db->query('SELECT A.Id_Book, A.ISBN, A.Book_Title, A.Book_Synopsis, A.Book_Edition, A.Number_Pages, A.Publication_Date, A.Publication_Date, A.Book_Cover, B.Id_Genre, B.Genre_Name, C.Id_Publisher, C.Publisher_Name
            FROM Books A
            INNER JOIN Genres B ON A.Id_Genre = B.Id_Genre
            INNER JOIN Publishers C ON A.Id_Publisher = C.Id_Publisher');

            $Books = $this->db->resultSet();

            if(!empty($Books)){
                return $Books;
            }
        }

        //recuperar un registro por Id
        public function GetId($Id){
            $this->db->query('SELECT A.Id_Book, A.ISBN, A.Book_Title, A.Book_Synopsis, A.Book_Edition, A.Number_Pages, A.Publication_Date, A.Publication_Date, A.Book_Cover, B.Id_Genre, B.Genre_Name, C.Id_Publisher, C.Publisher_Name
            FROM Books A 
            INNER JOIN Genres B ON A.Id_Genre = B.Id_Genre
            INNER JOIN Publishers C ON A.Id_Publisher = C.Id_Publisher WHERE Id_Book = :Id');

            $this->db->bind(':Id', $Id);

            $Book = $this->db->single();
            
            if(!empty($Book)){
                return $Book;
            }else{
                die('No fue posible obtener el registro');
            }
        }

        //Crear un nuevo libro
        public function Create($data){
            $this->db->query('INSERT INTO Books(ISBN, Book_Title, Book_Synopsis, Book_Edition, Number_Pages, Publication_Date, Book_Cover, Id_Genre, Id_Publisher) VALUES (:ISBN, :Book_Title, :Book_Synopsis, :Book_Edition, :Number_Pages, :Publication_Date, :Book_Cover, :Id_Genre, :Id_Publisher)');

            $this->db->bind(':ISBN', $data['ISBN']);
            $this->db->bind(':Book_Title', $data['Book_Title']);
            $this->db->bind(':Book_Synopsis', $data['Book_Synopsis']);
            $this->db->bind(':Book_Edition', $data['Book_Edition']);
            $this->db->bind(':Number_Pages', $data['Number_Pages']);
            $this->db->bind(':Publication_Date', $data['Publication_Date']);
            $this->db->bind(':Book_Cover', $data['Book_Cover']);
            $this->db->bind(':Id_Genre', $data['Id_Genre']);
            $this->db->bind(':Id_Publisher', $data['Id_Publisher']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //Actualizar un registro por Id, utilizando un array
        public function Update($data){
            $this->db->query('UPDATE Books SET ISBN = :ISBN, Book_Title = :Book_Title, Book_Synopsis = :Book_Synopsis, Book_Edition = :Book_Edition, Number_Pages = :Number_Pages, Publication_Date = :Publication_Date, Id_Genre = :Id_Genre, Id_Publisher = :Id_Publisher WHERE Id_Book = :Id'); 

            $this->db->bind(':Id', $data['Id_Book']);
            $this->db->bind(':ISBN', $data['ISBN']);
            $this->db->bind(':Book_Title', $data['Book_Title']);
            $this->db->bind(':Book_Synopsis', $data['Book_Synopsis']);
            $this->db->bind(':Book_Edition', $data['Book_Edition']);
            $this->db->bind(':Number_Pages', $data['Number_Pages']);
            $this->db->bind(':Publication_Date', $data['Publication_Date']);
            $this->db->bind(':Id_Genre', $data['Id_Genre']);
            $this->db->bind(':Id_Publisher', $data['Id_Publisher']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        //Eliminar un registro
        public function Delete($Id){
            $this->db->query("DELETE FROM Books WHERE Id_Book = :Id");

            $this->db->bind(':Id', $Id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
?>