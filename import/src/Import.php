<?php

namespace ISF;

use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\LexerConfig;

class Import
{
    /**
     * @var Lexer
     */
    private $lexer;

    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct()
    {
        $config = new LexerConfig();
        $config->setDelimiter(',')
            ->setEnclosure('"');

        $this->lexer = new Lexer($config);
        $dsn = sprintf('pgsql:host=%s;port=5432;dbname=%s;user=%s;password=%s', 'database', 'isf', 'isf', 'isf');
        $this->pdo = new \PDO($dsn);

        $this->pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
    }

    public function import($path, $year)
    {
        if (!file_exists($path)) {
            throw new \Exception(sprintf('File %s not exist', $path));
        }
        $inserter = new ISFInsert($year, $this->pdo);

        $interpreter = new Interpreter();
        $inserter->clear();
        $interpreter->addObserver($inserter);

        $this->lexer->parse($path, $interpreter);
    }
}
