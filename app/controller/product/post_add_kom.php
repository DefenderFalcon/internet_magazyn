<?php

$tow    =   $_POST['id_prod'];
$name   =   test_input($_POST['name']);
$text   =   test_input($_POST['text']);

$insert_kom = $Koment -> insert_kom($pdo, $name, $text, $tow);

header('Location: ?controller=product&action=index&typ='. $_GET['typ'] .'&wyd='. $_GET['wyd'] .'&class='. $_GET['class'] .'&prod='. $_GET['prod'] .'');
exit();