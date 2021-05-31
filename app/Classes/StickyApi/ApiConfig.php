<?php

namespace App\Classes\StickyApi;

class ApiConfig
{
    public $host;
    private $username;
    private $password;

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost($host): string
    {
        return $this->host = $host;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): string
    {
        return $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): string
    {
        return $this->password = $password;
    }
}
