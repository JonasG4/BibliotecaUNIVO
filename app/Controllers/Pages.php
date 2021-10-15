<?php

class Pages extends Controller{
    public function __construct()
    {
        
    }

    public function index(){
        $data = [
            'title' => 'Inicio'
        ];

        $this->view('index',$data);
    }

}