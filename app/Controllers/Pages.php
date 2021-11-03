<?php

class Pages extends Controller{
    public function __construct()
    {
        $this->booksModel = $this->model('Books');
    }

    public function index(){
        $data = [
            'title' => 'Inicio',
            'Books' => ''
        ];

       $result = $this->booksModel->Get();

       if(!empty($result)){
           $data['Books'] = $result;
       }

        $this->view('index',$data);
    }

}