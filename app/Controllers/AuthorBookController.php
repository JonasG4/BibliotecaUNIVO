<?php 
    class AuthorBookController extends Controller{

        public function __construct() {
            $this->authorsBooksModel = $this->model('AuthorsBooks');
            $this->authorsModel = $this->model('Authors');
            $this->booksModel = $this->model('Books');
        }

        public function Index(){
            $AuthorsBooks = $this->authorsBooksModel->Get();

            $Error = 'No fue posible obtener los registros';

            if(!empty($AuthorsBooks)){
                $data = [
                    'Title' => 'Autores y libros',
                    'AuthorsBooks' => $AuthorsBooks,
                    'Error' => ''
                ];
            }else{
                $data = [
                    'Title' => 'Autores y libros',
                    'AuthorsBooks' => '',
                    'Error' => $Error
                ];
            }
            $this->view('AuthorBook/index', $data);
        }

        public function Create(){
            $Authors = $this->authorsModel->Get();
            $Books = $this->booksModel->Get();
            if(!empty($Authors) && !empty($Books)){
                $data = [
                    'Title' => 'Añadir relación',
                    'Authors' => $Authors,
                    'Books' => $Books, 
                    'Id_Author' => '',
                    'Author_Error' => '',
                    'Id_Book' => '',
                    'Book_Error' => '',
                    'Error' => ''
                ];
                
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    
                    $data = [
                        'Title' => 'Añadir relación',
                        'Authors' => $Authors,
                        'Books' => $Books,
                        'Id_Author' => (integer)trim($_POST['Id_Author']),
                        'Author_Error' => '',
                        'Id_Book' => (integer)trim($_POST['Id_Book']),
                        'Book_Error' => '',
                        'Error' => ''
                    ];
    
                    //Validación de author
                    if($data['Id_Author'] == 0 || !is_int($data['Id_Author']) || empty($data['Id_Author'])){
                        $data['Author_Error'] = 'Identificador inválido';
                    }
                    //Validación de libro
                    if($data['Id_Book'] == 0 || !is_int($data['Id_Book']) || empty($data['Id_Book'])){
                        $data['Book_Error'] = 'Identificador inválido';
                    }
    
                    if(empty($data['Author_Error']) && empty($data['Author_Error'])){
                        if($this->authorsBooksModel->Create($data)){
                            header('location: '. urlroot . '/AuthorBook/index');
                        }else{
                            $data['Error'] = 'No es posible añadir una nueva relación.';
                        }
                    }
                }
                $this->view('AuthorBook/Create', $data);
            }else{
                $data = [
                    'AuthorsBooks' => '',
                    'Error' => $Error
                ];
                $this->view('AuthorBook/index', $data);
            }
        }

        public function Update($Id){
            $Id = (integer)$Id[0];
            if($Id == 0 || !is_int($Id) || empty($Id)){
                $Error = 'Identificador inválido';
            }else{
                $AuthorBook = $this->authorsBooksModel->GetId($Id);
                $Authors = $this->authorsModel->Get();
                $Books = $this->booksModel->Get();
    
                if(!empty($AuthorBook) && !empty($Authors) && !empty($Books)){
                    $data = [
                        'Title' => 'Actualizar relación',
                        'AuthorBook' => $AuthorBook, 
                        'Authors' => $Authors,
                        'Books' => $Books,
                        'Id_AuthorBook' => '',
                        'Id_Author' => '',
                        'Author_Error' => '',
                        'Id_Book' => '',
                        'Book_Error' => '',
                        'Error' => ''
                    ];
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                        $data = [
                            'Title' => 'Actualizar relación',
                            'AuthorBook' => $AuthorBook, 
                            'Authors' => $Authors,
                            'Books' => $Books,
                            'Id_AuthorBook' => $Id,
                            'Id_Author' => (integer)$_POST['Id_Author'],
                            'Author_Error' => '',
                            'Id_Book' => (integer)$_POST['Id_Book'],
                            'Book_Error' => '',
                            'Error' => ''
                        ];
    
                        //Validación de author
                        if($data['Id_Author'] == 0 || !is_int($data['Id_Author']) || empty($data['Id_Author'])){
                            $data['Author_Error'] = 'Identificador inválido';
                        }
                        //Validación de libro
                        if($data['Id_Book'] == 0 || !is_int($data['Id_Book']) || empty($data['Id_Book'])){
                            $data['Book_Error'] = 'Identificador inválido';
                        }
    
                        if(empty($data['Author_Error']) && empty($data['Author_Error'])){
                            if($this->authorsBooksModel->Update($data)){
                                header('location: '. urlroot . '/AuthorBook/index');
                            }else{
                                $data['Error'] = 'No es posible actualizar el registro.';
                            }
                        }
                    }
                    $this->view('AuthorBook/Update', $data);
                }else{
                    $Error = 'Antes de actualizar una relación, es necesario añadir un libro, author o relación.';
                }
            }
            if(!empty($Error)){
                $data = [
                        'Books' => '',
                        'Error' => $Error
                    ];
                $this->view('AuthorBook/index', $data);
            }
        }

        public function Delete($Id){
            $Id = (integer)$Id[0];
            if($Id == 0 || !is_int($Id) || empty($Id)){
                $Error = 'Identificador inválido';
            }

            if($this->authorsBooksModel->Delete($Id)){
                header('location: ' . urlroot . '/AuthorBook/index');
            }else{
                $Error = 'No fue posible obtener los registros';
            }
            if(!empty($Error)){
                $data = [
                        'Books' => '',
                        'Error' => $Error
                    ];
                $this->view('AuthorBook/index', $data);
            }
        }
    }
?>