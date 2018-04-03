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
        /**
        $req = $this->pdo->prepare("
          INSERT INTO users (login, password, email, infos, roles_id) 
          VALUES (:login, :password, :email, :infos, '2')
          CONFLICT (did) DO UPDATE
        ");
        $req->execute(array(
            "annee" => "",
            "login" => ,
            "password" => ,
            "email" => ,
            "infos" =>
        ));
         * **/
    }
}