<?php

class Dashboard extends Controller
{
    public function index()
    {
        if($this->isLogin()) {
            $_SESSION['active_menu'] = 'dashboard';
            $this->view('user/dashboard');
        }
        else header("Location:Login");
    }

    public function getSomething(){
        $something = [
            'text' => 'Zobacz wszystkie projekty',
            'link' => $this->getBase().'/Projects',
        ];
        return $something;
    }
}
