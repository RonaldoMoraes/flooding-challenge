<?php
namespace App\Factory;

use App\Matrix;

class FloodingSilhouetteTerminal extends FloodingSilhouette implements PrinterInterface {
    
    public function __construct(Matrix $matrix)
    {
        parent::__construct($matrix);
    }

    public function printChallenge(string $message = ''): void
    {
        pr("------------------------------------------------\n");
        if ($message) pr("$message:\n");
        for ($i=0; $i < $this->matrix->getMaxHeight(); $i++) { 
            pr(json_encode($this->matrix->data[$i]) . "\n");
        }
    }
}