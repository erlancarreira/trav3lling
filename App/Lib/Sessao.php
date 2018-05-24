<?php

namespace App\Lib;

class Sessao
{
    public static function setMsg($msg){
        $_SESSION['msg'] = $msg;
    }

    public static function clearMsg(){
        unset($_SESSION['msg']);
    }

    public static function getMsg(){
        return (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) ? $_SESSION['msg'] : "";
    }

    public static function Form($form){
        $_SESSION['form'] = $form;
    }

    public static function clearForm(){
        unset($_SESSION['form']);
    }

    public static function retornaValorFormulario($key){
        return (isset($_SESSION['form'][$key])) ? $_SESSION['form'][$key] : "";
    }

    public static function existForm(){
        return (isset($_SESSION['form'])) ? $_SESSION['form'] : "";
    }

    public static function gravaErro($erros){
        $_SESSION['erro'] = $erros;
    }

    public static function retornaErro(){
       return (isset($_SESSION['erro'])) ? $_SESSION['erro'] : false;
    }

    public static function limpaErro(){
        unset($_SESSION['erro']);
    }

}