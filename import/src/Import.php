<?php

namespace ISF;

use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\LexerConfig;

class Import
{
    private $lexer;

    public function __construct()
    {
        $config = new LexerConfig();
        $config->setDelimiter(',')
            ->setEnclosure('"');

        $this->lexer = new Lexer($config);
    }

    public function import($path)
    {
        $interpreter = new Interpreter();
        $interpreter->addObserver($this);

        $this->lexer->parse($path, $interpreter);
    }

    function __invoke($data)
    {
        var_dump($data);
    }
}