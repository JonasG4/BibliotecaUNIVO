<?php
    class PublisherController extends Controller{
        public function __construct(){
            $this->publisherModel = $this->model('Publishers');
        }
        public function Index(){
            $Publishers = $this->publisherModel->Get();

            $Error = 'No fue posible obtener los registros';

            if(!empty($Publishers)){
                $data = [
                    'Publishers' => $Publishers,
                    'Error' => ''
                ];
            }else{
                $data = [
                    'Publishers' => '',
                    'Error' => $Error
                ];
            }
            $this->view('Publisher/index', $data);
        }

        public function Create(){
            $data = [
                'Title' => 'Nueva editorial',
                'Publisher_Name' => '',
                'Name_Error' => '',
                'Origin_Country' => '',
                'Country_Error' => '',
                'Phone_Number' => '',
                'Phone_Error' => '',
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'Publisher_Name' => trim($_POST['Publisher_Name']),
                    'Name_Error' => '',
                    'Origin_Country' => trim($_POST['Origin_Country']),
                    'Country_Error' => '',
                    'Phone_Number' => trim($_POST['Phone_Number']),
                    'Phone_Error' => '',
                ];
                
                //Validación de Nombre
                if(empty($data['Publisher_Name'])){
                    $data['Name_Error'] = 'Por favor, ingrese el nombre de la editorial.';
                }else if(strlen($data['Publisher_Name']) > 200){
                    $data['Name_Error'] = 'Únicamente es permitido un máximo de 200 carácteres.';
                }

                //Validación del país de origen
                if(empty($data['Origin_Country'])){
                    $data['Country_Error'] = 'Por favor, ingrese un país de origen.';
                }else if(strlen($data['Origin_Country']) > 255){
                    $data['Country_Error'] = 'Únicamente es permitido un máximo de 255 carácteres.';
                }
                
                //Validación del número telefónico
                if(empty($data['Phone_Number'])){
                    $data['Phone_Error'] = 'Por favor, ingrese un número telefónico.';
                }else if(strlen($data['Phone_Number']) > 9){
                    $data['Phone_Error'] = 'Únicamente es permitido un máximo de 9 carácteres.';
                }

                if(empty($data['Name_Error']) && empty($data['Country_Error']) && empty($data['Phone_Error'])){
                    if($this->publisherModel->Create($data)){
                        header('location: ' . urlroot . '/Publisher/index');
                    }else{
                        die('No es posible añadir una nueva editorial.');
                    }
                }
            }
            $this->view('Publisher/Create', $data);
        }

        public function Update($Id){
            $Id = (integer)$Id[0];
            if($Id == 0 || !is_int($Id) || empty($Id)){
                die('Identificador inválido');
            }
            $Publisher = $this->publisherModel->GetId($Id);

            if(!empty($Publisher)){
                $data = [
                    'Publisher' => $Publisher,
                    'Id_Publisher' => '',
                    'Publisher_Name' => '',
                    'Name_Error' => '',
                    'Origin_Country' => '',
                    'Country_Error' => '',
                    'Phone_Number' => '',
                    'Phone_Error' => '',
                ];

                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                    $data = [
                        'Publisher' => $Publisher,
                        'Id_Publisher' => $Id,
                        'Publisher_Name' => $_POST['Publisher_Name'],
                        'Name_Error' => '',
                        'Origin_Country' => $_POST['Origin_Country'],
                        'Country_Error' => '',
                        'Phone_Number' => $_POST['Phone_Number'],
                        'Phone_Error' => ''
                    ];
                
                    //Validación de Nombre
                    if(empty($data['Publisher_Name'])){
                        $data['Name_Error'] = 'Por favor, ingrese el nombre de la editorial.';
                    }else if(strlen($data['Publisher_Name']) > 200){
                        $data['Name_Error'] = 'Únicamente es permitido un máximo de 200 carácteres.';
                    }

                    //Validación del país de origen
                    if(empty($data['Origin_Country'])){
                        $data['Country_Error'] = 'Por favor, ingrese un país de origen.';
                    }else if(strlen($data['Origin_Country']) > 255){
                        $data['Country_Error'] = 'Únicamente es permitido un máximo de 255 carácteres.';
                    }
                    
                    //Validación del número telefónico
                    if(empty($data['Phone_Number'])){
                        $data['Phone_Error'] = 'Por favor, ingrese un número telefónico.';
                    }else if(strlen($data['Phone_Number']) > 9){
                        $data['Phone_Error'] = 'Únicamente es permitido un máximo de 9 carácteres.';
                    }

                    if(empty($data['Name_Error']) && empty($data['Country_Error']) && empty($data['Phone_Error'])){
                        if($this->publisherModel->Update($data)){
                            header('location: ' . urlroot . '/Publisher/index');
                        }else{
                            die('No es posible actualizar el registro.');
                        }
                    }
                }
                $this->view("Publisher/Update", $data);
            }else{
                die('No fue posible obtener el registro');
            }
        }

        public function Delete($Id){
            $Id = (integer)$Id[0];
            if($Id == 0 || !is_int($Id) || empty($Id)){
                die('Identificador inválido');
            }
            if($this->publisherModel->Delete($Id)){
                header('location: ' . urlroot . '/Publisher/index');
            }else{
                die('No fue posible eliminar el registro');
            }
        }
    }
?>