<?php


    if((isset($_SESSION['adm']))&&(!empty($_SESSION['adm']))){
        if($_SESSION['adm']>0){
            
            require 'app/view/Falcon/header.phtml';
            
            require 'app/view/Falcon/menu.phtml';
            
            if(isset($_GET['window'])){
                if($_GET['window'] == 1){
                
                    if(!isset($_GET['menu'])){
                        $menu = 0;
                    }else{
                        $menu = $_GET['menu'];
                    }

                    switch ($menu) {
                      case 0:
                        require 'app/view/Falcon/typ.phtml';
                        break;
                      case 1:
                        require 'app/view/Falcon/wyd.phtml';
                        break;
                      case 2:
                        require 'app/view/Falcon/class.phtml';
                        break;
                      case 3:
                        require 'app/view/Falcon/sklad_char_img.phtml';
                        break;
                      case 4:
                        require 'app/view/Falcon/window_add_prod.phtml';
                        break;
                      default:
                        echo "Не правельно заданий параметр";
                    }

                }else if($_GET['window'] == 2){
                    if((!isset($_GET['id']))||($_GET['id']==0)){
                        require 'app/view/Falcon/zamowienia.phtml';
                    }else{
                        require 'app/view/Falcon/details_zam.phtml';
                    }

                }
            
            }
            
            
            
        
        
        
        
        }else{
            header('Location: ?controller=Falcon&action=index');
            exit;
        }
    }else{
        header('Location: ?controller=Falcon&action=index');
        exit;
    }


require 'app/view/footer.phtml';