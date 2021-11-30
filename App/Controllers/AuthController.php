<?php

namespace App\Controllers;


use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action
{

     public function login()
     {
          $action = $_POST['user'];
         
          $entitie = Container::getModel(ucfirst($action));
       
          $entitie->__set('email', $_POST['email']);
          $entitie->__set('password', md5($_POST['password']));
         
          $return = $entitie->authentication();
       
          if ($entitie->__get('id') != '' && $entitie->__get('name')) {
               session_start();
               $_SESSION['id'] = $entitie->__get('id');
               $_SESSION['name'] = $entitie->__get('name');

              
               header('Location: /dashboard-'.$action);
          } else {
               header('Location:/'.$action.'?login=erro');
          }
     }
    
     public function logout()
     {
          session_start();
          session_destroy();
          header('Location: /');
     }
}
