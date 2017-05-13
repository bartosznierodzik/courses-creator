<?php

class Login extends Controller{

    public function index($success = ''){
        if($this->isLogin()){
            header("Location: Dashboard");
        }
        else {
            $this->view('login', ['success' => $success]);
        }
    }

    public function logIn(){
        if(isset($_POST['submit'])){
            if(($_POST['username'] == 'dlink') && ($_POST['password'] == 'Dlinkisawesome!')) {
                $_SESSION['user']['online'] = true;
                header("Location: ../Dashboard");
            }else{
                $this->view('login', ['error_message' => 'Niepoprawny login lub hasło!']);
            }
        }
    }

    public function logOut(){
        unset($_SESSION['user']);
        unset($_SESSION);
        $this->index();
    }

    
}
