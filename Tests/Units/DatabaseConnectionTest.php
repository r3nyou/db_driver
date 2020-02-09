<?php
namespace Tests\Units;

use App\Helpers\Config;
use App\Database\PDOConnection;
use PHPUnit\Framework\TestCase;
use App\Database\MySQLiConnection;
use App\Exception\MissingArgumentException;
use App\Contracts\DatabaseConnectionInterface;

class DatabaseConnectionTest extends TestCase
{
    public function testItThrowMissArgumentExceptionWithWrongCredentialKeys()
    {
        self::expectException(MissingArgumentException::class);
        $credentials = [];
        $pdoHandler = new PDOConnection($credentials);
    }

    public function testItCanConnectToDatabaseWithPdoApi()
    {
        $credentials = $this->getCredentails('pdo');
        $pdoHandler = (new PDOConnection($credentials))->connect();
        self::assertInstanceOf(DatabaseConnectionInterface::class, $pdoHandler);

        return $pdoHandler;
    }

    /**
     * @depends testItCanConnectToDatabaseWithPdoApi
     */
    public function testItIsAValidPdoConnection(DatabaseConnectionInterface $handler)
    {
        self::assertInstanceOf(\PDO::class, $handler->getConnection());
    }

    public function testItCanConnectToDatabaseWithMysqliApi()
    {
        $credentials = $this->getCredentails('mysqli');
        $handler = (new MySQLiConnection($credentials))->connect();
        self::assertInstanceOf(DatabaseConnectionInterface::class, $handler);

        return $handler;
    }

    /**
     * @depends testItCanConnectToDatabaseWithMysqliApi
     */
    public function testItIsAValidMysqliConnection(DatabaseConnectionInterface $handler)
    {
        self::assertInstanceOf(\mysqli::class, $handler->getConnection());
    }

    private function getCredentails(string $type)
    {
        return array_merge(
            Config::get('database', $type),
            ['db_name' => 'bug_app_test']
        );
    }
}
