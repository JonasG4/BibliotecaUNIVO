<?php 
  class DetalleVenta {
    private $db;
    public function __construct()
    {
      $this->db = new Database;
    }

    public function setDetalleVenta($idVenta) {
      foreach ($_SESSION['CARRITO'] as $key => $value) {
        $idProducto = $value['id'];
        $precioUnitario = $value['precio'];
        $cantidad = $value['cantidad'];
    
        $this->db->query("INSERT INTO `detalleventa` 
          (`id`, `idVenta`, `idProducto`, `precioUnitario`, `cantidad`, `descargado`) 
          VALUES (NULL, :idVenta, :idProducto, :precioUnitario, :cantidad, '0');");
        $this->db->bind(":idVenta",$idVenta);
        $this->db->bind(":idProducto",$idProducto);
        $this->db->bind(":precioUnitario",$precioUnitario);
        $this->db->bind(":cantidad",$cantidad);
        $this->db->execute();
      }
      $idVenta = $this->db->lastInsert();
      return $idVenta;
    }
    public function getDetalle($idVenta) {
        $this->db->query("SELECT * FROM detalleVenta,productos 
        WHERE detalleventa.idProducto = productos.id 
        AND detalleventa.idVenta = :id");
        $this->db->bind(':id',$idVenta);
        $this->db->execute();
        $listadoProductos = $this->db->resultSet();
        $this->db->execute();
        return $listadoProductos;
    }
  }



?>