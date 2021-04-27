<?php

    $login  = test_input($_POST['login']);
    $pass   = test_input($_POST['pass']);
    $adm = $Admin -> select_adm($pdo);
    foreach($adm as $adm){
        echo $adm['login'];
        if(($login == $adm['login'])&&($pass === $adm['pass'])){
            $_SESSION['adm']=$adm['id'];
            header('Location: ?controller=Falcon&action=zalogowany');
            exit;
        }else{
            $SESSION['adm']=-1;
            header('Location: ?controller=Falcon&action=index');
            exit;
        }
    }