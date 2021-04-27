<?php

class Koment{
    
    public function select_kom($pdo, $prod){
        
        $statement = $pdo -> prepare("SELECT * FROM koment WHERE id_tow = :prod ");
        $statement -> bindValue(":prod", $prod, PDO::PARAM_INT);
        $statement -> execute();
        $sel = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $sel;
    }
    public function insert_kom($pdo, $name, $text, $id_tow){
        
        $statement = $pdo -> prepare("INSERT INTO `koment`(`id_tow`, `name`, `text`, `time`) VALUES (:id_tow, :name, :text, CURRENT_TIME())");
        $statement -> bindValue(":id_tow", $id_tow, PDO::PARAM_INT);
        $statement -> bindParam(":name", $name, PDO::PARAM_STR);
        $statement -> bindParam(":text", $text, PDO::PARAM_STR);
        $statement -> execute();
    }
    
    public function select_ans($pdo, $kom){
        
        $statement = $pdo -> prepare("SELECT * FROM koment_ans WHERE id_kom = :kom ");
        $statement -> bindValue(":kom", $kom, PDO::PARAM_INT);
        $statement -> execute();
        $sel = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $sel;
    }
    public function insert_ans($pdo, $id_kom, $name_ans, $text_ans){
        
        $statement = $pdo -> prepare("INSERT INTO koment_ans (`id_kom`, `name`, `text`, `time`) VALUES (:id_kom, :name_ans, :text_ans, CURRENT_TIME())");
        $statement -> bindValue(":id_kom", $id_kom, PDO::PARAM_INT);
        $statement -> bindParam(":name_ans", $name_ans, PDO::PARAM_STR);
        $statement -> bindParam(":text_ans", $text_ans, PDO::PARAM_STR);
        $statement -> execute();
    }
    
}

$Koment = new Koment();