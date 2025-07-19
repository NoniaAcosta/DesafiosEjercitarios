<?php 
require_once 'Database.php';

class DesafioDos {

    public static function retriveLotes(int $id) {

        Database::setDB(); 

        echo(json_encode(self::getLotes($id)));
    }

    private static function getLotes (int $id){
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->query("SELECT * FROM debts WHERE lote = '$id'");
        while($rows = $stmt->fetchArray(SQLITE3_ASSOC)){
            $lotes[] = (object) $rows;
        }
        return $lotes;
    }
}

DesafioDos::retriveLotes('00148');