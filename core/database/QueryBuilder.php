<?php

//namespace app\core\database;
//
//
//use Exception;
//use PDO;

class QueryBuilder
{
    protected $pdo;

    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function count($table)
    {
        $statement = $this->pdo->prepare("select count(*) from {$table}");
        $statement->execute();

        return $statement->fetch(PDO::FETCH_COLUMN);
    }

    public function selectAll($table, $orderBy = '')
    {

        $sql = "select * from {$table} {$orderBy}";

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        $className = ucfirst($table);

        return $statement->fetchAll(PDO::FETCH_CLASS, $className);
    }

    public function insert($table, $parameters)
    {
        if(isset($parameters['id'])) unset($parameters['id']);

        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {

            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);

            return $this->pdo->lastInsertId();

        }catch (Exception $e) {

            die('Whoops, something went wrong.');
        }
    }

    public function selectOne($table, $id)
    {
        $statement = $this->pdo->prepare("select * from {$table} WHERE id=:id");

        $statement->execute([':id' => $id]);

        $className = ucfirst($table);

        return $statement->fetchObject($className);
    }

    public function update($table, $id, $parameters)
    {
        $setParams = '';
        $lastElement = end(array_keys($parameters));

        if(isset($parameters['id'])) unset($parameters['id']);

        foreach ($parameters as $name => $value)
        {
            $setParams .= $name ."=:" . $name . "";
            $setParams .= ($name != $lastElement) ? ", " : "";
        }

        $sql = sprintf(
            "UPDATE %s SET %s WHERE id=%s",
            $table, $setParams, (int)$id
        );

        try {

            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);

        }catch (\Exception $e) {
            print_r($e->getMessage());
            die('Whoops, something went wrong.');
        }
    }

    public function delete($table, $id)
    {
        $statement = $this->pdo->prepare("delete * from {$table} where id = :id");

        $statement->execute([':id' => $id]);
    }
}