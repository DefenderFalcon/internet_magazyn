<?php 

class Admin{
    
    public function select_adm($pdo){
        
        $statement = $pdo -> prepare("SELECT * FROM admin");
        $statement -> execute();
        $adm = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $adm;
    }
    public function select_id_prod($pdo){
        
        $statement = $pdo -> prepare("SELECT id_prod FROM product");
        $statement -> execute();
        $adm = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $adm;
    }
    public function insert_prod($pdo,$id,$kod,$name,$img,$cena,$typ,$wyd,$class,$ocenka,$sex,$wyrob,$postacz,$group,$color){
        
        $statement = $pdo -> prepare("INSERT INTO `product`
        (`id_prod`, `kod_prod`, `name_prod`, `img_prod`, `cena_prod`, `id_typ`, `id_wyd`, `id_class`, `ocenka`, `prod_sex`, `prod_wyrob`, `postaczalnyk`, `color_group`, `color`) 
        VALUES (:id,:kod,:name,:img,:cena,:typ,:wyd,:class,:ocenka,:sex,:wyrob,:postacz,:group,:color)");
        
        $statement -> bindValue(":id", $id, PDO::PARAM_INT);
        $statement -> bindParam(":kod", $kod, PDO::PARAM_STR);
        $statement -> bindParam(":name", $name, PDO::PARAM_STR);
        $statement -> bindParam(":img", $img, PDO::PARAM_STR);
        $statement -> bindValue(":cena", $cena, PDO::PARAM_INT);
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> bindValue(":class", $class, PDO::PARAM_INT);
        $statement -> bindValue(":ocenka", $ocenka, PDO::PARAM_INT);
        $statement -> bindValue(":sex", $sex, PDO::PARAM_INT);
        $statement -> bindParam(":wyrob", $wyrob, PDO::PARAM_STR);
        $statement -> bindParam(":postacz", $postacz, PDO::PARAM_STR);
        $statement -> bindParam(":group", $group, PDO::PARAM_STR);
        $statement -> bindParam(":color", $color, PDO::PARAM_STR);
        $statement -> execute();
    }
    public function insert_prod_img($pdo,$id,$img,$name){
        
        $statement = $pdo -> prepare("INSERT INTO `prod_image`(`id_prod`, `img_prod`, `img_title`) VALUES (:id, :img, :name)");
        
        $statement -> bindValue(":id", $id, PDO::PARAM_INT);
        $statement -> bindParam(":name", $name, PDO::PARAM_STR);
        $statement -> bindParam(":img", $img, PDO::PARAM_STR);

        $statement -> execute();
    }
    public function insert_prod_opis($pdo,$id,$opis){
        
        $statement = $pdo -> prepare("INSERT INTO `prod_dane`(`id_prod`, `prod_opis`) VALUES (:id,:opis)");
        
        $statement -> bindValue(":id", $id, PDO::PARAM_INT);
        $statement -> bindParam(":opis", $opis, PDO::PARAM_STR);

        $statement -> execute();
    }
    public function insert_prod_char($pdo, $id, $name_char, $dane_char){
        
        $statement = $pdo -> prepare("INSERT INTO `prod_charak`(`id_prod`, `name_char`, `dane_char`) VALUES (:id, :name_char, :dane_char)");
        
        $statement -> bindValue(":id", $id, PDO::PARAM_INT);
        $statement -> bindParam(":name_char", $name_char, PDO::PARAM_STR);
        $statement -> bindParam(":dane_char", $dane_char, PDO::PARAM_STR);

        $statement -> execute();
    }
    public function insert_prod_sklad($pdo, $id, $dane_s){
        
        $statement = $pdo -> prepare("INSERT INTO `prod_sklad`(`id_prod`, `dane_sklad`) VALUES (:id, :dane)");
        
        $statement -> bindValue(":id", $id, PDO::PARAM_INT);
        $statement -> bindParam(":dane", $dane_s, PDO::PARAM_STR);

        $statement -> execute();
    }
    
    public function select_typ($pdo){
        
        $statement = $pdo -> prepare("SELECT * FROM typ");
        $statement -> execute();
        $adm = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $adm;
    }
    public function select_wyd($pdo,$typ){
        
        $statement = $pdo -> prepare("SELECT * FROM wyd WHERE id_typ = :typ");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> execute();
        $adm = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $adm;
    }
    public function select_class($pdo,$typ,$wyd){
        
        $statement = $pdo -> prepare("SELECT * FROM class WHERE id_typ = :typ and id_wyd = :wyd");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> execute();
        $adm = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $adm;
    }
    public function select_errors($pdo){
        
        $statement = $pdo -> prepare("SELECT * FROM errors");
        $statement -> execute();
        $adm = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $adm;
    }
    public function select_error_panel($pdo){
        
        $statement = $pdo -> prepare("SELECT * FROM error_panel");
        $statement -> execute();
        $adm = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $adm;
    }
        public function select_adm_id($pdo, $id){
        
        $statement = $pdo -> prepare("SELECT * FROM dane_adm WHERE id_adm = :id");
        $statement -> bindValue(":id", $id, PDO::PARAM_INT);
        $statement -> execute();
        $adm = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $adm;
    }
    
}

$Admin = new Admin();