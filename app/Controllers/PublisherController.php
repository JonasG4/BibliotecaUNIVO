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
                    'Title' => 'Editoriales',
                    'Publishers' => $Publishers,
                    'Error' => ''
                ];
            }else{
                $data = [
                    'Title' => 'Editoriales',
                    'Publishers' => '',
                    'Error' => $Error
                ];
            }
            $this->view('Dashboard/Publisher/index', $data);
        }

        public function Refresh(){
            $Publishers = $this->publisherModel->Get();
            
            echo json_encode($Publishers);
        }

        public function Create(){
            $data = [
                'Title' => 'Añadir editorial',
                'Publisher_Name' => '',
                'Name_Error' => '',
                'Origin_Country' => '',
                'Country_Error' => '',
                'Phone_Number' => '',
                'Phone_Error' => '',
                'Error' => ''
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'Title' => 'Añadir editorial',
                    'Publisher_Name' => trim($_POST['Publisher_Name']),
                    'Name_Error' => '',
                    'Origin_Country' => trim($_POST['Origin_Country']),
                    'Country_Error' => '',
                    'Phone_Number' => trim($_POST['Phone_Number']),
                    'Phone_Error' => '',
                    'Error' => ''
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
                        echo json_encode("success");
                    }else{
                        $data['Error'] = 'No es posible añadir una nueva editorial.';
                    }
                }else{
                    $data['ErrValidation'] = true;
                    echo json_encode($data);
                }
            }
            if(!empty($Error)){
                $data = [
                        'Authors' => '',
                        'Error' => $Error
                    ];
            }
        }

        public function Update($Id){
            $Id = (integer)$Id[0];
            if($Id == 0 || !is_int($Id) || empty($Id)){
                die('Identificador inválido');
            }else{
                $Publisher = $this->publisherModel->GetId($Id);

                if(!empty($Publisher)){
                    $data = [
                        'Title' => 'Actualizar editorial',
                        'Publisher' => $Publisher,
                        'Id_Publisher' => '',
                        'Publisher_Name' => '',
                        'Name_Error' => '',
                        'Origin_Country' => '',
                        'Country_Error' => '',
                        'Phone_Number' => '',
                        'Phone_Error' => '',
                        'Error' => ''
                    ];

                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
                        $data = [
                            'Title' => 'Actualizar editorial',
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
                                $data['Error'] = 'No es posible actualizar el registro.';
                            }
                        }
                    }
                    $this->view("Publisher/Update", $data);
                }else{
                    $Error = 'Antes de actualizar una editorial, es necesario agregar un registro';
                }
            }
            
            if(!empty($Error)){
                $data = [
                        'Books' => '',
                        'Error' => $Error
                    ];
                $this->view('Dashboard/Publisher/index', $data);
            }
        }

        public function Delete($Id){
            $Id = (integer)$Id[0];
            if($Id == 0 || !is_int($Id) || empty($Id)){
                $Error = 'Identificador inválido';
            }
            if($this->publisherModel->Delete($Id)){
                header('location: ' . urlroot . '/Publisher/index');
            }else{
                $Error = 'No fue posible eliminar el registro';
            }
            
            if(!empty($Error)){
                $data = [
                        'Books' => '',
                        'Error' => $Error
                    ];
                $this->view('Dashboard/Publisher/index', $data);
            }
        }
    }
?>