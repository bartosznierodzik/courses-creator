<?php

class Controller{
    
    public function model($model){
        require_once '../app/core/Database.php';
        require_once '../app/model/' . $model . '.php';
     
        return new $model();
    }
    
    public function view($view, $data = []) {
        
        require_once '../app/view/' . $view . '.php';
    }
    
    /*
     * DO FUNCTIONS
     */
    public function mailer_init(){
        require_once '../app/libs/phpmailer/PHPMailerAutoload.php';
//        require_once '../app/libs/phpmailer/class.phpmailer.php';
    }
    
    /*
     * GET FUNCTIONS
     */
    
    public function getDomain() {
        return $_SERVER["SERVER_NAME"];
    }
    
    public function getBase() {
        return 'http://' . $this->getDomain() . '/panel/';
    }

    public function getAddress(){
        return $_SERVER['PHP_SELF'];
    }

    /*
     * CHECKING FUNCTIONS
     */

    function isLogin(){
        if (!isset($_SESSION['user']['online'])){
            return false;
        }
        if (!$_SESSION['user']['online']){
            return false;
        }
        return true;
    }

    function pre($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    
}