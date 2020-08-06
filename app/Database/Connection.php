<?php
namespace App\Database;

use PDO;

class Connection
{
    private $hydrahon;
    
    public function __construct(){
        
        $connection = new PDO('mysql:host=localhost;dbname=hukum', 'root', '');

        $this->hydrahon = new \ClanCats\Hydrahon\Builder('mysql', function ($query, $queryString, $queryParameters) use ($connection) {
            $statement = $connection->prepare($queryString);
            $statement->execute($queryParameters);

            if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface) {
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            }
        });
    
    }

    public function stmt(){
        return $this->hydrahon;
    }
}
