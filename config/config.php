<?php
declare(strict_types=1);

$ambient = $_ENV['AMBIENT'];

if(!in_array($ambient, ['dev', 'prod'])) {
    throw new \InvalidArgumentException('Invalid ambient');
}

$config  = require_once __DIR__ . "/env/{$ambient}.config.php";

return array_merge($config, ['ambient' => $ambient]);