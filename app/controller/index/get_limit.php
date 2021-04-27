<?php

if((isset($_GET['limit']))&&($_GET['limit']>0)){
    $limit_get = (int) $_GET['limit'];
}else{
    $limit_get = 3;
}

if((isset($_GET['start']))&&($_GET['start']>0)){
    $start_but = (int) $_GET['start'];
    $start = ($start_but-1)*$limit_get;
}else{
    $start_but = 1;
    $start = 0;
}

$posts = $Annou -> select_posts($pdo, $limit_get);

if((isset($_GET['start']))&&($_GET['start']>$posts)){
    $start_but = $posts;
    $start = ($start_but-1)*$limit_get;
}