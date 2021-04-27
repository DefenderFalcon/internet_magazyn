<?php

class Zamowienia{
    
    public function craete_zam($pdo, $surname, $name, $batkowi, $telefon, $email, $suma, $sp_oplata){
        
        $statement = $pdo -> prepare("INSERT INTO `zamowienia`(`surname`, `name`, `po_batkowi`, `telefon`, `email`, `suma`, `time`, `sp_opl`) VALUES (:surname, :name, :batkowi, :telefon, :email, :suma, CURRENT_TIME(), :s_opl)");
        $statement -> bindParam(":surname", $surname, PDO::PARAM_STR);
        $statement -> bindParam(":name", $name, PDO::PARAM_STR);
        $statement -> bindParam(":batkowi", $batkowi, PDO::PARAM_STR);
        $statement -> bindParam(":telefon", $telefon, PDO::PARAM_STR);
        $statement -> bindParam(":email", $email, PDO::PARAM_STR);
        $statement -> bindParam(":suma", $suma, PDO::PARAM_INT);
        $statement -> bindParam(":s_opl", $sp_oplata, PDO::PARAM_INT);
        $statement -> execute();
        
    }
    
    public function craete_zam_np($pdo, $id_zam, $oblast, $nas_punkt, $widdil){
        
        $statement = $pdo -> prepare("INSERT INTO `zamowienia_np`(`id_zam`, `oblast`, `nas_punkt`, `widdlil`) VALUES (:id_zam, :oblast, :nas_punkt, :widdil)");
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> bindParam(":oblast", $oblast, PDO::PARAM_STR);
        $statement -> bindParam(":nas_punkt", $nas_punkt, PDO::PARAM_STR);
        $statement -> bindParam(":widdil", $widdil, PDO::PARAM_STR);
        $statement -> execute();
    }
    
    public function craete_zam_ukr($pdo, $id_zam, $oblast, $rajon, $nas_punkt, $P_I){
        
        $statement = $pdo -> prepare("INSERT INTO `zamowienia_ukr`(`oblast`, `rajon`, `nas_punkt`, `P_I`, `id_zam`) VALUES (:oblast, :rajon, :nas_punkt, :P_I , :id_zam)");
        $statement -> bindParam(":id_zam", $id_zam, PDO::PARAM_STR);
        $statement -> bindParam(":oblast", $oblast, PDO::PARAM_STR);
        $statement -> bindParam(":rajon", $rajon, PDO::PARAM_STR);
        $statement -> bindParam(":nas_punkt", $nas_punkt, PDO::PARAM_STR);
        $statement -> bindParam(":P_I", $P_I, PDO::PARAM_STR);
        $statement -> execute();
    }
    
    public function craete_zam_tow($pdo, $id_zam, $id_prod, $rozmir, $kilkist){
        $statement = $pdo -> prepare("INSERT INTO `zamowienia_tow`(`id_zam`, `id_prod`, `rozmir`, `kilkist`) VALUES (:id_zam, :id_prod, :rozmir, :kilkist)");
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> bindValue(":id_prod", $id_prod, PDO::PARAM_INT);
        $statement -> bindParam(":rozmir", $rozmir, PDO::PARAM_STR);
        $statement -> bindValue(":kilkist", $kilkist, PDO::PARAM_INT);
        $statement -> execute();
    }
    
    public function select_lin_zam($pdo){
        
        $statement = $pdo -> prepare("SELECT id_zam FROM zamowienia ");
        $statement -> execute();
        $num = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $num;
    }
    public function klient($pdo, $surname, $name, $batkowi, $telefon, $baly){
        
        $statement = $pdo -> prepare("INSERT INTO `klienty`(`name`, `surname`, `po_batkowi`, `telefon`, `baly`) VALUES (:name, :surname, :batkowi, :telefon, :baly)");
        $statement -> bindParam(":surname", $surname, PDO::PARAM_STR);
        $statement -> bindParam(":name", $name, PDO::PARAM_STR);
        $statement -> bindParam(":batkowi", $batkowi, PDO::PARAM_STR);
        $statement -> bindParam(":telefon", $telefon, PDO::PARAM_STR);
        $statement -> bindParam(":baly", $baly, PDO::PARAM_INT);
        $statement -> execute();
        
    }
    public function select_klient($pdo){
        
        $statement = $pdo -> prepare("SELECT * FROM `klienty` ");
        $statement -> execute();
        $klient = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $klient;
        
    }
    public function update_klient($pdo, $id_klient, $baly){
        
        $statement = $pdo -> prepare("UPDATE klienty SET baly = :baly WHERE id_klient = :id");
        $statement -> bindValue(":id", $id_klient, PDO::PARAM_STR);
        $statement -> bindParam(":baly", $baly, PDO::PARAM_INT);
        $statement -> execute();
        
    }
    public function select_zam($pdo){
        
        $statement = $pdo -> prepare("SELECT * FROM `zamowienia` ORDER BY id_zam DESC");
        $statement -> execute();
        $sel_zam = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $sel_zam;
        
    }
    public function select_zam_id($pdo,$id_zam){
        
        $statement = $pdo -> prepare("SELECT * FROM `zamowienia` WHERE id_zam = :id_zam ");
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> execute();
        $sel_zam = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $sel_zam;
        
    }
    public function select_zam_ukr($pdo,$id_zam){
        
        $statement = $pdo -> prepare("SELECT * FROM `zamowienia_ukr` WHERE id_zam = :id_zam ");
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> execute();
        $sel_zam = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $sel_zam;
        
    }
    public function select_zam_np($pdo,$id_zam){
        
        $statement = $pdo -> prepare("SELECT * FROM `zamowienia_np` WHERE id_zam = :id_zam");
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        
        $statement -> execute();
        $sel_zam = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $sel_zam;
        
    }
    public function select_zam_tow($pdo,$id_zam){
        
        $statement = $pdo -> prepare("SELECT * FROM `zamowienia_tow` WHERE id_zam = :id_zam");
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> execute();
        $sel_zam = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $sel_zam;
        
    }
    
    public function update_zam($pdo,$id_zam,$surname,$name,$batkowi,$tel,$email,$status,$suma,$id_prac){
        
        $statement = $pdo -> prepare("UPDATE `zamowienia` SET 
        `surname`= :surname, `name`= :name, `po_batkowi`= :batkowi, 
        `telefon`= :tel, `email`= :email, `status`=:status, `suma`=:suma, 
        `id_prac`= :id_prac WHERE id_zam = :id_zam");
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> bindParam(":surname", $surname, PDO::PARAM_STR);
        $statement -> bindParam(":name", $name, PDO::PARAM_STR);
        $statement -> bindParam(":batkowi", $batkowi, PDO::PARAM_STR);
        $statement -> bindParam(":tel", $tel, PDO::PARAM_STR);
        $statement -> bindParam(":email", $email, PDO::PARAM_STR);
        $statement -> bindParam(":status", $status, PDO::PARAM_INT);
        $statement -> bindParam(":suma", $suma, PDO::PARAM_INT);
        $statement -> bindParam(":id_prac", $id_prac, PDO::PARAM_INT);
        $statement -> execute();
        
    }
    public function update_zam_tow($pdo,$id_zam,$id_tow,$rozmir,$kilkist){
        
        $statement = $pdo -> prepare("UPDATE `zamowienia_tow` SET `rozmir`=:rozmir, `kilkist`=:kilkist WHERE `id_zam`=:id_zam and `id_prod`= :id_tow ");
        
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> bindParam(":id_tow", $id_tow, PDO::PARAM_INT);
        $statement -> bindParam(":kilkist", $kilkist, PDO::PARAM_INT);
        $statement -> bindParam(":rozmir", $rozmir, PDO::PARAM_STR);
        
        $statement -> execute();
        
    }
    public function update_zam_np($pdo,$id_zam,$oblast,$nas_punkt,$widdlil){
        
        $statement = $pdo -> prepare("UPDATE `zamowienia_np` SET `oblast`=:oblast, `nas_punkt`=:nas_punkt, `widdlil`=:widdlil WHERE `id_zam`=:id_zam");
        
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> bindParam(":oblast", $oblast, PDO::PARAM_STR);
        $statement -> bindParam(":nas_punkt", $nas_punkt, PDO::PARAM_STR);
        $statement -> bindParam(":widdlil", $widdlil, PDO::PARAM_INT);

        $statement -> execute();
        
    }
    public function update_zam_ukr($pdo,$id_zam,$oblast,$rajon,$nas_punkt,$P_I){
        
        $statement = $pdo -> prepare("UPDATE `zamowienia_ukr` SET `oblast`=:oblast, `rajon`=:rajon, `nas_punkt`=:nas_punkt,`P_I`=:P_I WHERE `id_zam`=:id_zam");
        
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> bindParam(":oblast", $oblast, PDO::PARAM_STR);
        $statement -> bindParam(":rajon", $rajon, PDO::PARAM_STR);
        $statement -> bindParam(":nas_punkt", $nas_punkt, PDO::PARAM_STR);
        $statement -> bindParam(":P_I", $P_I, PDO::PARAM_STR);
        
        $statement -> execute();
        
    }
    public function delit_zam_ukr($pdo,$id_zam){
        
        $statement = $pdo -> prepare("DELETE FROM `zamowienia_ukr` WHERE `id_zam`=:id_zam");
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> execute();
        
    }
    public function delit_zam_np($pdo,$id_zam){
        
        $statement = $pdo -> prepare("DELETE FROM `zamowienia_np` WHERE `id_zam`=:id_zam");
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> execute();
        
    }
    public function delit_zam($pdo,$id_zam){
        
        $statement = $pdo -> prepare("DELETE FROM `zamowienia` WHERE `id_zam`=:id_zam");
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> execute();
        
    }
    public function delit_zam_tow_ol($pdo,$id_zam){
        
        $statement = $pdo -> prepare("DELETE FROM `zamowienia_tow` WHERE `id_zam`=:id_zam");
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> execute();
        
    }
    public function delit_zam_tow($pdo,$id_zam,$id_tow,$rozmir,$kilkist){
        
        $statement = $pdo -> prepare("DELETE FROM `zamowienia_tow` WHERE `id_zam`=:id_zam and `id_prod`= :id_tow and `rozmir`= :rozmir and `kilkist`= :kilkist");
        $statement -> bindValue(":id_zam", $id_zam, PDO::PARAM_INT);
        $statement -> bindParam(":id_tow", $id_tow, PDO::PARAM_INT);
        $statement -> bindParam(":kilkist", $kilkist, PDO::PARAM_INT);
        $statement -> bindParam(":rozmir", $rozmir, PDO::PARAM_STR);
        $statement -> execute();
        
    }
 
}

$Zamowienia = new Zamowienia();