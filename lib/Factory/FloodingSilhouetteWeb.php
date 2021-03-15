<?php
namespace App\Factory;

use App\Matrix;

class FloodingSilhouetteWeb extends FloodingSilhouette implements PrinterInterface {
    private static $DICTIONARY = [
        ' ' => 'pink',
        '~' => 'blue',
        'X' => 'black',
    ];
    
    public function __construct(Matrix $matrix)
    {
        parent::__construct($matrix);
    }

    public function printChallenge(string $message = ''): void
    {
        pr("------------------------------------------------\n");
        if ($message) pr("$message:\n");
        $tableRows = '';   
        for ($i=0; $i < $this->matrix->getMaxHeight(); $i++) { 
            $rowData = '';
            foreach ($this->matrix->data[$i] as $key => $symbol) {
                $color = self::$DICTIONARY[$symbol];
                $rowData .= "<td style='background-color:$color;width=100px;'></td>";
            }
            $tableRows .= "<tr>$rowData</tr>";
            // pr(json_encode($this->matrix->data[$i]) . "\n");
        }
        $html = '<table style="" class="table table-bordered table-hover table-sm">' .
        '           <tbody>' . 
                        $tableRows .
        '           </tbody>' .
        '       </table>';
        echo $html;
    }
}