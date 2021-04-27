<?php 

class Annou{
    
    public function select_all($pdo, $limit, $start){
        
        $statement = $pdo -> prepare("SELECT * FROM annou WHERE status_annou = 3 ORDER BY id_annou DESC LIMIT :start, :limit");
        $statement -> bindValue(":start", $start, PDO::PARAM_INT);
        $statement -> bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement -> execute();
        $annou = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return $annou;
    }
    
    public function select_posts($pdo,$limit){
        
        $statement = $pdo -> prepare("SELECT id_annou FROM annou ");
        $statement -> execute();
        $num = $statement -> rowCount();
        
        $posts = intval(($num - 1) / $limit) + 1;

        return $posts;
    }
}

$Annou = new Annou();