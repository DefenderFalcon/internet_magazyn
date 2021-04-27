<?php
    $adm = $Admin -> select_id_prod($pdo);
    foreach($adm as $adm){
       $id = $adm['id_prod'];
    }
    
    $id = $id + 1;
    echo $id;
    

    $kod        = test_input($_POST['kod']);
    $name       = test_input($_POST['name']);
    $cena       = test_input($_POST['cena']);
    $typ        = test_input($_POST['typ']);
    $wyd        = test_input($_POST['wyd']);
    $class      = test_input($_POST['class']);
    $ocenka     = test_input($_POST['ocenka']);
    $sex        = test_input($_POST['sex']);
    $wyrob      = test_input($_POST['wyrob']);
    $postacz    = test_input($_POST['postacz']);
    $opis       = $_POST['opis'];
    $group      = test_input($_POST['group']);
    $color      = test_input($_POST['color']);

    
    for($key=0;$key<$_POST['n_img'];$key++){
        // если была произведена отправка формы
        if(isset($_FILES['img'])) {
          // проверяем, можно ли загружать изображение
          $check = can_upload($_FILES['img'],$key);

          if($check === true){
            // загружаем изображение на сервер
            $img = make_upload($_FILES['img'],$key,$typ,$wyd,$class,$id);
            echo "<strong>Файл успешно загружен!</strong>";
          }
          else{
            // выводим сообщение об ошибке
            echo "<strong>$check</strong>";  
          }
        }
        
        $adm = $Admin -> insert_prod_img($pdo,$id,$img,$name);
        
        if($key==0){
            $adm = $Admin -> insert_prod($pdo,$id,$kod,$name,$img,$cena,$typ,$wyd,$class,$ocenka,$sex,$wyrob,$postacz,$group,$color);
            
            $adm = $Admin -> insert_prod_opis($pdo,$id,$opis);
            
            for($i=0;$i<$_POST['n_skl'];$i++){
                $dane_s    = test_input($_POST['sklad_'.$i]);
                $adm = $Admin -> insert_prod_sklad($pdo, $id, $dane_s);
            }
            for($i=0;$i<$_POST['n_c'];$i++){
                $name_char    = test_input($_POST['n_char_'.$i]);
                $dane_char    = test_input($_POST['d_char_'.$i]);
                $adm = $Admin -> insert_prod_char($pdo, $id, $name_char, $dane_char);
            }
            for($i=1;$i<=$_POST['n_r'];$i++){
                $name_char    = 'Розмір';
                $dane_char    = test_input($_POST['d_char_r'.$i]);
                $adm = $Admin -> insert_prod_char($pdo, $id, $name_char, $dane_char);
            }

        }
        
    }
    
    header('Location: ?controller=Falcon&action=zalogowany&window=1');
    exit;
    
    
    

    
    function can_upload($file, $key){
        // если имя пустое, значит файл не выбран
        if($file['name'][$key] == '')
            return 'Вы не выбрали файл.';

        /* если размер файла 0, значит его не пропустили настройки 
        сервера из-за того, что он слишком большой */
        if($file['size'][$key] == 0)
            return 'Файл слишком большой.';

        // разбиваем имя файла по точке и получаем массив
        $getMime = explode('.', $file['name'][$key]);
        // нас интересует последний элемент массива - расширение
        $mime = strtolower(end($getMime));
        // объявим массив допустимых расширений
        $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

        // если расширение не входит в список допустимых - return
        if(!in_array($mime, $types))
            return 'Недопустимый тип файла.';

        return true;
  }
  
  function make_upload($file,$key,$typ,$wyd,$class,$id){	
        // разбиваем имя файла по точке и получаем массив
        $getMime = explode('.', $file['name'][$key]);
        // нас интересует последний элемент массива - расширение
        $mime = strtolower(end($getMime));
        // формируем уникальное имя картинки: случайное число и name
        $name = $typ.'_'.$wyd.'_'.$class.'_'.$id.'_'.$key.'.'.$mime;
        $dir = $URL.'app/view/images/img_prod/' . $name;
        copy($file['tmp_name'][$key], $dir);
        return $dir;
  }

