<?php
namespace App\Factory;

use App\Matrix;

class FloodingSilhouetteFactory {
    
    public static function getFlooding(Matrix $matrix): PrinterInterface
    {
        return isPost() ? new FloodingSilhouetteWeb($matrix) : new FloodingSilhouetteTerminal($matrix);
    }
}