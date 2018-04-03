<?php

namespace ISF;

class CommuneInserter
{
    private $pdo;
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function __invoke($data)
    {
        $req = $this->pdo->prepare("
          INSERT INTO position (insee, lat, lon) 
          VALUES (?, ?, ?)");

        $insee = str_replace(' ', '', $data[10]);

        if (strlen($insee) > 5) {
            return;
        }

        $req->bindParam(1, $insee, \PDO::PARAM_INT);
        $req->bindParam(2, $data[11], \PDO::PARAM_INT);
        $req->bindParam(3, $data[12], \PDO::PARAM_INT);


        $req->execute();
    }

    public function clear()
    {
        $req = $this->pdo->prepare("DELETE FROM position");
        $req->execute();
    }
}