<?php

namespace RPGPlayground\Domain\ValueObjects\App;

final class Result
{
    private const SUCCESS = 'success';
    private const ERROR = 'error';

    private function __construct(
        private string $type,
        private string $message, 
        private $data
    ){
        if(!in_array($type, [self::SUCCESS, self::ERROR])) {
            throw new \InvalidArgumentException('Type must be success or error');
        }

        $this->type = $type;
        $this->message = $message;
        $this->data = $data;
    }

    public static function success(string $message, $data = null): self
    {
        return new self(
            self::SUCCESS,
            $message, 
            $data
        );
    }

    public static function error(string $message, $data = null): self
    {
        return new self(
            self::ERROR,
            $message,
            $data
        );
    }

    public function getData(){
        return $this->data;
    }

    public function getMessage(){
        return $this->message;
    }

    public function isError(){
        return $this->type == self::ERROR;
    }

    public function isSuccess(){
        return $this->type == self::SUCCESS;
    }
}