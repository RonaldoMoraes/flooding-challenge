<?php

define('AIR', " ");
define('WATER', "~");
define('GROUND', "X");

$input = [
    '7',
    '9',
    '5 4 3 2 1 2 3 4 5',
    '30',
    '7 10 2 5 13 3 4 10 5 9 4 2 6 5 18 6 8 6 15 4 20 4 8 9 5 21 4 7 19 2',
    '1',
    '10',
    '10',
    '1 2 3 4 5 6 7 8 9 10',
    '10',
    '10 9 8 7 6 5 4 3 2 1',
    '15',
    '10 10 10 10 10 10 10 10 10 10 10 10 10 10 10',
    '20',
    '1 2 3 4 5 6 7 8 9 10 10 9 8 7 6 5 4 3 2 1',
];

$casesNumber = (int) array_shift($input);

if ($casesNumber < 1 || $casesNumber > 100) {
    echo "Number of test cases must be between 1 and 100";
    die;
}

if (count($input) % 2 !== 0) {
    echo "Test case input has a wrong set of lines";
    die;
}

$chunks = array_chunk($input, 2);
echo "Legenda:\nTerreno: X\nÁgua: ~\nAr: ' '(Espaço em branco)\n\n";
$answers = [];

// Separando cada test case
foreach($chunks as $chunk) {
    $total = 0;
    $width = $chunk[0];
    $heights = explode(' ', $chunk[1]);

    floodTest($width, $heights, $total);
    $answers[] = $total;
    print_r("TOTAL: $total\n");
}

echo "Resposta Final: " . json_encode($answers) . "\n";

function floodTest(int $width, array $heights, int &$total): void {
    if (count($heights) !== $width) {
        $err = json_encode($heights);
        echo "Line $err length differs from it's index $width. Skipping this one.";
        return;
    }
    $MAX_HEIGHT = max($heights);
    $matrix = [];

    for ($i=0; $i < $MAX_HEIGHT; $i++) {
        // $matrix[$i] = array_fill(0, $width, AIR); // Preenche linha inteira com AIR
        for ($j=0; $j < $width; $j++) { 
            if ($heights[$j] > ($MAX_HEIGHT - 1 - $i)) {
                $matrix[$i][$j] = GROUND; // Preenche bloco com GROUND
            } else {
                $matrix[$i][$j] = AIR; // Preenche bloco com AIR
            }

            // Se o ponteiro de width NÃO está na última posição OU se tem menos de 2 GROUNDs na linha, sai da iteração
            if ($j !== ($width - 1) || @array_count_values($matrix[$i])[GROUND] < 2) continue;

            $interval = array_keys($matrix[$i], GROUND);
            // Para cada intervalo de GROUNDs
            for ($x=0; $x < count($interval)-1; $x++) { 
                $rangeToFill = range($interval[$x], $interval[$x+1]);
                // SE não houver pelo menos 1 bloco de AIR entre os GROUNDs, sai da iteração
                if (count($rangeToFill) < 3) continue;

                $rangeToFill = array_slice($rangeToFill, 1, -1);
                // Preenche cada 
                foreach ($rangeToFill as $index) {
                    $matrix[$i][$index] = WATER; // Preenche bloco com WATER
                    $total++;
                }
            }
        }
    }

    matrixPrint($matrix, $MAX_HEIGHT, "Alagamento de Silhueta");
}

function matrixPrint(array $matrix, int $MAX_HEIGHT, string $message = ''): void {
    echo "------------------------------------------------\n";
    if ($message) echo "$message:\n";
    for ($i=0; $i < $MAX_HEIGHT; $i++) { 
        echo json_encode($matrix[$i]);
        echo "\n";
    }
}