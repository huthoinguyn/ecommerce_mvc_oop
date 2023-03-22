<?php

namespace App\Interfaces;

use PDO;
use PDOException;

abstract class Database
{

    abstract protected function connect();

    abstract protected function disconnect();

    abstract protected function select($table, $fields, $conditions, $order, $limit);

    abstract protected function insert($table, $data);

    abstract protected function update($table, $data, $conditions);

    abstract protected function delete($table, $conditions);
}
