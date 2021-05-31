<?php

namespace App\Classes\StickyApi;

/**
 * Class ApiConfig
 */
class ApiConfig
{
    public $host;
    private $username;
    private $password;

    /** Get API host value
     *
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /** Set API host value
     *
     * @param string $host
     * @return string
     */
    public function setHost(string $host): string
    {
        return $this->host = $host;
    }

    /** Get API username value
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /** Set API host value
     *
     * @param string $username
     * @return string
     */
    public function setUsername(string $username): string
    {
        return $this->username = $username;
    }

    /** Get API password value
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /** Set API password value
     *
     * @param string $password
     * @return string
     */
    public function setPassword(string $password): string
    {
        return $this->password = $password;
    }
}
