<?php

declare(strict_types=1);

namespace Rpg\Infrastructure\Factory;

class RepositoryFactory
{
    private $config;
    private $repository;

    public function __construct(string $method)
    {
        $this->config = require __DIR__ . '/../../../config/config.php';
        $this->repository = $this->config['repository'][$method];
    }

    public function set()
    {
        return new $this->repository();
    }
}
