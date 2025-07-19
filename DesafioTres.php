<?php
require_once 'Database.php';
// Pasos para ejecutar
// ejecutar; php -S localhost:8000
// Luego ir al navegador y usar por ejemplo:http://localhost:8000/DesafioTres.php?id=1
class DesafioDos
{

    public static function retriveLoteById(int $id)
    {

        Database::setDB();

        echo (json_encode(self::getLotes($id)));
    }

    private static function getLotes(int $id)
    {
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->prepare("SELECT * FROM debts WHERE id = :id");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        while($rows = $result->fetchArray(SQLITE3_ASSOC)){
            $lotes[] = (object) $rows;
        }
        return $lotes;
    }
}
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    DesafioDos::retriveLoteById((int) $_GET['id']);
} else {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'Parámetro ID faltante o inválido'
    ]);
}

