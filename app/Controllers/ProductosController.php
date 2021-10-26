<?php 
  class ProductosController extends Controller {
    public function __construct()
    {
      $this->productModel = $this->model('Productos'); 
      $this->ventasModel = $this->model('Ventas');
      $this->detalleVentaModel = $this->model('DetalleVenta');
    }

    public function listaProductos() {
      $result = $this->productModel->getBooks();
      $data = [
        'result'=>$result,
          "id" => "",
          "nombre" => "",
          "cantidad" => "",
          "precio" => "",
          "mensaje"=> ""
      ];
    
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['btn-action'])) {
        switch($_POST['btn-action']) {
          case 'Agregar':
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
              $data['id'] = openssl_decrypt($_POST['id'],COD,KEY);
              $data['mensaje'].= "ID Correcto".$data['id']."<br/>";
            }else {
              $data['mensaje'].= 'ID Incorrecto'."<br/>";
            }
            if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
              $data['nombre'] = openssl_decrypt($_POST['nombre'],COD,KEY);
              $data['mensaje'].= "Nombre Correcto".$data['nombre']."<br/>";
            }else {
              $data['mensaje'].= 'Nombre Incorrecto'."<br/>";
            }
            if(is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY))){
              $data['cantidad'] = openssl_decrypt($_POST['cantidad'],COD,KEY);
              $data['mensaje'].= "Cantidad Correcta".$data['cantidad']."<br/>";
            }else {
              $data['mensaje'].= 'Cantidad Incorrecta'."<br/>";
            }
            if(is_numeric(openssl_decrypt($_POST['precio'],COD,KEY))){
              $data['precio'] = openssl_decrypt($_POST['precio'],COD,KEY);
               $data['mensaje'].= "Precio Correcto".$data['precio']."<br/>";
            }else {
               $data['mensaje'].= 'Precio Incorrecto'."<br/>";
            }
            if(!isset($_SESSION['CARRITO'])) {
              $producto = array(
                'id' =>  $data['id'],
                'nombre' =>  $data['nombre'],
                'cantidad' =>  $data['cantidad'],
                'precio' =>  $data['precio']
              );
              $_SESSION['CARRITO'][0] = $producto;
               $data['mensaje'] = "Producto agregado al carrito";
            }else {
              $idProductos = array_column($_SESSION['CARRITO'],"id");
              if(in_array($data['id'],$idProductos)){
                 $data['mensaje'] = "El producto ya ha sido seleccionado";
              }else {
                $numeroProductos = count($_SESSION['CARRITO']);
                $producto = array(
                  'id' =>  $data['id'],
                  'nombre' =>  $data['nombre'],
                  'cantidad' =>  $data['cantidad'],
                  'precio' =>  $data['precio']
                );
                $_SESSION['CARRITO'][$numeroProductos] = $producto;
                 $data['mensaje'] = "Producto agregado al carrito";
              }
            }
      
            //$mensaje = print_r($_SESSION['CARRITO'],true);
            
          break;
          case 'Eliminar':
            echo "<script>alert('Elemento eliminado del carrito');</script>";
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
              $Id = openssl_decrypt($_POST['id'],COD,KEY);
            
              foreach($_SESSION['CARRITO'] as $indice => $producto) {
                if($producto['id'] == $Id){
                  unset($_SESSION['CARRITO'][$indice]);
                  echo "<script>alert('Elemento eliminado del carrito');</script>";
                }
              }
            }else {
              $data['mensaje'].= 'ID Incorrecto'."<br/>";
            }
          break;
        }
      }
    }
      $this->view('Productos/listaProductos', $data); 
    }

    public function mostrarCarro() {
      $data = [
          "id" => "",
          "nombre" => "",
          "cantidad" => "",
          "precio" => "",
          "mensaje"=> ""
      ];
      $producto = array(
        'id' =>  $data['id'],
        'nombre' =>  $data['nombre'],
        'cantidad' =>  $data['cantidad'],
        'precio' =>  $data['precio']
      );
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['btn-action'])) {
          switch($_POST['btn-action']) {
            case 'Eliminar' :
              if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $Id = openssl_decrypt($_POST['id'],COD,KEY);
              
                foreach($_SESSION['CARRITO'] as $indice => $producto) {
                  if($producto['id'] == $Id){
                    unset($_SESSION['CARRITO'][$indice]);
                    
                  }
                }
              }else {
                $data['mensaje'].= 'ID Incorrecto'."<br/>";
              }
          }
        }
      }
      $this->view('Productos/mostrarCarro',$data);
    }

    public function Pagar() {
      $data = [
        "email" => "",
         "result" => array()
      ];
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sesionId = session_id();
        $idCliente =  $_SESSION['user_id'];
        $data['email'] =  $_POST['name'];
        $lastId = $this->ventasModel->getVentas($idCliente,$sesionId,$data['email']);
        $q = $this->detalleVentaModel->setDetalleVenta($lastId);
      }
      $this->view('Productos/Pagar',$data);
    }

    }


?>