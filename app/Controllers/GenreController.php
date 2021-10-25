<?php
    class GenreController extends Controller{
        public function __construct(){
            $this->genreModel = $this->model('Genres');
        }

        public function index(){
            $Genres = $this->genreModel->Get();

            $Error = 'No fue posible obtener los registros';

            if(!empty($Genres)){
                $data = [
                    'Genres' => $Genres,
                    'Error' => ''
                ];
            }else{
                $data = [
                    'Genres' => '',
                    'Error' => $Error
                ];
            }
            $this->view('Genre/index', $data);
        }

        public function Create(){
            
            $data = [
                'Title' => 'Nuevo género',
                'Genre_Name' => '',
                'Name_Error' => '',
                'Genre_Description' => '',
                'Description_Error' => ''
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'Genre_Name' => trim($_POST['Genre_Name']),
                    'Name_Error' => '',
                    'Genre_Description' => trim($_POST['Genre_Description']),
                    'Description_Error' => ''
                ];

                $Words_Validation = "/^[a-zA-Z ]*$/i";

                //Validación de Nombre
                if(empty($data['Genre_Name'])){
                    $data['Name_Error'] = 'Por favor, ingrese el nombre del género.';
                }else if(!preg_match($Words_Validation, $data['Genre_Name'])){
                    $data['Name_Error'] = 'El dato ingresado únicamente debe contener letras.';
                }else if(strlen($data['Genre_Name']) > 150){
                    $data['Name_Error'] = 'Únicamente es permitido un máximo de 150 carácteres.';
                }else{
                    if($this->genreModel->Find_Genre_Name($data['Genre_Name'])){
                        $data['Name_Error'] = 'Género existente.';
                    }
                }

                //Validación de la Descripción
                if(empty($data['Genre_Description'])){
                    $data['Description_Error'] = 'Por favor, describa el género literario.';
                }else if(strlen($data['Genre_Description']) > 255){
                    $data['Description_Error'] = 'Únicamente es permitido un máximo de 255 carácteres.';
                }

                //Crear género
                if(empty($data['Name_Error']) && empty($data['Description_Error'])){
                    if($this->genreModel->Create($data)){
                        header('location: ' . urlroot . '/Genre/index');
                    }else{
                        die('No es posible añadir un nuevo género.');
                    }
                }
            }
            $this->view('Genre/Create', $data);
        }

        public function Update($Id){
            $Id = (integer)$Id[0];
            if($Id == 0 || !is_int($Id) || empty($Id)){
                die('Identificador inválido');
            }
            $Genre = $this->genreModel->GetId($Id);
            if(!empty($Genre)){
                
                $data = [
                    'Genre' => $Genre,
                    'Id_Genre' => '',
                    'Genre_Name' => '',
                    'Name_Error' => '',
                    'Genre_Description' => '',
                    'Description_Error' => ''
                ];

                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $data = [
                        'Genre' => $Genre,
                        'Id_Genre' => $Id,
                        'Genre_Name' => $_POST['Genre_Name'],
                        'Genre_Description' => $_POST['Genre_Description']
                    ];

                    $Words_Validation = "/^[a-zA-Z ]*$/i";
                    
                    //Validación de Nombre
                    if(empty($data['Genre_Name'])){
                        $data['Name_Error'] = 'Por favor, ingrese el nombre del género.';
                    }else if(!preg_match($Words_Validation, $data['Genre_Name']) || !is_string($data['Genre_Name'])){
                        $data['Name_Error'] = 'El dato ingresado únicamente debe contener letras.';
                    }else if(strlen($data['Genre_Name']) > 150){
                        $data['Name_Error'] = 'Únicamente es permitido un máximo de 150 carácteres.';
                    }else{
                        if($this->genreModel->Find_Genre_Name($data['Genre_Name'])){
                            $data['Name_Error'] = 'Género existente.';
                        }
                    }

                    //Validación de la Descripción
                    if(empty($data['Genre_Description'])){
                        $data['Description_Error'] = 'Por favor, describa el género literario.';
                    }else if(strlen($data['Genre_Description']) > 255){
                        $data['Description_Error'] = 'Únicamente es permitido un máximo de 255 carácteres.';
                    }

                    if(empty($data['Name_Error']) && empty($data['Description_Error'])){
                        if($this->genreModel->Update($data)){
                            header('location: ' . urlroot . '/Genre/index');
                        }else{
                            die('No es posible actualizar el registro.');
                        }
                    }
                }
                $this->view('Genre/Update', $data);
            }else{
                die('No fue posible obtener el registro');
            }
        }

        public function Delete($Id){
            $Id = (integer)$Id[0];
            if($Id == 0 || !is_int($Id) || empty($Id)){
                die('Identificador inválido');
            }
            if($this->genreModel->Delete($Id)){
                header('location: ' . urlroot . '/Genre/index');
            }else{
                die('No fue posible eliminar el registro');
            }
        }
    }
?>