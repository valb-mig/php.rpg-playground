<?php
declare(strict_types=1);

$ambient = $_ENV['AMBIENT'] ?? 'dev';

if(!in_array($ambient, ['dev', 'prod'])) {
    throw new \InvalidArgumentException('Invalid ambient: ' . $ambient);
}

$config  = require __DIR__ . "/env/{$ambient}.config.php";

return array_merge($config, [
    'ambient' => $ambient
]);
