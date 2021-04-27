<?php

require 'app/bootstrap.php';

$errors = $Admin -> select_errors($pdo);
foreach($errors as $err){ 

    if($err['id_error']==1){
        $_GET['controller'] = $controller = empty($_GET['controller']) ? 'index' : basename((string)$_GET['controller']);
        $_GET['action'] = $action = empty($_GET['action']) ? 'index' : basename((string)$_GET['action']);

        $actionFile = 'app/controller/' . $controller . '/' . $action.'.php';

        if (file_exists($actionFile)) {
            require $actionFile;
        }else{
            require 'app/controller/index/404.php';
        }
    }else{
        require 'app/controller/index/errors.php';
    }
}




        




