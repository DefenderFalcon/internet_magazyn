<?php

class Postacz{
    public function select_post_name($pdo){
        
        $statement = $pdo -> prepare("SELECT `name_post` FROM postaczalnyk");
        $statement -> execute();
        $pos = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $pos;
    }
}

$Postacz = new Postacz();