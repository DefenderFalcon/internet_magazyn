<?php 

class Catalog{
    
    public function select_typ($pdo){
        
        $statement = $pdo -> prepare("SELECT * FROM typ ORDER BY id_typ ASC");
        $statement -> execute();
        $typ = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $typ;
    }
    public function select_wyd($pdo, $typ){
        
        $statement = $pdo -> prepare("SELECT * FROM wyd WHERE id_typ = :typ ORDER BY id_wyd ASC");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> execute();
        $wyd = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $wyd;
    }
    public function select_class($pdo, $typ, $wyd){
        
        $statement = $pdo -> prepare("SELECT * FROM class WHERE id_typ = :typ and id_wyd = :wyd ORDER BY sort ASC");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> execute();
        $class = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $class;
    }
    public function select_products($pdo, $typ, $wyd, $class, $limit, $start){
        
        $statement = $pdo -> prepare("SELECT * FROM product WHERE id_typ = :typ and id_wyd = :wyd and id_class = :class ORDER BY id_prod DESC LIMIT :start, :limit");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> bindValue(":class", $class, PDO::PARAM_INT);
        $statement -> bindValue(":start", $start, PDO::PARAM_INT);
        $statement -> bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_posts($pdo, $limit, $typ, $wyd, $class){
        
        $statement = $pdo -> prepare("SELECT id_prod FROM product WHERE id_typ = :typ and id_wyd = :wyd and id_class = :class ");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> bindValue(":class", $class, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> rowCount();
        
        $posts = intval(($num - 1) / $limit) + 1;

        return $posts;
    }
    
    // Функція Пошуку   ************************************************************************
    public function select_products_poszuk($pdo, $poszuk){
        
        $statement = $pdo -> prepare("SELECT * FROM product WHERE name_prod LIKE '%".$poszuk."%' ");
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    
    // Функції сортування   ************************************************************************
    public function select_products_sort_name($pdo, $typ, $wyd, $class, $limit, $start, $sort){
        
        $statement = $pdo -> prepare("SELECT * FROM product WHERE id_typ = :typ and id_wyd = :wyd and id_class = :class ORDER BY name_prod ".$sort." LIMIT :start, :limit");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> bindValue(":class", $class, PDO::PARAM_INT);
        $statement -> bindValue(":start", $start, PDO::PARAM_INT);
        $statement -> bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_products_sort_cena($pdo, $typ, $wyd, $class, $limit, $start, $sort){
        
        $statement = $pdo -> prepare("SELECT * FROM product WHERE id_typ = :typ and id_wyd = :wyd and id_class = :class ORDER BY cena_prod ".$sort." LIMIT :start, :limit");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> bindValue(":class", $class, PDO::PARAM_INT);
        $statement -> bindValue(":start", $start, PDO::PARAM_INT);
        $statement -> bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    public function select_products_sort_ocenka($pdo, $typ, $wyd, $class, $limit, $start, $sort){
        
        $statement = $pdo -> prepare("SELECT * FROM product WHERE id_typ = :typ and id_wyd = :wyd and id_class = :class ORDER BY Ocenka ".$sort." LIMIT :start, :limit");
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> bindValue(":class", $class, PDO::PARAM_INT);
        $statement -> bindValue(":start", $start, PDO::PARAM_INT);
        $statement -> bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement -> execute();
        $prod = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $prod;
    }
    
    // Функції фільтрування   ************************************************************************
    
    public function select_wyrobnyk_prod($pdo, $typ, $wyd, $class){
        
        $statement = $pdo -> prepare("SELECT prod_charak.dane_char FROM prod_charak 
                                        INNER JOIN product 
                                        ON prod_charak.id_prod = product.id_prod 
                                        WHERE product.id_typ = :typ 
                                        and product.id_wyd = :wyd 
                                        and product.id_class = :class 
                                        and prod_charak.name_char = 'Виробник' 
                                        GROUP BY prod_charak.dane_char;");
        
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> bindValue(":class", $class, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $num;
    }
    public function select_wyrobnyk_prod_typ($pdo){
        
        $statement = $pdo -> prepare("SELECT prod_charak.dane_char FROM prod_charak 
                                        INNER JOIN product 
                                        ON prod_charak.id_prod = product.id_prod 
                                        WHERE prod_charak.name_char = 'Виробник' 
                                        GROUP BY prod_charak.dane_char;");
        
        $statement -> execute();
        $num = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $num;
    }
    public function select_wyrobnyk_prod_wyd($pdo, $typ){
        
        $statement = $pdo -> prepare("SELECT prod_charak.dane_char FROM prod_charak 
                                        INNER JOIN product 
                                        ON prod_charak.id_prod = product.id_prod 
                                        WHERE product.id_typ = :typ 
                                        and prod_charak.name_char = 'Виробник' 
                                        GROUP BY prod_charak.dane_char;");
        
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);

        $statement -> execute();
        $num = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $num;
    }
    public function select_wyrobnyk_prod_class($pdo, $typ, $wyd){
        
        $statement = $pdo -> prepare("SELECT prod_charak.dane_char FROM prod_charak 
                                        INNER JOIN product 
                                        ON prod_charak.id_prod = product.id_prod 
                                        WHERE product.id_typ = :typ 
                                        and product.id_wyd = :wyd 
                                        and prod_charak.name_char = 'Виробник' 
                                        GROUP BY prod_charak.dane_char;");
        
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);

        $statement -> execute();
        $num = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $num;
    }
    public function select_filtr_prod($pdo, $typ, $wyd, $class, $limit, $start, $sex, $wyrob, $sort, $min, $max){
        
        $statement = $pdo -> prepare("SELECT * FROM product 
                                                            WHERE id_typ = :typ 
                                                            and id_wyd = :wyd 
                                                            and id_class = :class 
                                                            and prod_sex ".$sex."
                                                            and prod_wyrob ".$wyrob."
                                                            and cena_prod BETWEEN :min AND :max
                                                            ORDER BY ".$sort." 
                                                            LIMIT :start, :limit");
        
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> bindValue(":class", $class, PDO::PARAM_INT);
        $statement -> bindValue(":start", $start, PDO::PARAM_INT);
        $statement -> bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement -> bindValue(":min", $min, PDO::PARAM_INT);
        $statement -> bindValue(":max", $max, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $num;
    }
    public function select_filtr_prod_typ($pdo, $limit, $start, $sex, $wyrob, $sort, $min, $max){
        
        $statement = $pdo -> prepare("SELECT * FROM product 
                                                            WHERE prod_sex ".$sex."
                                                            and prod_wyrob ".$wyrob."
                                                            and cena_prod BETWEEN :min AND :max
                                                            ORDER BY ".$sort." 
                                                            LIMIT :start, :limit");
        
        $statement -> bindValue(":start", $start, PDO::PARAM_INT);
        $statement -> bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement -> bindValue(":min", $min, PDO::PARAM_INT);
        $statement -> bindValue(":max", $max, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $num;
    }
    public function select_filtr_prod_wyd($pdo, $typ, $limit, $start, $sex, $wyrob, $sort, $min, $max){
        
        $statement = $pdo -> prepare("SELECT * FROM product 
                                                            WHERE id_typ = :typ 
                                                            and prod_sex ".$sex."
                                                            and prod_wyrob ".$wyrob."
                                                            and cena_prod BETWEEN :min AND :max
                                                            ORDER BY ".$sort." 
                                                            LIMIT :start, :limit");
        
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":start", $start, PDO::PARAM_INT);
        $statement -> bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement -> bindValue(":min", $min, PDO::PARAM_INT);
        $statement -> bindValue(":max", $max, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $num;
    }
    public function select_filtr_prod_class($pdo, $typ, $wyd, $limit, $start, $sex, $wyrob, $sort, $min, $max){
        
        $statement = $pdo -> prepare("SELECT * FROM product 
                                                            WHERE id_typ = :typ 
                                                            and id_wyd = :wyd 
                                                            and prod_sex ".$sex."
                                                            and prod_wyrob ".$wyrob."
                                                            and cena_prod BETWEEN :min AND :max
                                                            ORDER BY ".$sort." 
                                                            LIMIT :start, :limit");
        
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> bindValue(":start", $start, PDO::PARAM_INT);
        $statement -> bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement -> bindValue(":min", $min, PDO::PARAM_INT);
        $statement -> bindValue(":max", $max, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $num;
    }
    // Функції Ліміту   ************************************************************************
    public function select_filtr_prod_lim($pdo, $typ, $wyd, $class, $limit, $sex, $wyrob, $sort, $min, $max){
        
        $statement = $pdo -> prepare("SELECT * FROM product 
                                                            WHERE id_typ = :typ 
                                                            and id_wyd = :wyd 
                                                            and id_class = :class 
                                                            and prod_sex ".$sex."
                                                            and prod_wyrob ".$wyrob."
                                                            and cena_prod BETWEEN :min AND :max
                                                            ORDER BY ".$sort."");
        
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> bindValue(":class", $class, PDO::PARAM_INT);
        $statement -> bindValue(":min", $min, PDO::PARAM_INT);
        $statement -> bindValue(":max", $max, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> rowCount();
        
        $posts = intval(($num - 1) / $limit) + 1;

        return $posts;
    }
    public function select_filtr_prod_typ_lim($pdo, $limit, $sex, $wyrob, $sort, $min, $max){
        
        $statement = $pdo -> prepare("SELECT * FROM product 
                                                            WHERE prod_sex ".$sex."
                                                            and prod_wyrob ".$wyrob."
                                                            and cena_prod BETWEEN :min AND :max ");
        
        $statement -> bindValue(":min", $min, PDO::PARAM_INT);
        $statement -> bindValue(":max", $max, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> rowCount();
        
        $posts = intval(($num - 1) / $limit) + 1;

        return $posts;
    }
    public function select_filtr_prod_wyd_lim($pdo, $typ, $limit, $sex, $wyrob, $sort, $min, $max){
        
        $statement = $pdo -> prepare("SELECT * FROM product 
                                                            WHERE id_typ = :typ 
                                                            and prod_sex ".$sex."
                                                            and prod_wyrob ".$wyrob."
                                                            and cena_prod BETWEEN :min AND :max ");
        
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":min", $min, PDO::PARAM_INT);
        $statement -> bindValue(":max", $max, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> rowCount();
        
        $posts = intval(($num - 1) / $limit) + 1;

        return $posts;
    }
    public function select_filtr_prod_class_lim($pdo, $typ, $wyd, $limit, $sex, $wyrob, $sort, $min, $max){
        
        $statement = $pdo -> prepare("SELECT * FROM product 
                                                            WHERE id_typ = :typ 
                                                            and id_wyd = :wyd 
                                                            and prod_sex ".$sex."
                                                            and prod_wyrob ".$wyrob."
                                                            and cena_prod BETWEEN :min AND :max ");
        
        $statement -> bindValue(":typ", $typ, PDO::PARAM_INT);
        $statement -> bindValue(":wyd", $wyd, PDO::PARAM_INT);
        $statement -> bindValue(":min", $min, PDO::PARAM_INT);
        $statement -> bindValue(":max", $max, PDO::PARAM_INT);
        $statement -> execute();
        $num = $statement -> rowCount();
        
        $posts = intval(($num - 1) / $limit) + 1;

        return $posts;
    }
}

$Catalog = new Catalog();