<?php

namespace App\Database;

use App\Exception\MissingArgumentException;

abstract class AbstractConnection
{
    protected $connection;
    protected $credentials;

    const REQUIRED_CONNECTION_KEYS = [];

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
        if (! $this->credentailsHaveRequireKeys($this->credentials)) {
            throw new MissingArgumentException(
                sprintf(
                    'Database connetcion credentials are not mapped correctly, required key %s',
                    implode(',', static::REQUIRED_CONNECTION_KEYS)
                )
            );
        }
    }

    private function credentailsHaveRequireKeys(array $credentials): bool
    {
        $matchs = array_intersect_key(static::REQUIRED_CONNECTION_KEYS, array_keys($this->credentials));
        return count($matchs) == count(static::REQUIRED_CONNECTION_KEYS);
    }

    abstract protected function parseCredentials(array $credentials): array;
}