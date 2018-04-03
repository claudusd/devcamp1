<?php
namespace App;

use Pdo;

class Db
{
    private $conn;

    private function getConn(): PDO
    {
        if (null === $this->conn) {
            $this->conn = new PDO(<<<EOF
pgsql:host=database;port=5432;dbname=isf;user=isf;password=isf
EOF
            );
        }

        return $this->conn;
    }

    public function select(string $query, array $parameters = []): array
    {
        $st = $this->getConn()->prepare($query);
        try {
            $st->execute($parameters);

            return $st->fetchAll(PDO::FETCH_ASSOC);
        } finally {
            $st->closeCursor();
        }
    }

    public function getYears(): array
    {
        return $this->select(<<<EOF
SELECT distinct year FROM isf;
EOF
        );
    }

    public function getCities(string $year): array
    {
        return $this->select(<<<EOF
SELECT * FROM isf
INNER JOIN position ON isf.insee = position.insee
WHERE isf.year = ?;
EOF
        , [$year]);
    }
}
