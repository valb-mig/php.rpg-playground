<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

(Dotenv::createImmutable(__DIR__, null, true))->load();

/*
[TODO / Next steps]

Create a party
Create a character
Add Character to party
Create an item
Add item to character
*/