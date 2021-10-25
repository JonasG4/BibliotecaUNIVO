<?php 
  class Productos {
    private $db;

    public function __construct()
    {
      $this->db = new Database;
    }

    public function getBooks() {
      $this->db->query('SELECT * FROM books');
      $this->db->execute();
      $datos = $this->db->resultSet();
      return $datos;
    }
  }


?>