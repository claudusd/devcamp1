<?php

namespace ISF;

class ISFInsert
{
    /**
     * @var
     */
    private $year;

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * ISFInsert constructor.
     * @param $year
     * @param \PDO $pdo
     */
    public function __construct($year, \PDO $pdo)
    {
        $this->year = $year;
        $this->pdo = $pdo;
    }

    function __invoke($data)
    {
        /**
         * INSERT INTO table ON CONFLICT (did) DO UPDATE
         */
        /**
         * 0 => Region
         * 1 => departement
         * 2 => Code commune
         * 3=> Commune name
         * 4 => Nombre
         * 5 => Patrimoine Moyen
         * 6 => Import moyen
         */

        $req = $this->pdo->prepare("
          INSERT INTO isf (year, region, departement, insee, city, people, tax_avg, weatlh_avg) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

//var_dump($req);

        $a = $req->execute([
            $this->year,
            $data[0],
            $data[1],
            $data[2],
            $data[3],
            $data[4],
            $data[5],
            $data[6]
        ]);

        var_dump($a);

        var_dump($this->pdo->errorInfo());

    }
}