<?php

namespace App\Core;

class Controller {

    protected $data = [];
    private $msg = [];
    
    public function __construct() {

    }

    protected function getData() {
        return $this->data;
    }

    private function setMsg($msg) {

        $this->msg = $msg;
    }

    public function getMsg() {

        return $this->msg;
    }

    public function selected($value, $selected) {
         
        return $value == $selected ? ' selected="selected"' : '';
    
    }

    public function foreach(array $variable) {
    foreach ($variable as $value) {      
        return $value;
      }
    }
    
    public function exp($array) {

        if($array = explode("/", $array)) {
    
        return $array[0];
      }
    }

    public function requestValue($key) {

       return (isset($_REQUEST[$key])) ? $_REQUEST[$key] : ''; 
    
    }

    public function checkvar($key) {

       (isset($_POST[$key]) && !empty($_POST[$key])) ? true : false; 
    
    }

    public function addSession($key, $value) {

        $_SESSION[$key] = $value;

    }

    public function returnSession($key) {

        return $_SESSION[$key]; 

    }    

    public function implodeArrayKeys($array)
    {
        // first we get the array keys using array_keys() PHP function
        $keys = array_keys($vars);

        // now join the keys into a string and separate using a comma
        $string = implode(", ",$keys);

        // and return the result
        return $string;
    }
        
    public function redirect($url)
    {   
        header("Location: ".BASE."{$url}");
       
    }

    public function __call($name, $arguments) {
        $this->loadTemplate('error_404');
    }

    public function loadView($viewName, $viewData = array()) {
        extract($viewData);
        include 'App/Views/' . $viewName . '.php';
    }

    public function loadTemplate($viewName, $viewData = array()) {
        
        include 'App/Views/template.php';
    }

    public function loadTemp($viewName, $viewData = array()) {

        include 'App/Views/template.php';
        die();
    }

    public function loadViewInTemplate($viewName, $viewData) {
        extract($viewData);
        include 'App/Views/' . $viewName . '.php';
    }

}
