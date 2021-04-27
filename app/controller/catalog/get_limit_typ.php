<?php

if(isset($_POST['limit'])){
    $_GET['limit']=$_POST['limit'];
}
if(isset($_POST['start'])){
    $_GET['start']=$_POST['start'];
}

if((isset($_GET['limit']))&&($_GET['limit']>0)){
    $limit_get = (int) $_GET['limit'];
}else{
    $limit_get = 30;
}

if((isset($_GET['start']))&&($_GET['start']>0)){
    $start_but = (int) $_GET['start'];
    $start = ($start_but-1)*$limit_get;
}else{
    $start_but = 1;
    $start = 0;
}

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
if((isset($_GET['start']))&&($_GET['start']>$posts)){
    $start_but = $posts;
    $start = ($start_but-1)*$limit_get;
}