<?php

if(isset($_POST['but_zam'])){
    
    for($i=1;$i<=$_SESSION['n_zam'];$i++){
        if(isset($_POST['rozmir_'.$i])){
            $_SESSION['rozmir'][$i] = test_input($_POST['rozmir_'.$i]);
        }else{
            $_SESSION['rozmir'][$i] = 'null';
        }
        $_SESSION['kilkist'][$i] = test_input($_POST['kilkist_'.$i]);

    }
    
    //Підключаємо Header
    require 'app/view/header.phtml';
    //Підключаємо menu 
    require 'app/view/menu.phtml';
    //Підключаємо файл індекс продукту
    require 'app/view/koszyk/zamowlenia.phtml';
    //Підключаємо Footer
    require 'app/view/footer.phtml';
    
}else if(isset($_POST['delet_zam'])){
    
    header('Location: '.$URL.'?controller=koszyk&action=index');
    exit;
}else if(isset($_POST['buy_zam'])){
    header('Location: '.$URL.'?controller=catalog&action=index');
    exit;
}else{
    header('Location: '.$URL.'?controller=catalog&action=index');
    exit;
}

