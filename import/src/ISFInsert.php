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
        $this->year = intval($year);
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
          INSERT INTO isf (year, region, department, insee, city, people, tax_avg, weatlh_avg) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        //var_dump($req->queryString);
//var_dump($req);
        $req->bindParam(1, $this->year, \PDO::PARAM_INT);
        $req->bindParam(2, $data[0]);
        $req->bindParam(3, $data[1]);
        $req->bindParam(4, $data[2]);
        $req->bindParam(5, $data[3]);
        $req->bindParam(6, intval($data[4]), \PDO::PARAM_INT);
        $req->bindParam(7, intval($data[5]), \PDO::PARAM_INT);
        $req->bindParam(8, intval($data[6]), \PDO::PARAM_INT);

        var_dump($req->debugDumpParams());
        $a = $req->execute();

        var_dump($a);

        var_dump($this->pdo->errorInfo());
        die;

    }
}