<?php
class DashboardController extends Controller{
    
    public function __construct(){

    }

    public function Index(){

        $data = [
            'title' => 'Dashboard'
        ];


        $this->view('Dashboard/index', $data);
    }

}