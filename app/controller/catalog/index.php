<?php
//Підключаємо Header
require 'app/view/header.phtml';
//Підключаємо menu 
require 'app/view/menu.phtml';

if(!isset($_GET['typ'])){ $_GET['typ']=''; }
if(!isset($_GET['wyd'])){ $_GET['wyd']=''; }
if(!isset($_GET['class'])){ $_GET['class']=''; }

if(isset($_POST['sort'])){
    $_SESSION['sort'] = $_POST['sort'];
    $_SESSION['sex'] = $_POST['sex'];
    $_SESSION['wyrob'] = $_POST['wyrob'];
    $_SESSION['min'] = $_POST['min'];
    $_SESSION['max'] = $_POST['max'];
    
    header('Location: ?controller=catalog&action=index&typ='.$_GET['typ'].'&wyd='.$_GET['wyd'].'&class='.$_GET['class']);
    exit;
    
}

if(($_GET['typ']==0)&&(!isset($_GET['poszuk']))){
    $_SESSION['sort'] = '';
    $_SESSION['sex'] = '';
    $_SESSION['wyrob'] = '';
    $_SESSION['min'] = '';
    $_SESSION['max'] = '';
    //Підключаємо index catalog
    require 'app/view/catalog/index.phtml';
}else if(($_GET['typ']!==0)&&($_GET['wyd']==0)&&($_GET['class']==0)&&($_GET['typ']!=1000)&&(!isset($_GET['poszuk']))){
    $_SESSION['sort'] = '';
    $_SESSION['sex'] = '';
    $_SESSION['wyrob'] = '';
    $_SESSION['min'] = '';
    $_SESSION['max'] = '';
    //Підключаємо wyd catalog
    require 'app/view/catalog/wyd.phtml';
}else if(($_GET['typ']!==0)&&($_GET['wyd']!==0)&&($_GET['class']==0)&&($_GET['typ']!=1000)&&($_GET['wyd']!=1000)&&(!isset($_GET['poszuk']))){
    $_SESSION['sort'] = '';
    $_SESSION['sex'] = '';
    $_SESSION['wyrob'] = '';
    $_SESSION['min'] = '';
    $_SESSION['max'] = '';
    //Підключаємо class catalog
    require 'app/view/catalog/class.phtml';
}else if(($_GET['typ']!==0)&&($_GET['wyd']!==0)&&($_GET['class']!==0)&&($_GET['typ']!=1000)&&($_GET['wyd']!=1000)&&($_GET['class']!=1000)&&(!isset($_GET['poszuk']))){
    //Підключаємо фільтр
    $select_wyrobnyk = $Catalog -> select_wyrobnyk_prod($pdo,  $_GET['typ'], $_GET['wyd'], $_GET['class']);
    require 'app/view/catalog/sort_filtr.phtml';
    //Підключаємо class catalog
    require 'app/controller/catalog/get_limit.php';
    require 'app/view/catalog/products.phtml';
    require 'app/view/catalog/select_limit.phtml';
    
    if( ((isset($_SESSION['sort']))&&(!empty($_SESSION['sort'])))||
    ((isset($_SESSION['sex']))&&(!empty($_SESSION['sex'])))||
    ((isset($_SESSION['wyrob']))&&(!empty($_SESSION['wyrob'])))||
    ((isset($_SESSION['min']))&&(!empty($_SESSION['min'])))||
    ((isset($_SESSION['max']))&&(!empty($_SESSION['max'])))){
        $typ = $_GET['typ'];
        $wyd = $_GET['wyd'];
        $class = $_GET['class'];
        $limit = $limit_get;
        //******* Сортування ****************************************
            if($_SESSION['sort'] == 1){
                $sort = "Ocenka DESC";
            }else if($_SESSION['sort'] == 2){
                $sort = "cena_prod ASC";
            }else if($_SESSION['sort'] == 3){
                $sort = "cena_prod DESC";
            }else if($_SESSION['sort'] == 4){
                $sort = "name_prod ASC";
            }else if($_SESSION['sort'] == 5){
                $sort = "name_prod DESC";
            }else{
                $sort = "id_prod DESC";
            }
            //******* Стать ****************************************
            if($_SESSION['sex'] == 1){
                $sex = " = 1";
            }else if($_SESSION['sex'] == 2){
                $sex = " = 2";
            }else if($_SESSION['sex'] == 3){
                $sex = " = 3";
            }else if($_SESSION['sex'] == 4){
                $sex = " = 4";
            }else if($_SESSION['sex'] == 5){
                $sex = " = 5";
            }else{
                $sex = " IS NOT NULL";
            }
            
            $wyrob = $_SESSION['wyrob'];
            if(isset($_SESSION['min'])&&(empty($_SESSION['min']))){ $min = 0; }else{ $min = $_SESSION['min']; }
            if(isset($_SESSION['max'])&&(empty($_SESSION['max']))){ $max = 100000000; }else{ $max = $_SESSION['max']; }

        $posts = $Catalog -> select_filtr_prod_lim($pdo, $typ, $wyd, $class, $limit, $sex, $wyrob, $sort, $min, $max);
    }else{
        $posts = $Catalog -> select_posts($pdo, $limit_get, $_GET['typ'], $_GET['wyd'], $_GET['class']);
    }
    require 'app/view/catalog/pagination.phtml';
}else if($_GET['typ']==1000){
    //Підключаємо фільтр
    $select_wyrobnyk = $Catalog -> select_wyrobnyk_prod_typ($pdo);
    require 'app/view/catalog/sort_filtr.phtml';
    //Підключаємо class catalog
    require 'app/controller/catalog/get_limit_typ.php';
    require 'app/view/catalog/products.phtml';
    require 'app/view/catalog/select_limit.phtml';
    
    if( ((isset($_SESSION['sort']))&&(!empty($_SESSION['sort'])))||
    ((isset($_SESSION['sex']))&&(!empty($_SESSION['sex'])))||
    ((isset($_SESSION['wyrob']))&&(!empty($_SESSION['wyrob'])))||
    ((isset($_SESSION['min']))&&(!empty($_SESSION['min'])))||
    ((isset($_SESSION['max']))&&(!empty($_SESSION['max'])))){
        $typ = $_GET['typ'];
        $wyd = $_GET['wyd'];
        $class = $_GET['class'];
        $limit = $limit_get;
        //******* Сортування ****************************************
            if($_SESSION['sort'] == 1){
                $sort = "Ocenka DESC";
            }else if($_SESSION['sort'] == 2){
                $sort = "cena_prod ASC";
            }else if($_SESSION['sort'] == 3){
                $sort = "cena_prod DESC";
            }else if($_SESSION['sort'] == 4){
                $sort = "name_prod ASC";
            }else if($_SESSION['sort'] == 5){
                $sort = "name_prod DESC";
            }else{
                $sort = "id_prod DESC";
            }
            //******* Стать ****************************************
            if($_SESSION['sex'] == 1){
                $sex = " = 1";
            }else if($_SESSION['sex'] == 2){
                $sex = " = 2";
            }else if($_SESSION['sex'] == 3){
                $sex = " = 3";
            }else if($_SESSION['sex'] == 4){
                $sex = " = 4";
            }else if($_SESSION['sex'] == 5){
                $sex = " = 5";
            }else{
                $sex = " IS NOT NULL";
            }
            
            $wyrob = $_SESSION['wyrob'];
            if(isset($_SESSION['min'])&&(empty($_SESSION['min']))){ $min = 0; }else{ $min = $_SESSION['min']; }
            if(isset($_SESSION['max'])&&(empty($_SESSION['max']))){ $max = 100000000; }else{ $max = $_SESSION['max']; }

        $posts = $Catalog -> select_filtr_prod_typ_lim($pdo, $limit, $sex, $wyrob, $sort, $min, $max);
    }else{
        $posts = $Product -> select_posts_typ($pdo, $limit_get);
    }
    require 'app/view/catalog/pagination.phtml';
}else if($_GET['wyd']==1000){
    //Підключаємо фільтр
    $select_wyrobnyk = $Catalog -> select_wyrobnyk_prod_wyd($pdo,  $_GET['typ']);
    require 'app/view/catalog/sort_filtr.phtml';
    //Підключаємо class catalog
    require 'app/controller/catalog/get_limit_wyd.php';
    require 'app/view/catalog/products.phtml';
    require 'app/view/catalog/select_limit.phtml';
    
    if( ((isset($_SESSION['sort']))&&(!empty($_SESSION['sort'])))||
    ((isset($_SESSION['sex']))&&(!empty($_SESSION['sex'])))||
    ((isset($_SESSION['wyrob']))&&(!empty($_SESSION['wyrob'])))||
    ((isset($_SESSION['min']))&&(!empty($_SESSION['min'])))||
    ((isset($_SESSION['max']))&&(!empty($_SESSION['max'])))){
        $typ = $_GET['typ'];
        $wyd = $_GET['wyd'];
        $class = $_GET['class'];
        $limit = $limit_get;
        //******* Сортування ****************************************
            if($_SESSION['sort'] == 1){
                $sort = "Ocenka DESC";
            }else if($_SESSION['sort'] == 2){
                $sort = "cena_prod ASC";
            }else if($_SESSION['sort'] == 3){
                $sort = "cena_prod DESC";
            }else if($_SESSION['sort'] == 4){
                $sort = "name_prod ASC";
            }else if($_SESSION['sort'] == 5){
                $sort = "name_prod DESC";
            }else{
                $sort = "id_prod DESC";
            }
            //******* Стать ****************************************
            if($_SESSION['sex'] == 1){
                $sex = " = 1";
            }else if($_SESSION['sex'] == 2){
                $sex = " = 2";
            }else if($_SESSION['sex'] == 3){
                $sex = " = 3";
            }else if($_SESSION['sex'] == 4){
                $sex = " = 4";
            }else if($_SESSION['sex'] == 5){
                $sex = " = 5";
            }else{
                $sex = " IS NOT NULL";
            }
            
            $wyrob = $_SESSION['wyrob'];
            if(isset($_SESSION['min'])&&(empty($_SESSION['min']))){ $min = 0; }else{ $min = $_SESSION['min']; }
            if(isset($_SESSION['max'])&&(empty($_SESSION['max']))){ $max = 100000000; }else{ $max = $_SESSION['max']; }

        $posts = $Catalog -> select_filtr_prod_wyd_lim($pdo, $typ, $limit, $sex, $wyrob, $sort, $min, $max);
    }else{
        $posts = $Product -> select_posts_wyd($pdo, $_GET['typ'], $limit_get);
    }
    require 'app/view/catalog/pagination.phtml';
}else if($_GET['class']==1000){
    //Підключаємо фільтр
    $select_wyrobnyk = $Catalog -> select_wyrobnyk_prod_class($pdo,  $_GET['typ'], $_GET['wyd']);
    require 'app/view/catalog/sort_filtr.phtml';
    //Підключаємо class catalog
    require 'app/controller/catalog/get_limit_class.php';
    require 'app/view/catalog/products.phtml';
    require 'app/view/catalog/select_limit.phtml';
    
    if( ((isset($_SESSION['sort']))&&(!empty($_SESSION['sort'])))||
    ((isset($_SESSION['sex']))&&(!empty($_SESSION['sex'])))||
    ((isset($_SESSION['wyrob']))&&(!empty($_SESSION['wyrob'])))||
    ((isset($_SESSION['min']))&&(!empty($_SESSION['min'])))||
    ((isset($_SESSION['max']))&&(!empty($_SESSION['max'])))){
        $typ = $_GET['typ'];
        $wyd = $_GET['wyd'];
        $class = $_GET['class'];
        $limit = $limit_get;
        //******* Сортування ****************************************
            if($_SESSION['sort'] == 1){
                $sort = "Ocenka DESC";
            }else if($_SESSION['sort'] == 2){
                $sort = "cena_prod ASC";
            }else if($_SESSION['sort'] == 3){
                $sort = "cena_prod DESC";
            }else if($_SESSION['sort'] == 4){
                $sort = "name_prod ASC";
            }else if($_SESSION['sort'] == 5){
                $sort = "name_prod DESC";
            }else{
                $sort = "id_prod DESC";
            }
            //******* Стать ****************************************
            if($_SESSION['sex'] == 1){
                $sex = " = 1";
            }else if($_SESSION['sex'] == 2){
                $sex = " = 2";
            }else if($_SESSION['sex'] == 3){
                $sex = " = 3";
            }else if($_SESSION['sex'] == 4){
                $sex = " = 4";
            }else if($_SESSION['sex'] == 5){
                $sex = " = 5";
            }else{
                $sex = " IS NOT NULL";
            }
            
            $wyrob = $_SESSION['wyrob'];
            if(isset($_SESSION['min'])&&(empty($_SESSION['min']))){ $min = 0; }else{ $min = $_SESSION['min']; }
            if(isset($_SESSION['max'])&&(empty($_SESSION['max']))){ $max = 100000000; }else{ $max = $_SESSION['max']; }

        $posts = $Catalog -> select_filtr_prod_class_lim($pdo, $typ, $wyd, $limit, $sex, $wyrob, $sort, $min, $max);
    }else{
        $posts = $Product -> select_posts_class($pdo, $_GET['typ'], $_GET['wyd'], $limit_get);
    }
    
    require 'app/view/catalog/pagination.phtml';
}else if(isset($_GET['poszuk'])){
    require 'app/view/catalog/products.phtml';
}else{
    require 'app/view/404.phtml';
}

//Підключаємо Footer
require 'app/view/footer.phtml';