<?php
//Підключаємо Header
require 'app/view/header.phtml';
//Підключаємо menu 
require 'app/view/menu.phtml';
if($_SESSION['n_zam'] === 0){
    //Підключаємо файл індекс продукту
    require 'app/view/koszyk/index_null.phtml';
}else if($_SESSION['n_zam'] > 0){
    //Підключаємо файл індекс продукту
    require 'app/view/koszyk/index.phtml';
}
//Підключаємо Footer
require 'app/view/footer.phtml';