<?php
namespace App\Factory;

interface PrinterInterface {
    
    public function printChallenge(string $message = '');
}