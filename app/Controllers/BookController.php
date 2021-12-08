<?php 
    class BookController extends Controller{
        public function __construct() {
            $this->bookModel = $this->model('Books');
            $this->genreModel = $this->model('Genres');
            $this->authorModel = $this->model('Authors');
            $this->publisherModel = $this->model('Publishers');
            $this->authorsBookModel = $this->model('AuthorsBooks');
            $this->azureService = $this->model('BlobService');
        }

        public function search(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            header("Content-type: application/json; charset=utf-8");
            $data = json_decode(file_get_contents("php://input"), true);

            $data['criterio'];
            $booksFiltered = $this->bookModel->filterByTitile($data['criterio']);
            
            $result = "";
            foreach ($booksFiltered as $value):
            $result .= '
             <div class="container__data-book">
                    <img src="'. imagenurl . $value->Book_Cover .'" alt="" class="data__book-img">
                    <div class="data__book-info">
                        <h3 class="data__book-title">'. $value->Book_Title . '</h3>
                        <h5 class="data__book-author">'. $value->Book_Edition .'</h5>
                    </div>
                </div>';
            endforeach;
            echo json_encode($result);
            }
       
        }

        public function Refresh(){
            $Books = $this->bookModel->Get();
            
            echo json_encode($Books);
        }
        
        public function Index(){
            $Books = $this->bookModel->Get();
            $Genre = $this->genreModel->Get();
            $Publishers = $this->publisherModel->Get();
            $Authors = $this->authorModel->Get();

            $Error = 'No fue posible obtener los registros';

            if(!empty($Books)){
                $data = [
                    'title' => 'Libros',
                    'Books' => $Books,
                    'Publisher' => $Publishers,
                    'Authors' => $Authors,
                    'Genre' => $Genre,
                    'Error' => ''
                ];
            }else{
                $data = [
                    'title' => 'Libros',
                    'Books' => '',
                    'Error' => $Error
                ];
            }
            $this->view('Dashboard/Books/index', $data);
        }

        public function Create(){
            $Genres = $this->genreModel->Get();
            $Publishers = $this->publisherModel->Get();
            $Authors = $this->authorModel->Get();

            if(!empty($Genres) && !empty($Publishers) && !empty($Authors)){    
                $data = [
                    'title' => 'Añadir libro',
                    'Genres' => $Genres,
                    'Publishers' => $Publishers,
                    'Authors' => $Authors,
                    'ISBN' => '',
                    'ISBN_Error' => '',
                    'Book_Title' => '',
                    'Title_Error' => '',
                    'Book_Synopsis' => '',
                    'Synopsis_Error' => '',
                    'Book_Cover' => '',
                    'Cover_Error' => '',
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
                    
                    $Book_Cover = $_FILES['Book_Cover'];
                    $data = [
                        'title' => 'Añadir libro',
                        'Genres' => $Genres,
                        'Publishers' => $Publishers,
                        'Authors' => $Authors,
                        'Id_Book' => '',
                        'ISBN' => trim($_POST['ISBN']),
                        'ISBN_Error' => '',
                        'Book_Title' => trim($_POST['Book_Title']),
                        'Title_Error' => '',
                        'Book_Synopsis' => trim($_POST['Book_Synopsis']),
                        'Synopsis_Error' => '',
                        'Book_Cover' => '',
                        'Cover_Error' => '',
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
                        'Id_Author' => (integer)trim($_POST['Id_Author']),
                        'Author_Error' => '',
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
                    
                    //Validación de la Autor
                    if($data['Id_Author'] == 0 || !is_int($data['Id_Author']) || empty($data['Id_Author'])){
                        $data['Author_Error'] = 'Identificador inválido';
                    }
                    
                    //Validacion para el campo portada
                    if(empty($Book_Cover)){
                        $data['Cover_Error'] = 'Por favor, sube una portada para el libro';
                    }
                    
                    if(empty($data['ISBN_Error']) && empty($data['Title_Error']) && empty($data['Synopsis_Error']) && empty($data['Edition_Error']) && empty($data['NumberPages_Error']) && empty($data['Date_Error']) && empty($data['Genre_Error']) && empty($data['Publisher_Error']) && empty($data['Book_Error'])){

                        //Extraer extension
                        $extension = new SplFileInfo($_FILES['Book_Cover']['name']);
                        $extension = $extension->getExtension();
                        
                        //Cadena con valores aleatorios
                        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                        $generedId = substr(str_shuffle($permitted_chars), 0, 50);
                        $randomName = substr(str_shuffle($permitted_chars), 0, 30);
                        
                        //Renombrando archivo
                        $renameFile = str_replace(' ', '', $data['Book_Title']) . '_' . $randomName . '.' . $extension;
                        $Book_Cover['name'] = $renameFile;
                        //Aginando datos
                        $data['Book_Cover'] = $Book_Cover['name'];
                        $data['Id_Book'] = $generedId;
                            //Crear Registro
                            if($this->bookModel->Create($data) && $this->authorsBookModel->Create($data)){
                                //Subir imagen
                                $this->azureService->upload($Book_Cover);     
                                
                                echo json_encode("success");
                            }else{
                            $data['Error'] = 'No es posible añadir un nuevo libro.';
                        }
                    }else{
                        $data['ErrValidation'] = true;
                        echo json_encode($data);
                    }
                }
            }else{
                $Error = 'Antes de añadir un nuevo libro, debes de ingresar una editorial o género.';
            }
            if(!empty($Error)){
                $data = [
                        'Books' => '',
                        'Error' => $Error
                    ];
            }
        }

        public function Update($Id){
            $Id = $Id[0];
            if(empty($Id)){
                $Error = 'Identificador inválido';
            }else{
                $Book = $this->bookModel->GetId($Id);
                $Genres = $this->genreModel->Get();
                $Publishers = $this->publisherModel->Get();
                $Authors = $this->authorModel->Get();
                $AuthorsBook = $this->authorsBookModel->Get();
    
                if(!empty($Genres) && !empty($Publishers) && !empty($Book) && !empty($Authors)){    
                    $data = [
                        'Title' => 'Actualizar libro',
                        'Book' => $Book,
                        'Genres' => $Genres,
                        'Publishers' => $Publishers,
                        'Authors' => $Authors,
                        'AuthorsBook' => $AuthorsBook,
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
                        'Id_Author' => '',
                        'Author_Error' => '',
                        'Error' => ''
                    ];
        
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
                        $data = [
                            'title' => 'Actualizar libro',
                            'Book' => $Book,
                            'Genres' => $Genres,
                            'Publishers' => $Publishers,
                            'Authors' => $Authors,
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
                            'Id_Author' => (integer)trim($_POST['Id_Author']),
                            'Author_Error' => '',
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
    
                        //Validación de la editorial
                        if($data['Id_Author'] == 0 || !is_int($data['Id_Author']) || empty($data['Id_Author'])){
                            $data['Author_Error'] = 'Identificador inválido';
                        }
    
                        if(empty($data['ISBN_Error']) && empty($data['Title_Error']) && empty($data['Synopsis_Error']) && empty($data['Edition_Error']) && empty($data['NumberPages_Error']) && empty($data['Date_Error']) && empty($data['Genre_Error']) && empty($data['Publisher_Error']) && empty($data['Author_Error'])){
                            if($this->bookModel->Update($data) && $this->authorsBookModel->Update($data)){
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
            $Id = $Id[0];
            if(empty($Id)){
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

        public function Details($Id){
            $Id = $Id[0];
            if(empty($Id)){
                $Error = 'Identificador inválido';
            }

            $book = $this->bookModel->GetId($Id);
            $genre = $this->genreModel->GetId($book->Id_Genre);
            $publisher = $this->publisherModel->GetId($book->Id_Publisher);
            
            //Si existe la relacion libro-autor, se lleva acabo la consulta
            if($auxId = $this->authorsBookModel->GetAuthorByIdBook($Id)){
                $author = $this->authorModel->GetId($auxId->Id_Author);
            }
            
            $recomendation = $this->bookModel->GetAllByGenre($book->Id_Genre);
            
            $data = [
                'title' => 'Detalles Libro',
                'Book' => $book,
                'Author' => $author,
                'Publisher' => $publisher,
                'Genre' => $genre,
                'recomendations' => $recomendation 
            ];
            $dataCart = [
                'title' => "",
                'id' => "",
                'author' => "",
                'fecha' => "",
                'image' => ""
            ];
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($_POST['btn-action'])) {
                    $dataCart['id'] = $_POST['idBook'];
                    $dataCart['title'] = $_POST['nombreBook'];
                    $dataCart['author'] = $_POST['author'];
                    $dataCart['fecha'] = $_POST['fecha'];
                    $dataCart['image'] = $_POST['image'];
                
                    if(!isset($_SESSION['CART'])) {
                        $producto = array(
                            'id' =>  $dataCart['id'],
                            'title' =>  $dataCart['title'],
                            'author' => $dataCart['author'],
                            'fecha' => $dataCart['fecha'],
                            'image' => $dataCart['image']
                        );
                        $_SESSION['CART'][0] = $producto;
                        $data['mensaje'] = "Producto agregado al carrito";
                    }else {
                        $idProductos = array_column($_SESSION['CART'],"id");
                        if(in_array($dataCart['id'],$idProductos)){
                            $data['mensaje'] = "El producto ya ha sido seleccionado";
                        }else {
                        $numeroProductos = count($_SESSION['CART']);
                        $producto = array(
                            'id' =>  $dataCart['id'],
                            'title' =>  $dataCart['title'],
                            'author' => $dataCart['author'],
                            'fecha' => $dataCart['fecha'],
                            'image' => $dataCart['image']
                        );
                        $_SESSION['CART'][$numeroProductos] = $producto;
                        $data['mensaje'] = "Producto agregado al carrito";
                        }
                    }
                }
              
            }
            $this->view('Book/details', $data);
        }
        public function mostrarCarrito() {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
              if(isset($_POST['btn-action'])) {
                $id = $_POST['id'];
                foreach($_SESSION['CART'] as $indice => $producto) {
                  if($producto['id'] == $id) {
                    unset($_SESSION['CART'][$indice]);
                    echo "<script>alert('Elemento eliminado del carrito');</script>";
                  }
                }
              }
            }
            $this->view('Book/mostrarCarrito', 'HOLA');
        }
    }
?>