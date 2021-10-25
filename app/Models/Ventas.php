<?php
  class Ventas {
    private $db;

    public function __construct()
    {
      $this->db = new Database;
    }
    public function getVentas($idCliente,$sesionId,$correo) {
      $total = 0;

      foreach($_SESSION['CARRITO'] as $indice => $producto) {
        $total = $total+($producto['precio'] * $producto['cantidad']);
      }
      $this->db->query("INSERT INTO `ventas`
      (`id`,`claveTransaccion`,`fecha`,`idCliente`,`correo`,`total`,`status`)
      VALUES(NULL,:claveTransaccion,NOW(),:idCliente,:correo,:total,'aprobado')");
        $this->db->bind(":claveTransaccion",$sesionId);
        $this->db->bind(":correo",$correo);
        $this->db->bind(":idCliente",$idCliente);
        $this->db->bind(":total",$total);
        $this->db->execute();
        $lastId = $this->db->lastInsert();
        return $lastId;
    }

  }
?>