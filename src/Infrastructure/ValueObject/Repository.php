<?php
declare(strict_types=1);

namespace Rpg\Infrastructure\ValueObject;

class Repository
{
    private $config;
    private $repository;

    public function __construct(string $method)
    {
        $this->config = require_once __DIR__ . '/../../../config/config.php';
        $this->repository = $this->config['repository'][$method];

        return $this;
    }

    public function set()
    {
        return new $this->repository;
    }
}