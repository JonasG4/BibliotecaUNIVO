<?php
    class AuthorController extends Controller{
        
        public function __construct() {
            $this->authorModel = $this->model('Authors');
        }

        public function Index(){
            $Authors = $this->authorModel->Get();

            $Error = 'No fue posible obtener los registros';
            
            if(!empty($Authors)){
                $data = [
                    'Title' => 'Autores',
                    'Authors' => $Authors,
                    'Error' => ''
                ];
            }else{
                $data = [
                    'Title' => 'Autores',
                    'Authors' => '',
                    'Error' => $Error 
                ];
            }
            $this->view('Dashboard/Authors/index', $data);
        }

        public function Create(){
            $data = [
                'Title' => 'Añadir autor',
                'First_Name' => '',
                'FirstName_Error' => '',
                'Last_Name' => '',
                'LastName_Error' => '',
                'Origin_Country' => '',
                'Country_Error' => '',
                'Error' => ''
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                $data = [
                    'Title' => 'Añadir autor',
                    'First_Name' => trim($_POST['First_Name']),
                    'FirstName_Error' => '',
                    'Last_Name' => trim($_POST['Last_Name']),
                    'LastName_Error' => '',
                    'Origin_Country' => trim($_POST['Origin_Country']),
                    'Country_Error' => '',
                    'Error' => ''
                ];

                $Words_Validation = '/^([a-z ñáéíóú]{2,255})$/i';
                
                //Validación de Nombre
                if(empty($data['First_Name'])){
                    $data['FirstName_Error'] = 'Por favor, ingrese el nombre del autor.';
                }else if(!preg_match($Words_Validation, $data['First_Name']) || !is_string($data['First_Name'])){
                    $data['FirstName_Error'] = 'El dato ingresado únicamente debe contener letras.';
                }else if(strlen($data['First_Name']) > 35){
                    $data['FirstName_Error'] = 'Únicamente es permitido un máximo de 35 carácteres.';
                }

                //Validación de Apellidos
                if(empty($data['Last_Name'])){
                    $data['LastName_Error'] = 'Por favor, ingrese los apellidos del autor.';
                }else if(!preg_match($Words_Validation, $data['Last_Name']) || !is_string($data['Last_Name'])){
                    $data['LastName_Error'] = 'El dato ingresado únicamente debe contener letras.';
                }else if(strlen($data['Last_Name']) > 75){
                    $data['LastName_Error'] = 'Únicamente es permitido un máximo de 75 carácteres.';
                }

                //Validación del país de origen
                if(empty($data['Origin_Country'])){
                    $data['Country_Error'] = 'Por favor, ingrese el nombre del autor.';
                }else if(!preg_match($Words_Validation, $data['Last_Name']) || !is_string($data['Origin_Country'])){
                    $data['Country_Error'] = 'El dato ingresado únicamente debe contener letras.';
                }else if(strlen($data['Origin_Country']) > 200){
                    $data['Country_Error'] = 'Únicamente es permitido un máximo de 200 carácteres.';
                }

                if(empty($data['FirstName_Error']) && empty($data['LastName_Error']) && empty($data['Country_Error'])){
                    if($this->authorModel->Create($data)){
                        echo json_encode("success");
                    }else{
                        $data['Error'] = 'No es posible añadir un nuevo autor.';
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

        public function Refresh(){
            $Authors = $this->authorModel->Get();
            
            echo json_encode($Authors);
        }

        public function Update($Id){
            $Id = (integer)$Id[0];
            if($Id == 0 || !is_int($Id) || empty($Id)){
                $Error = 'Identificador inválido';
            }else{
                $Author = $this->authorModel->GetId($Id);
                if(!empty($Author)){
                    $data = [
                        'Title' => 'Actualizar autor',
                        'Author' => $Author,
                        'Id_Author' => '',
                        'First_Name' => '',
                        'FirstName_Error' => '',
                        'Last_Name' => '',
                        'LastName_Error' => '',
                        'Origin_Country' => '',
                        'Country_Error' => '', 
                        'Error' => ''
                    ];
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
                        $data = [
                            'Title' => 'Actualizar autor',
                            'Author' => $Author,
                            'Id_Author' => $Id,
                            'First_Name' => $_POST['First_Name'],
                            'FirstName_Error' => '',
                            'Last_Name' => $_POST['Last_Name'],
                            'LastName_Error' => '',
                            'Origin_Country' => $_POST['Origin_Country'],
                            'Country_Error' => '',
                            'Error' => ''
                        ];
                        
                        $Words_Validation = '/^([a-z ñáéíóú]{2,255})$/i';
                        
                        //Validación de Nombre
                        if(empty($data['First_Name'])){
                            $data['FirstName_Error'] = 'Por favor, ingrese el nombre del autor.';
                        }else if(!preg_match($Words_Validation, $data['First_Name']) || !is_string($data['First_Name'])){
                            $data['FirstName_Error'] = 'El dato ingresado únicamente debe contener letras.';
                        }else if(strlen($data['First_Name']) > 35){
                            $data['FirstName_Error'] = 'Únicamente es permitido un máximo de 35 carácteres.';
                        }
    
                        //Validación de Apellidos
                        if(empty($data['Last_Name'])){
                            $data['LastName_Error'] = 'Por favor, ingrese los apellidos del autor.';
                        }else if(!preg_match($Words_Validation, $data['Last_Name']) || !is_string($data['Last_Name'])){
                            $data['LastName_Error'] = 'El dato ingresado únicamente debe contener letras.';
                        }else if(strlen($data['Last_Name']) > 75){
                            $data['LastName_Error'] = 'Únicamente es permitido un máximo de 75 carácteres.';
                        }
    
                        //Validación del país de origen
                        if(empty($data['Origin_Country'])){
                            $data['Country_Error'] = 'Por favor, ingrese el nombre del autor.';
                        }else if(!preg_match($Words_Validation, $data['Last_Name']) || !is_string($data['Origin_Country'])){
                            $data['Country_Error'] = 'El dato ingresado únicamente debe contener letras.';
                        }else if(strlen($data['Origin_Country']) > 200){
                            $data['Country_Error'] = 'Únicamente es permitido un máximo de 200 carácteres.';
                        }
    
                        if(empty($data['FirstName_Error']) && empty($data['LastName_Error']) && empty($data['Country_Error'])){
                            
                            if($this->authorModel->Update($data)){
                                header('location: ' . urlroot . '/Author/index');
                            }else{
                                $data['Error'] = 'No es posible actualizar el registro';
                            }
                        }
                    }
                    $this->view("Author/Update", $data);
                }else{
                    $Error = 'Antes de actualizar, debes registrar un autor.';
                }
            }
            
            if(!empty($Error)){
                $data = [
                        'Books' => '',
                        'Error' => $Error
                    ];
                $this->view('Dashboard/Book/index', $data);
            }
        }

        public function Delete($Id){
            $Id = (integer)$Id[0];
            if($Id == 0 || !is_int($Id) || empty($Id)){
                $Error = 'Identificador inválido';
            }
            if($this->authorModel->Delete($Id)){
                header('location: ' . urlroot . '/Author/index');
            }else{
                $Error = 'No fue posible eliminar el registro.';
            }
            if(!empty($Error)){
                $data = [
                        'Books' => '',
                        'Error' => $Error
                    ];
                $this->view('Dashboard/Book/index', $data);
            }
        }
    }
?>