<?php
class LoanController extends Controller{

    public function __construct()
    {
        $this->loanModel = $this->model('Loan');  
    }
    
    public function index(){
        $data = [
            'title' => 'Actualizar',
             'loans' => ''
        ];
        
        $loans = $this->loanModel->findAllLoan();
        
        $data['loans'] = $loans;

        $this->view('Loan/index', $data);            
    }

    public function request($id){

        $data = [
            'title' => 'Nuevo Prestamo',
            'user_Id' => '',
            'book_Id' => '',
            'duration' => '',
            'check_out_date' => '',
            'return_date' => '',
            'check_out_dateERR' => '',
            'durationErr' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $data['user_id'] = $_SESSION['user_id'];
            $data['Id_Book'] = 1;
            $data['duration'] = $_POST['duration'];
            $data['check_out_date'] = $_POST['check_out_date'];
            $data['return_date'] = $_POST['return_date'];           
        }

        $this->view('Loan/Create', $data);
    }

    public function Update($id){
        if(!isLoggedIn()){
            header('location: ' . urlroot .'/auth/login');
        }
        echo (Integer)$id;
        $loans = $this->loanModel->findLoanById($id[0]);

        $data = [
            'title' => 'Actualizar prestamo',
            'loans' => $loans,
            'user_id' => '',
            'status' => '',
            'statusErr' => ''
        ];  

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['loan_id'] = $_POST['loan_id'];
            $data['status'] = trim($_POST['status']);
            $data['user_id'] = $_SESSION['user_id'];
                        
            if(empty($data['status'])){
                $data['statusErr'] = 'Este campo no puede quedar vacio';
            }
            

            if(empty($data['statusErr'])){
                $result = $this->loanModel->Update($data);

                if($result){
                    header('location: ' .urlroot . '/loan/');
                }else{
                    die();
                }
            }
        }

        $this->view('Loan/Update', $data);
    }

}