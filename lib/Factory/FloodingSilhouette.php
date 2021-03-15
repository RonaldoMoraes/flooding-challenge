<?php
namespace App\Factory;

use App\Matrix;

abstract class FloodingSilhouette {
    protected static $AIR = ' ';
    protected static $WATER = '~';
    protected static $GROUND = 'X';
    protected Matrix $matrix;
    
    public function __construct(Matrix $matrix)
    {
        $this->matrix = $matrix;
    }

    public function getMatrix(): Matrix
    {
        return $this->matrix;
    }

    public function makeItRain(): void
    {
        for ($i=0; $i < $this->matrix->getMaxHeight(); $i++) {
            $this->matrix->data[$i] = array_fill(0, $this->matrix->getWidth(), self::$AIR); // Preenche linha inteira com AIR // Testar qual é mais rápido
            for ($j=0; $j < $this->matrix->getWidth(); $j++) { 
                if ($this->matrix->getHeights()[$j] > ($this->matrix->getMaxHeight() - 1 - $i)) {
                    $this->matrix->data[$i][$j] = self::$GROUND; // Preenche bloco com GROUND
                }
                if ($j !== ($this->matrix->getWidth() - 1) || @array_count_values($this->matrix->data[$i])[self::$GROUND] < 2) continue;
    
                // Intervalo de posições com GROUNDs
                $groundIndexes = array_keys($this->matrix->data[$i], self::$GROUND);
                // Para cada intervalo entre GROUNDs
                for ($x=0; $x < count($groundIndexes) - 1; $x++) { 
                    $rangeToFill = range($groundIndexes[$x], $groundIndexes[$x+1]);
                    // SE não houver pelo menos 1 bloco entre GROUNDs, sai dessa iteração
                    if (count($rangeToFill) < 3) continue;
    
                    // Tira os GROUNDs do array
                    $rangeToFill = array_slice($rangeToFill, 1, -1);

                    foreach ($rangeToFill as $index) {
                        $this->matrix->data[$i][$index] = self::$WATER; // Preenche bloco com WATER
                    }
                    $this->matrix->increaseTotalFlooding(count($rangeToFill));
                }
            }
        }
    }
}