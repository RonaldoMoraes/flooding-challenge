<?php
include_once __DIR__ . '/utils.php';
require_once __DIR__ . '/vendor/autoload.php';

define('DEFAULT_FILE_PATH', __DIR__ . '/testcases.txt');

// Se é um POST, pega o arquivo enviado
if (isPost() && isset($_FILES['file'])) {
    $fileUploaded = $_FILES['file']['tmp_name'];
    if (!$fileUploaded) {
        pr("Você deve inserir um arquivo de entrada válido!\n");
        die;
    }
    $input = file($fileUploaded);
// Se não foi um comando com parâmetro, pega o padrão
} elseif ($argc <= 1 || !file_exists(__DIR__ . "/$argv[1]")) {
    pr("Rodando Testes Padrão\n");
    $input = file(DEFAULT_FILE_PATH);
// Senão pega o arquivo pelo parâmetro ('php execute.php testcases.txt')
} else {
    $input = file($argv[1]);
}

$casesNumber = (int) array_shift($input);
if ($casesNumber < 1 || $casesNumber > 100) {
    pr("Number of test cases must be between 1 and 100");
    die;
}

if (count($input) % 2 !== 0) {
    pr("Test case input has a wrong set of lines");
    die;
}

$testCases = array_chunk($input, 2);
printHeaderSubtitle();
$answers = [];

$timeStart = microtime(true);
// Separando cada test case
foreach($testCases as $key => $testCase) {
    $total = 0;
    $width = (int) $testCase[0];
    $heights = array_map(function($i){
        return (int) $i;
    }, explode(' ', $testCase[1]));

    $matrix = new \App\Matrix($width, $heights);
    if (!$matrix->isValid()) continue;
    $floodingSilhouette = \App\Factory\FloodingSilhouetteFactory::getFlooding($matrix);
    $floodingSilhouette->makeItRain();
    $total = $matrix->getTotalFlooding();
    $floodingSilhouette->printChallenge("Alagamento de Silhueta " . ($key+1));
    $answers[] = $total;
    pr("TOTAL: $total\n");
}

$timeTotal = (microtime(true) - $timeStart) * 1000;
pr("------------------------------------------------\n");
pr("Resposta Final: " . json_encode($answers) . "\n");
pr("TEMPO DE EXECUÇÃO TOTAL: $timeTotal milisegundos\n");
