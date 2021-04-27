<?php
// Підключення файлу config.php для підключення до бази данних
require 'app/config.php';

// Визначення часового поясу за UTC
date_default_timezone_set('UTC');

// Підключамо сесію
session_start();
if(!isset($_SESSION['n_zam'])){
    $_SESSION['n_zam']=0;
}


// Підключаємо класи з функціями
require 'app/model/annou.php';
require 'app/model/catalog.php';
require 'app/model/product.php';
require 'app/model/zamowienia.php';
require 'app/model/postaczalnyk.php';
require 'app/model/function.php';
require 'app/model/admin.php';
require 'app/model/koment.php';