<?php 
    class BookController extends Controller{
        public function __construct() {
            $this->bookModel = $this->model('Books');
            $this->genreModel = $this->model('Genres');
            $this->publisherModel = $this->model('Publishers');
        }

        public function filterBook(){
           $table="";
           $obj = $this->bookModel->filterByTitile($_POST['books']);
            
           if($obj-> rowCount() > 0){
               foreach ($obj as $value) {
                   $table.=
                   '<div class="container__books">
                   <img src="'. $value->Book_Cover.'" alt="" class="book__cover">
                   <div class="book__details">
                   <h1 class="book__title">$value->'.$value->Book_Title.'</h1>
                   <h3 class="book__autor">'.$value->Book_Id_Genre.'</h3>
                   <p class="book__sinopsis"> 
                   '.$value->Book_Synopsis.'
                   </p>
                   </div>
                   </div>
                   ';
                }
            }

             echo json_decode($table);
        }
        
        public function Index(){
            $Books = $this->bookModel->Get();

            $Error = 'No fue posible obtener los registros';

            if(!empty($Books)){
                $data = [
                    'Title' => 'Libros',
                    'Books' => $Books,
                    'Error' => ''
                ];
            }else{
                $data = [
                    'Title' => 'Libros',
                    'Books' => '',
                    'Error' => $Error
                ];
            }
            $this->view('Book/index', $data);
        }

        public function Create(){
            $Genres = $this->genreModel->Get();
            $Publishers = $this->publisherModel->Get();
            if(!empty($Genres) && !empty($Publishers)){    
                $data = [
                    'Title' => 'Añadir libro',
                    'Genres' => $Genres,
                    'Publishers' => $Publishers,
                    'ISBN' => '',
                    'ISBN_Error' => '',
                    'Book_Title' => '',
                    'Title_Error' => '',
                    'Book_Synopsis' => '',
                    'Synopsis_Error' => '',
                    'Book_Edition' => '',
                    'Edition_Error' => '',
                    'Number_Pages' => '',
                    'NumberPages_Error' => '',
                    'Publication_Date' => '',
                    'Date_Error' => '',
                    'Id_Genre' => '',
                    'Genre_Error' => '',
                    'Id_Publisher' => '',
                    'Publisher_Error' => '',
                    'Error' => ''
                ];
    
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                    $data = [
                        'Title' => 'Añadir libro',
                        'Genres' => $Genres,
                        'Publishers' => $Publishers,
                        'ISBN' => trim($_POST['ISBN']),
                        'ISBN_Error' => '',
                        'Book_Title' => trim($_POST['Book_Title']),
                        'Title_Error' => '',
                        'Book_Synopsis' => trim($_POST['Book_Synopsis']),
                        'Synopsis_Error' => '',
                        'Book_Edition' => (integer)trim($_POST['Book_Edition']),
                        'Edition_Error' => '',
                        'Number_Pages' => (integer)trim($_POST['Number_Pages']),
                        'NumberPages_Error' => '',
                        'Publication_Date' => trim($_POST['Publication_Date']),
                        'Date_Error' => '',
                        'Id_Genre' => (integer)trim($_POST['Id_Genre']),
                        'Genre_Error' => '',
                        'Id_Publisher' => (integer)trim($_POST['Id_Publisher']),
                        'Publisher_Error' => '',
                        'Error' => ''
                    ]; 

                    //Validación del ISBN
                    if(empty($data['ISBN'])){
                        $data['ISBN_Error'] = 'Por favor, ingrese un ISBN válido.';
                    }else if(strlen($data['ISBN']) > 17){
                        $data['ISBN_Error'] = 'Únicamente es permitido un máximo de 17 carácteres.';
                    }

                    //Validación del título del libro
                    if(empty($data['Book_Title'])){
                        $data['Title_Error'] = 'Por favor, ingrese el título del libro.';
                    }else if(strlen($data['Book_Title']) > 255){
                        $data['Title_Error'] = 'Únicamente es permitido un máximo de 255 carácteres.';
                    }
    
                    //Validación de la sinopsis
                    if(empty($data['Book_Synopsis'])){
                        $data['Synopsis_Error'] = 'Por favor, ingrese la sinopsis del libro.';
                    }else if(strlen($data['Book_Synopsis']) > 500){
                        $data['Synopsis_Error'] = 'Únicamente es permitido un máximo de 500 carácteres.';
                    }
    
                    //Validación de la edición del libro
                    if(empty($data['Book_Edition']) || !is_int($data['Book_Edition']) || $data['Book_Edition'] <= 0){
                        $data['Edition_Error'] = 'Por favor, ingrese una edición válida.';
                    }
    
                    //Validación de la cantidad de páginas
                    if(empty($data['Number_Pages']) || !is_int($data['Number_Pages']) || $data['Number_Pages'] <= 0){
                        $data['NumberPages_Error'] = 'Por favor, ingrese una cantidad válida.';
                    }
    
                    //Validación de la fecha de publicación
                    if(empty($data['Publication_Date']) || !is_string($data['Publication_Date'])){
                        $data['Date_Error'] = 'Por favor, ingrese una fecha válida.';
                    }
    
                    //Validación del Género
                    if($data['Id_Genre'] == 0 || !is_int($data['Id_Genre']) || empty($data['Id_Genre'])){
                        $data['Genre_Error'] = 'Identificador inválido';
                    }
    
                    //Validación de la editorial
                    if($data['Id_Publisher'] == 0 || !is_int($data['Id_Publisher']) || empty($data['Id_Publisher'])){
                        $data['Publisher_Error'] = 'Identificador inválido';
                    }

                    if(empty($data['ISBN_Error']) && empty($data['Title_Error']) && empty($data['Synopsis_Error']) && empty($data['Edition_Error']) && empty($data['NumberPages_Error']) && empty($data['Date_Error']) && empty($data['Genre_Error']) && empty($data['Publisher_Error'])){
                        if($this->bookModel->Create($data)){
                            header('location: ' . urlroot . '/Book/index');
                        }else{
                            $data['Error'] = 'No es posible añadir un nuevo libro.';
                        }
                    }
                }
                $this->view('Book/Create', $data);
            }else{
                $Error = 'Antes de añadir un nuevo libro, debes de ingresar una editorial o género.';
            }
            if(!empty($Error)){
                $data = [
                        'Books' => '',
                        'Error' => $Error
                    ];
                $this->view('Book/index', $data);
            }
        }

        public function Update($Id){
            $Id = (integer)$Id[0];
            if($Id == 0 || !is_int($Id) || empty($Id)){
                $Error = 'Identificador inválido';
            }else{
                $Book = $this->bookModel->GetId($Id);
                $Genres = $this->genreModel->Get();
                $Publishers = $this->publisherModel->Get();
    
                if(!empty($Genres) && !empty($Publishers) && !empty($Book)){    
                    $data = [
                        'Title' => 'Actualizar libro',
                        'Book' => $Book,
                        'Genres' => $Genres,
                        'Publishers' => $Publishers,
                        'ISBN' => '',
                        'ISBN_Error' => '',
                        'Book_Title' => '',
                        'Title_Error' => '',
                        'Book_Synopsis' => '',
                        'Synopsis_Error' => '',
                        'Book_Edition' => '',
                        'Edition_Error' => '',
                        'Number_Pages' => '',
                        'NumberPages_Error' => '',
                        'Publication_Date' => '',
                        'Date_Error' => '',
                        'Id_Book' => '',
                        'Id_Genre' => '',
                        'Genre_Error' => '',
                        'Id_Publisher' => '',
                        'Publisher_Error' => '',
                        'Error' => ''
                    ];
        
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
                        $data = [
                            'Title' => 'Actualizar libro',
                            'Book' => $Book,
                            'Genres' => $Genres,
                            'Publishers' => $Publishers,
                            'ISBN' => trim($_POST['ISBN']),
                            'ISBN_Error' => '',
                            'Book_Title' => trim($_POST['Book_Title']),
                            'Title_Error' => '',
                            'Book_Synopsis' => trim($_POST['Book_Synopsis']),
                            'Synopsis_Error' => '',
                            'Book_Edition' => (integer)trim($_POST['Book_Edition']),
                            'Edition_Error' => '',
                            'Number_Pages' => (integer)trim($_POST['Number_Pages']),
                            'NumberPages_Error' => '',
                            'Publication_Date' => trim($_POST['Publication_Date']),
                            'Date_Error' => '',
                            'Id_Book' => $Id,
                            'Id_Genre' => (integer)trim($_POST['Id_Genre']),
                            'Genre_Error' => '',
                            'Id_Publisher' => (integer)trim($_POST['Id_Publisher']),
                            'Publisher_Error' => '',
                            'Error' => ''
                        ]; 
    
                        //Validación del ISBN
                        if(empty($data['ISBN'])){
                            $data['ISBN_Error'] = 'Por favor, ingrese un ISBN válido.';
                        }else if(strlen($data['ISBN']) > 17){
                            $data['ISBN_Error'] = 'Únicamente es permitido un máximo de 17 carácteres.';
                        }
    
                        //Validación del título del libro
                        if(empty($data['Book_Title'])){
                            $data['Title_Error'] = 'Por favor, ingrese el título del libro.';
                        }else if(strlen($data['Book_Title']) > 255){
                            $data['Title_Error'] = 'Únicamente es permitido un máximo de 255 carácteres.';
                        }
        
                        //Validación de la sinopsis
                        if(empty($data['Book_Synopsis'])){
                            $data['Synopsis_Error'] = 'Por favor, ingrese la sinopsis del libro.';
                        }else if(strlen($data['Book_Synopsis']) > 500){
                            $data['Synopsis_Error'] = 'Únicamente es permitido un máximo de 500 carácteres.';
                        }
        
                        //Validación de la edición del libro
                        if(empty($data['Book_Edition']) || !is_int($data['Book_Edition']) || $data['Book_Edition'] <= 0){
                            $data['Edition_Error'] = 'Por favor, ingrese una edición válida.';
                        }
        
                        //Validación de la cantidad de páginas
                        if(empty($data['Number_Pages']) || !is_int($data['Number_Pages']) || $data['Number_Pages'] <= 0){
                            $data['NumberPages_Error'] = 'Por favor, ingrese una cantidad válida.';
                        }
        
                        //Validación de la fecha de publicación
                        if(empty($data['Publication_Date']) || !is_string($data['Publication_Date'])){
                            $data['Date_Error'] = 'Por favor, ingrese una fecha válida.';
                        }
        
                        //Validación del Género
                        if($data['Id_Genre'] == 0 || !is_int($data['Id_Genre']) || empty($data['Id_Genre'])){
                            $data['Genre_Error'] = 'Identificador inválido';
                        }
        
                        //Validación de la editorial
                        if($data['Id_Publisher'] == 0 || !is_int($data['Id_Publisher']) || empty($data['Id_Publisher'])){
                            $data['Publisher_Error'] = 'Identificador inválido';
                        }
    
                        if(empty($data['ISBN_Error']) && empty($data['Title_Error']) && empty($data['Synopsis_Error']) && empty($data['Edition_Error']) && empty($data['NumberPages_Error']) && empty($data['Date_Error']) && empty($data['Genre_Error']) && empty($data['Publisher_Error'])){
                            if($this->bookModel->Update($data)){
                                header('location: ' . urlroot . '/Book/index');
                            }else{
                                $data['Error'] = 'No es posible actualizar un registro.';
                            }
                        }
                    }
                    $this->view('Book/Update', $data);
                }else{
                $Error = 'Antes un actualizar libro, debes de añadir un autor, género o libro.';
                }
            }
            if(!empty($Error)){
                $data = [
                        'Books' => '',
                        'Error' => $Error
                    ];
                $this->view('Book/index', $data);
            }
        }

        public function Delete($Id){
            $Id = (integer)$Id[0];
            if($Id == 0 || !is_int($Id) || empty($Id)){
                $Error = 'Identificador inválido';
            }
            if($this->bookModel->Delete($Id)){
                header('location: '. urlroot .'/Book/index');
            }else{
                $Error = 'No fue posible eliminar el registro.';
            }
            
            if(!empty($Error)){
                $data = [
                        'Books' => '',
                        'Error' => $Error
                    ];
                $this->view('Book/index', $data);
            }
        }

    }
?>