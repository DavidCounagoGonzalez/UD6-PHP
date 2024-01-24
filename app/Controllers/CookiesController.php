<?php


 # https://www.php.net/manual/en/function.setcookie


namespace Com\Daw2\Controllers;

class CookiesController extends \Com\Daw2\Core\BaseController {
    
    public function testCookie(){
        setcookie('test', '<b>Este es un valor normal</b>'); //Cuidado porque el código HTML o script se mostraría tal cual. Es necesaria escapar la salida.
        setrawcookie('testraw2', 'Esteesunvalorraw2');
        //setrawcookie('testraw', '<b>Este es un valor raw</b>'); //Da error porque no puede tener caracteres especiales
        
        $this->view->showViews(array('templates/header.view.php', 'cookies.view.php', 'templates/footer.view.php'), array('titulo' => 'Test Cookies', 'seccion' => '/cookie/test'));     
    }
    
    public function borrarCookie(){
        if(isset($_COOKIE['test'])){
            unset($_COOKIE['test']);
            setcookie('test', '', time()-3600);
        }
        if(isset($_COOKIE['testraw'])){
            unset($_COOKIE['testraw']);
            setcookie('testraw', '', time()-3600);
        }
        if(isset($_COOKIE['testraw2'])){
            unset($_COOKIE['testraw2']);
            setcookie('testraw2', '', time()-3600);
        }
        $this->view->showViews(array('templates/header.view.php', 'cookies.view.php', 'templates/footer.view.php'), array('titulo' => 'Borrar Cookies', 'seccion' => '/cookie/borrar'));     
    }
    
    public function darkMode() {
        setCookie('dark','true');
        header('location: /');
    }
    
    public function lightMode() {
        if(isset($_COOKIE['dark'])){
            unset($_COOKIE['dark']);
            setcookie('dark', '', time()-3600);
        }
        header('Location: /');
    }
}
