<?php

$kom_id     =   $_POST['id_kom'];
$kom_name   =   $_POST['name_kom'];
$ans_name   =   test_input($_POST['name_ans']);
$ans_text   =   test_input($_POST['text_ans']);
$ans_text   =   $kom_name.": ".$ans_text;

$insert_ans = $Koment -> insert_ans($pdo, $kom_id, $ans_name, $ans_text);

header('Location: ?controller=product&action=index&typ='. $_GET['typ'] .'&wyd='. $_GET['wyd'] .'&class='. $_GET['class'] .'&prod='. $_GET['prod'] .'');
exit();