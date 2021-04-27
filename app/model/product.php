<?php

class Product{
    
    public function select_prod($pdo, $prod){
        
        $statement = $pdo -> prepare("SELECT * FROM product WHERE id_prod = :prod ");
        $statement -> bindValue(":prod", $prod, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_dane_prod($pdo, $prod){
        
        $statement = $pdo -> prepare("SELECT * FROM prod_dane WHERE id_prod = :prod ORDER BY id_dane ASC");
        $statement -> bindValue(":prod", $prod, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_char_prod($pdo, $prod){
        
        $statement = $pdo -> prepare("SELECT * FROM prod_charak WHERE id_prod = :prod ORDER BY id_char ASC");
        $statement -> bindValue(":prod", $prod, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_sklad_prod($pdo, $prod){
        
        $statement = $pdo -> prepare("SELECT * FROM prod_sklad WHERE id_prod = :prod ");
        $statement -> bindValue(":prod", $prod, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_img_prod($pdo, $prod){
        
        $statement = $pdo -> prepare("SELECT * FROM product WHERE id_prod = :prod ORDER BY id_img ASC");
        $statement -> bindValue(":prod", $prod, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_wsi_tow($pdo, $limit, $start){
        
        $statement = $pdo -> prepare("SELECT * FROM product ORDER BY id_prod DESC LIMIT :start, :limit");
        $statement -> bindValue(":start", $start, PDO::PARAM_INT);
        $statement -> bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_wyd_tow($pdo, $typ, $limit, $start){
        
        $statement = $pdo -> prepare("SELECT * FROM product WHERE id_typ = :typ ORDER BY id_prod DESC LIMIT :start, :limit");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":start", $start, PDO::PARAM_INT);
        $statement -> bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_roz_tow($pdo, $typ, $wyd, $limit, $start){
        
        $statement = $pdo -> prepare("SELECT * FROM product WHERE id_typ = :typ and id_wyd = :wyd ORDER BY id_prod DESC LIMIT :start, :limit");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> bindValue(":start", $start, PDO::PARAM_INT);
        $statement -> bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_posts_typ($pdo, $limit){
        
        $statement = $pdo -> prepare("SELECT id_prod FROM product");
        $statement -> execute();
        $num = $statement -> rowCount();
        
        $posts = intval(($num - 1) / $limit) + 1;

        return $posts;
    }
    public function select_posts_wyd($pdo, $typ, $limit){
        
        $statement = $pdo -> prepare("SELECT id_prod FROM product WHERE id_typ = :typ ");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> rowCount();
        
        $posts = intval(($num - 1) / $limit) + 1;

        return $posts;
    }
    public function select_posts_class($pdo, $typ, $wyd, $limit){
        
        $statement = $pdo -> prepare("SELECT id_prod FROM product WHERE id_typ = :typ and id_wyd = :wyd");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> rowCount();
        
        $posts = intval(($num - 1) / $limit) + 1;

        return $posts;
    }
    public function select_wyrobnyk($pdo){
        
        $statement = $pdo -> prepare("SELECT id_prod FROM product WHERE id_typ = :typ and id_wyd = :wyd");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> rowCount();
        
        $posts = intval(($num - 1) / $limit) + 1;

        return $posts;
    }
    public function select_imgs_prod($pdo, $id){
        
        $statement = $pdo -> prepare("SELECT * FROM prod_image WHERE id_prod = :id ORDER BY id_img ASC");
        $statement -> bindValue(":id", $id, PDO::PARAM_INT);
        $statement -> execute();
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_prod_color($pdo, $group){
        
        $statement = $pdo -> prepare("SELECT * FROM product WHERE color_group = :group ");
        $statement -> bindValue(":group", $group, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_cena($pdo, $prod){
        
        $statement = $pdo -> prepare("SELECT cena_prod FROM product WHERE id_prod = :prod ");
        $statement -> bindValue(":prod", $prod, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    
}

$Product = new Product();