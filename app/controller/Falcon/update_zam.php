<?php

    if(isset($_POST['update'])){
        $id_zam             = $_POST['id_zam'];
        $id_prac            = $_POST['id_prac'];
        $i                  = $_POST['k_tow'];
        $surname            = test_input($_POST['surname']);
        $name               = test_input($_POST['name']);
        $batkowi            = test_input($_POST['po_bat']);
        $tel                = test_input($_POST['tel']);
        $email              = test_input($_POST['email']);
        $status             = test_input($_POST['status']);
        $suma = 0;
        
        
        
        
        for($j=1;$j<=$i;$j++){
            $id_tow         = test_input($_POST['id_tow_'.$j]);
            $rozmir         = test_input($_POST['rozmir_'.$j]);
            $kilkist        = test_input($_POST['kilkist_'.$j]);
            $cena           = test_input($_POST['cena_'.$j]);
            
            $suma = ($cena * $kilkist) + $suma;
            
            $Zamowienia -> update_zam_tow($pdo,$id_zam,$id_tow,$rozmir,$kilkist);
        }
        
        $Zamowienia -> update_zam($pdo,$id_zam,$surname,$name,$batkowi,$tel,$email,$status,$suma,$id_prac);
        
        
        if((isset($_POST['p_i']))&&(!empty($_POST['p_i']))){
            $pi                 = test_input($_POST['p_i']);
            $rajon              = test_input($_POST['rajon_ukr']);
            $oblast             = test_input($_POST['oblast_ukr']);
            $nas_punkt          = test_input($_POST['nas_punkt_ukr']);
            
            $n = 0;
            $select_ukr_zam = $Zamowienia -> select_zam_ukr($pdo, $id_zam);
            foreach($select_ukr_zam as $sel_u_z){ 
                $n++;
            }
            
            if($n==0){
                $Zamowienia -> craete_zam_ukr($pdo, $id_zam, $oblast, $rajon, $nas_punkt, $pi);
                $Zamowienia -> delit_zam_np($pdo,$id_zam);
            }else{
                $Zamowienia -> update_zam_ukr($pdo,$id_zam,$oblast,$rajon,$nas_punkt,$pi);
            }

        }else{
            $oblast             = test_input($_POST['oblast']);
            $nas_punkt          = test_input($_POST['nas_punkt']);
            $widdil             = test_input($_POST['widdil_np']);
            
            $n = 0;
            $select_np_zam = $Zamowienia -> select_zam_np($pdo, $id_zam);
            foreach($select_np_zam as $sel_n_z){
                $n++;
            }
            
            if($n==0){
                $Zamowienia -> craete_zam_np($pdo, $id_zam, $oblast, $nas_punkt, $widdil);
                $Zamowienia -> delit_zam_ukr($pdo,$id_zam);
            }else{
                $Zamowienia -> update_zam_np($pdo,$id_zam,$oblast,$nas_punkt,$widdil);
            }
            
        }
        
        header('Location: ?controller=Falcon&action=zalogowany&window=2&id='.$id_zam);
        exit;
        
    }else if(isset($_POST['del_tow'])){
        
        
        $Zamowienia -> delit_zam_tow($pdo,$_POST['del_id_zam'],$_POST['del_tow'],$_POST['rozmir'],$_POST['kilkist']);
        header('Location: ?controller=Falcon&action=zalogowany&window=2&id='.$_POST['del_id_zam']);
        exit;
    }else if(isset($_POST['delet_zam'])){
        $id_zam             = $_POST['id_zam'];
        
        $Zamowienia -> delit_zam_ukr($pdo,$id_zam);
        $Zamowienia -> delit_zam_np($pdo,$id_zam);
        $Zamowienia -> delit_zam($pdo,$id_zam);
        $Zamowienia -> delit_zam_tow_ol($pdo,$id_zam);
        
        
        
        header('Location: ?controller=Falcon&action=zalogowany&window=2');
        exit;
    }