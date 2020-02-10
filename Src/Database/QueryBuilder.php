<?php

namespace App\Database;

use App\Contracts\DatabaseConnectionInterface;
use App\Exception\NotFoundException;

abstract class QueryBuilder
{
    protected $connection;
    protected $table;
    protected $statement;
    protected $fields;
    protected $placeholders;
    protected $bindings;
    protected $operation = self::DML_TYPE_SELECT;

    const OPERATORS = ['=', '>=', '>', '<=', '<', '<>'];
    const PLACEHOLDER = '?';
    const COLUMNS = '*';
    const DML_TYPE_SELECT = 'SELECT';
    const DML_TYPE_INSERT = 'INSERT';
    const DML_TYPE_UPDATE = 'UPDATE';
    const DML_TYPE_DELETE = 'DELETE';

    use Query;

    public function __construct(DatabaseConnectionInterface $databaseConnection)
    {
        $this->connection = $databaseConnection->getConnection();
    }

    public function table($table)
    {
        $this->table = $table;

        return $this;
    }

    public function where($column, $operator = self::OPERATORS[0], $value = null)
    {
        if (! in_array($operator, self::OPERATORS)) {
            if ($value == null) {
                $value = $operator;
                $operator = self::OPERATORS[0];
            } else {
                throw new NotFoundException('Operator is not valid', ['operator' => $operator]);
            }
        }
        $this->parseWhere([$column => $value], $operator);
        $query = $this->prepare($this->getQuery($this->operation));
        $this->statement = $this->execute($query);

        return $this;
    }

    private function parseWhere(array $conditions, $operator)
    {
        foreach($conditions as $column => $value) {
            $this->placeholders[] = sprintf('%s %s %s', $column, $operator, self::PLACEHOLDER);
            $this->bindings[] = $value;
        }
    }

    public function select(string $fields = self::COLUMNS)
    {
        $this->operation = self::DML_TYPE_SELECT;
        $this->fields = $fields;
        return $this;
    }

    public function create(array $data)
    {

    }

    public function update(array $data)
    {

    }

    public function delete()
    {

    }

    public function raw()
    {

    }

    public function find($id)
    {

    }

    public function findOneBy(string $field, $value)
    {

    }

    public function first()
    {

    }

    abstract public function get();
    abstract public function count();
    abstract public function lastInsertId();
    abstract public function prepare($query);
    abstract public function execute($statement);
    abstract public function fetchInto($class);
}
