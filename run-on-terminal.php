<?php
require "lib/FloodingSilhouette.php";
require "lib/Matrix.php";
include_once(__DIR__ . "/utils.php");

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

$testCases = array_chunk($input, 2);
echo "Legenda:\nAr: ' ' (Espaço em branco)\nÁgua: ~\nTerreno: X\n\n";
$answers = [];

$timeStart = microtime(true);
// Separando cada test case
foreach($testCases as $testCase) {
    $total = 0;
    $width = (int) $testCase[0];
    $heights = array_map(function($i){
        return (int) $i;
    }, explode(' ', $testCase[1]));

    $matrix = new Matrix($width, $heights);
    if (!$matrix->isValid()) continue;
    $floodingSilhouette = new FloodingSilhouette($matrix);
    $floodingSilhouette->makeItRain();
    $total = $matrix->getTotalFlooding();
    $floodingSilhouette->printChallenge("Alagamento de Silhueta");
    $answers[] = $total;
    print_r("TOTAL: $total\n");
}

$timeTotal = (microtime(true) - $timeStart) * 1000;
echo "------------------------------------------------\n";
echo "Resposta Final: " . json_encode($answers) . "\n";
echo "TEMPO DE EXECUÇÃO TOTAL: $timeTotal milisegundos\n";

