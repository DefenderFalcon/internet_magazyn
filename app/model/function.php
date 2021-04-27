<?php

// функції кошика ************************************************

if((isset($_POST['kupytu']))){
    $_SESSION['n_zam']++;
    if(!isset($_SESSION['n_k'])){
        $_SESSION['n_k'] = 1;
    }else{
        $_SESSION['n_k']++;
    }
    
    
    if(!isset($_POST['color'])){$_POST['color']='null';}
    if(!isset($_POST['rozmir'])){$_POST['rozmir']='null';}
    if(!isset($_POST['kilkist'])){$_POST['kilkist']='null';}
    
    $_SESSION['id_tow'][$_SESSION['n_zam']]     =   $_POST['id_tow'];
    $_SESSION['rozmir'][$_SESSION['n_zam']]     =   $_POST['rozmir'];
    $_SESSION['kilkist'][$_SESSION['n_zam']]    =   $_POST['kilkist']; 
    
    header('Location: ?controller=catalog&action=index&typ='.$_GET['typ'].'&wyd='.$_GET['wyd'].'&class='.$_GET['class']);
    exit;
}

if((isset($_POST['delet_zam']))&&(!empty($_POST['delet_zam']))){
    if(!isset( $_SESSION['del'])){
        $_SESSION['del'] = 0;
    }
    $_SESSION['del']++;
    $_SESSION['n_k'] = $_SESSION['n_zam']-$_SESSION['del'];
    $_SESSION['id_tow'][$_POST['delet_zam']]     =   'NULL';
    $_SESSION['color'][$_POST['delet_zam']]      =   'NULL';
    $_SESSION['rozmir'][$_POST['delet_zam']]     =   'NULL';
    $_SESSION['kilkist'][$_POST['delet_zam']]    =   'NULL';
    
}

 

if(isset($_POST['buy_zam_ukr'])){
    
    $surname = test_input($_POST['surname']);
    $name = test_input($_POST['name']);
    $batkowi = test_input($_POST['po_batkowi']);
    $telefon = test_input($_POST['telefon']);
    $sp_oplata = test_input($_POST['sp_opl']);
    if(isset($_POST['email'])){
        $email = test_input($_POST['email']);
    }else{
        $email = '';
    }
    
    $suma = 0;
    for($i=1;$i<=$_SESSION['n_zam'];$i++){
        $id_prod = test_input($_SESSION['id_tow'][$i]);
        $kilkist = test_input($_SESSION['kilkist'][$i]);
        
        $sel_cena = $Product -> select_cena($pdo, $id_prod);
        foreach($sel_cena as $cen){
            $cena = $cen['cena_prod'] * $kilkist;
        }
        $suma = $cena + $suma;
    }
    $_SESSION['suma'] = $suma;
    $baly = $suma * 0.02;
    
    $insert_zam = $Zamowienia -> craete_zam($pdo, $surname, $name, $batkowi, $telefon, $email, $suma, $sp_oplata);
    
    
    
    $k=0;
    $klient = $Zamowienia -> select_klient($pdo);
    foreach($klient as $kl){
        if($kl['telefon'] == $telefon){
            $k=1;
            $baly = $baly + $kl['baly'];
            $id_klient = $kl['id_klient'];
        }
    }
    if($k == 0){
        $insert_kli = $Zamowienia -> klient($pdo, $surname, $name, $batkowi, $telefon, $baly);
    }else{
        
        $update_kli = $Zamowienia -> update_klient($pdo, $id_klient, $baly);
    }
    
    $oblast = test_input($_POST['oblast']);
    $rajon = test_input($_POST['rajon']);
    $nas_punkt = test_input($_POST['nas_punkt']);
    $P_I = test_input($_POST['p_i']);
    $id_zamow = $Zamowienia -> select_lin_zam($pdo);
    foreach($id_zamow as $id){
        $id_zam = $id['id_zam'];
    }
    
    $insert_zam_ukr = $Zamowienia -> craete_zam_ukr($pdo, $id_zam, $oblast, $rajon, $nas_punkt, $P_I);
    
    for($i=1;$i<=$_SESSION['n_zam'];$i++){
        $id_prod = test_input($_SESSION['id_tow'][$i]);
        $rozmir = test_input($_SESSION['rozmir'][$i]);
        $kilkist = test_input($_SESSION['kilkist'][$i]);

        $insert_zam = $Zamowienia -> craete_zam_tow($pdo, $id_zam, $id_prod, $rozmir, $kilkist);
    }
    
    $to      = 'defenderfalcon@krystynopil.biz.ua';
    $subject = 'Нове замовлення';
    $message = 'ІД: '.$id_zam.' Замовлення від '.$surname.' '.$name.' на суму '.$suma.'';
    $headers = array(
            'From' => 'klient@krystynopil.biz.ua',
            'Reply-To' => 'klient@krystynopil.biz.ua',
            'Content-type' => 'text/html; charset=utf-8',
            'X-Mailer' => 'PHP/' . phpversion()
        );

    mail($to, $subject, $message, $headers);
    
    if(isset($_POST['email'])){
        
        $to      = $_POST['email'];
        $subject = 'Замовлення в інтернет-магазині "Кристинопіль"';
        $message = 'ІД замовлення: <b>'.$id_zam.'</b> Вітаю <b>'.$surname.' '.$name.'</b> <br>Ви успішно залишили своє замовлення на суму <b>'.$suma.'</b> Ваше замовлення чекає на підтвердження. Дочекайтеся коли наш адміністратор звяжеться з Вами для підтвердження данних замовлення.<br> <br>Дякуємо що обрали нас!';
        $headers = array(
                'From' => 'defenderfalcon@krystynopil.biz.ua',
                'Reply-To' => 'defenderfalcon@krystynopil.biz.ua',
                'Content-type' => 'text/html; charset=utf-8',
                'X-Mailer' => 'PHP/' . phpversion()
            );

        mail($to, $subject, $message, $headers);
    }
    
    $_SESSION['n_zam'] = $_SESSION['n_k'] = 0;
    header('Location: ?controller=koszyk&action=usp_zam');
    exit;
}else if(isset($_POST['buy_zam_np'])){
    
    $surname = test_input($_POST['surname']);
    $name = test_input($_POST['name']);
    $batkowi = 'NULL';
    $telefon = test_input($_POST['telefon']);
    $sp_oplata = test_input($_POST['sp_opl']);
    if(isset($_POST['email'])){
        $email = test_input($_POST['email']);
    }else{
        $email = '';
    }
    
    $suma = 0;
    for($i=1;$i<=$_SESSION['n_zam'];$i++){
        $id_prod = test_input($_SESSION['id_tow'][$i]);
        $kilkist = test_input($_SESSION['kilkist'][$i]);
        
        $sel_cena = $Product -> select_cena($pdo, $id_prod);
        foreach($sel_cena as $cen){
            $cena = $cen['cena_prod'] * $kilkist;
        }
        $suma = $cena + $suma;
    }
    $_SESSION['suma'] = $suma;
    $baly = $suma * 0.02;
    
    $insert_zam = $Zamowienia -> craete_zam($pdo, $surname, $name, $batkowi, $telefon, $email, $suma, $sp_oplata);
    
    $k = 0;
    $klient = $Zamowienia -> select_klient($pdo);
    foreach($klient as $kl){
        if($kl['telefon'] == $telefon){
            $k=1;
            $baly = $baly + $kl['baly'];
            $id_klient = $kl['id_klient'];
        }
    }
    if($k == 0){
        $insert_kli = $Zamowienia -> klient($pdo, $surname, $name, $batkowi, $telefon, $baly);
    }else{
        
        $update_kli = $Zamowienia -> update_klient($pdo, $id_klient, $baly);
    }
    
    $oblast = test_input($_POST['oblast']);
    $nas_punkt = test_input($_POST['nas_punkt']);
    $widdil = test_input($_POST['widilenia']);
    $id_zamow = $Zamowienia -> select_lin_zam($pdo);
    foreach($id_zamow as $id){
        $id_zam = $id['id_zam'];
    }
    
    $insert_zam_np = $Zamowienia -> craete_zam_np($pdo, $id_zam, $oblast, $nas_punkt, $widdil);
    
    for($i=1;$i<=$_SESSION['n_zam'];$i++){
        $id_prod = test_input($_SESSION['id_tow'][$i]);
        $rozmir = test_input($_SESSION['rozmir'][$i]);
        $kilkist = test_input($_SESSION['kilkist'][$i]);

        $insert_zam = $Zamowienia -> craete_zam_tow($pdo, $id_zam, $id_prod, $rozmir, $kilkist);
    }
    
    $to      = 'defenderfalcon@krystynopil.biz.ua';
    $subject = 'Нове замовлення';
    $message = 'ІД: '.$id_zam.' Замовлення від '.$surname.' '.$name.' на суму '.$suma.'';
    $headers = array(
            'From' => 'klient@krystynopil.biz.ua',
            'Reply-To' => 'klient@krystynopil.biz.ua',
            'Content-type' => 'text/html; charset=utf-8',
            'X-Mailer' => 'PHP/' . phpversion()
        );

    mail($to, $subject, $message, $headers);
    
    if(isset($_POST['email'])){
        
        $to      = $_POST['email'];
        $subject = 'Замовлення в інтернет-магазині "Кристинопіль"';
        $message = 'ІД замовлення: <b>'.$id_zam.'</b> Вітаю <b>'.$surname.' '.$name.'</b> <br>Ви успішно залишили своє замовлення на суму <b>'.$suma.'</b> Ваше замовлення чекає на підтвердження. Дочекайтеся коли наш адміністратор звяжеться з Вами для підтвердження данних замовлення.<br> <br>Дякуємо що обрали нас!';
        $headers = array(
                'From' => 'defenderfalcon@krystynopil.biz.ua',
                'Reply-To' => 'defenderfalcon@krystynopil.biz.ua',
                'Content-type' => 'text/html; charset=utf-8',
                'X-Mailer' => 'PHP/' . phpversion()
            );

        mail($to, $subject, $message, $headers);
    }
    
    
    
    $_SESSION['n_zam'] = $_SESSION['n_k'] = 0;
    header('Location: ?controller=koszyk&action=usp_zam');
    exit;
}

// Перевірка рядків вводу

function test_input($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    
    return $input;
}