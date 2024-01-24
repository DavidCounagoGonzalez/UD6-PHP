<?php

namespace Com\Daw2\Controllers;

class TestController extends \Com\Daw2\Core\BaseController{
   public function test ()
   {                                 
        $_vars = array('titulo' => 'Test',
                      'data' => array(1,2,3,4,5));
        $this->view->showViews(array('templates/header.view.php', 'test.view.php', 'templates/footer.view.php'), $_vars);      
   }
}
