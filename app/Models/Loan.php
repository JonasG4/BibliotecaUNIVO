<?php
//Gestion de prestamo

class Loan {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function Create($data){
        
        $this->db->query('INSERT INTO loan (user_id, book_id, duration, check_out_date, return_date) VALUES(:user_id, :book_id, :duration, :check_out_date, :return_date)');
        
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':book_id', $data['book_id']);
        $this->db->bind(':duration', $data['duration']);
        $this->db->bind(':check_out_date', $data['check_out_date']);
        $this->db->bind(':return_date', $data['return_date']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function Update($data){
        $this->db->query('UPDATE loan SET status = :status WHERE user_id = :user_id and loan_id = :loan_id');
        
        $this->db->bind(':loan_id', $data['loan_id']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':user_id', $data['user_id']);


        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function Delete($id){
        $this->db->query('DELETE FROM loan WHERE loan_id = :loan_id');
        
        $this->db->bind(':loan_id', $id);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function findLoanById($id){
        $this->db->query('SELECT loan_id, duration, check_out_date, return_date, status from loan WHERE loan_id = :loanId');

        $this->db->bind(':loanId', $id);
        
        print_r($id);

        if($result = $this->db->single()){
            return $result;
        }else{
            return false;
        }
    }

    public function findAllLoan(){
        $this->db->query('SELECT  A.loan_id, A.duration, A.check_out_date, A.return_date, A.status, B.username, C.Book_Title FROM loan A
        INNER JOIN users B ON A.user_id = B.id 
        INNER JOIN books C ON A.book_id = C.Id_Book');

        if($obj = $this->db->resultSet()){
            return $obj;
        }else{
            return false;
        }

    }

    public function findAllLoanByUserId($data){
        $this->db->query('SELECT A.loan_id, A.duration, A.check_out_date, A.return_date, A.status, B.username, C.title FROM loan A
        INNER JOIN users B ON A.user_id = B.id 
        INNER JOIN books C ON A.book_id = C.book_id
        WHERE A.user_Id = :userId AND A.book_id = :bookId'
        );

        $this->db->bind(':userId', $data['user_Id']);
        $this->db->bind(':bookId', $data['book_Id']);

        if($row = $this->db->resultSet()){
            return $row;
        }else{
            return false;
        }
    }
}