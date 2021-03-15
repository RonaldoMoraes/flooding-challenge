<?php

define('AIR', ' ');
define('WATER', '~');
define('GROUND', 'X');
define('DEFAULT_FILE_PATH', __DIR__ . '/testcases.txt');

if ($argc <= 1 || !file_exists(__DIR__ . "/$argv[1]")) {
    echo "Running Default TestCases\n";
}
$input = file($argv[1] ?? DEFAULT_FILE_PATH);

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
echo "Legenda:\nAr: ' ' (Espaço em branco)\nÁgua: ~\nTerreno: X\n\n";
$answers = [];

// Separando cada test case
foreach($chunks as $chunk) {
    $total = 0;
    $width = (int) $chunk[0];
    $heights = array_map(function($i){
        return (int) $i;
    }, explode(' ', $chunk[1]));

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
        // $matrix[$i] = array_fill(0, $width, AIR); // Preenche linha inteira com AIR // Testar qual é mais rápido
        for ($j=0; $j < $width; $j++) { 
            if ($heights[$j] > ($MAX_HEIGHT - 1 - $i)) {
                $matrix[$i][$j] = GROUND; // Preenche bloco com GROUND
            } else {
                $matrix[$i][$j] = AIR; // Preenche bloco com AIR
            }

            // Se o ponteiro de width NÃO está na última posição OU se tem menos de 2 GROUNDs na linha, sai da iteração
            if ($j !== ($width - 1) || @array_count_values($matrix[$i])[GROUND] < 2) continue;

            // Intervalo de posições com GROUNDs
            $groundIndexes = array_keys($matrix[$i], GROUND);
            // Para cada intervalo entre GROUNDs
            for ($x=0; $x < count($groundIndexes)-1; $x++) { 
                $rangeToFill = range($groundIndexes[$x], $groundIndexes[$x+1]);
                // SE não houver pelo menos 1 bloco entre GROUNDs, sai dessa iteração
                if (count($rangeToFill) < 3) continue;

                // Tira os GROUNDs do array
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
        echo json_encode($matrix[$i]) . "\n";
    }
}