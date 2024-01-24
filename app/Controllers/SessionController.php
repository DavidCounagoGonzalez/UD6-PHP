<?php

namespace Com\Daw2\Controllers;

class SessionController extends \Com\Daw2\Core\BaseController {
    
    
    
    public function sessionForm(){        
        $_vars = array(
            'titulo' => 'Form Session',
            'seccion' => '/session/form'
        );               
        $this->view->showViews(array('templates/header.view.php', 'session_form.view.php', 'templates/footer.view.php'), $_vars);     
    }
    
    public function sessionFormProcess(){ 
        $_errors = [];
        if(strlen($_POST['usuario'])){
            /* Si viene JS o HTML lo guardamos tal cual pero debemos tenerlo 
             * en cuenta al mostrarlo. Si queremos también podríamos guardarlo ya saneado.*/
            $_SESSION['usuario'] = $_POST['usuario'];    
        }
        else{
            $_errors['usuario'] = 'Inserte un nombre';
        }
        $_vars = array(
            'titulo' => 'Form Session',
            'seccion' => '/session/form'
        );
        $_vars['errors'] = $_errors;      
        $this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'), $_vars); 
    }
    
    public function borrarVariableSession(){
        $_vars = array(
            'titulo' => 'Sesión Cerrada',
            'seccion' => '/session/borrar'
        );
        //unset($_SESSION['nombre']); //Borramos sólo una variable
        //session_unset(); //Borra todas la variables
        session_destroy();//Destruye la sesión
        
        header('location: /login');
        //$this->view->showViews(array('templates/header.view.php', 'inicio.view.php', 'templates/footer.view.php'), $_vars);     
    }
}
