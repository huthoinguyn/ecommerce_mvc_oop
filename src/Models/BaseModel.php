<?php

namespace App\Models;

use PDO;
use PDOException;
use App\Interfaces\CRUDInterface;
use App\Interfaces\Database;
use App\Models\ConnectDatabaseException;

class BaseModel extends Database implements CRUDInterface
{

    private $_servername = "localhost";
    private $_dbname = "ecommerce_website";
    private $_username = "root";
    private $_password = "mysql";

    private $_connection;

    public $pdo;


    public function __construct()
    {
        $this->pdo = $this->connect();
    }

    protected function connect()
    {
        $dsn       = "mysql:host=$this->_servername;dbname=$this->_dbname;charset=utf8mb4";
        $options   = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // báo lỗi khi có lỗi xảy ra
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // trả về dữ liệu dạng mảng kết hợp
        ];
        $this->pdo = new PDO($dsn, $this->_username, $this->_password, $options);

        return $this->pdo;
    }

    protected function disconnect()
    {
        $this->_connection = null;
    }

    protected function select($table, $fields, $conditions, $order = '', $limit = 0)
    {
        $pdo = $this->connect();

        $sql    = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        $where  = [];
        $params = [];
        foreach ($conditions as $key => $value) {
            $where[]  = $key . " = ?";
            $params[] = $value;
        }
        if (!empty($where)) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        if (!empty($order)) {
            $sql .= " ORDER BY " . $order;
        } else {
            $sql .= " ORDER BY id DESC";
        }

        if ($limit != 0 && $limit >= 1) {
            $sql .= " LIMIT " . $limit;
        }


        $stmt = @$pdo->prepare($sql);
        $stmt->execute($params);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->disconnect();
        return $result;
    }

    protected function insert($table, $data)
    {
        // Chuẩn bị câu truy vấn SQL
        $columns = implode(',', array_keys($data));
        $values  = implode(',', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        // Chuẩn bị và thực thi câu truy vấn với PDO
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(array_values($data));
    }

    protected function update($table, $data, $conditions)
    {
        // tạo câu truy vấn
        $sql = "UPDATE $table SET ";
        foreach ($data as $key => $value) {
            $sql .= "$key = :$key, ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE ";
        foreach ($conditions as $key => $value) {
            $sql .= "$key = :$key AND ";
        }
        $sql = rtrim($sql, "AND ");

        // chuẩn bị câu truy vấn
        $stmt = $this->pdo->prepare($sql);

        // bind các giá trị
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        foreach ($conditions as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // thực hiện câu truy vấn
        return $stmt->execute();
    }

    protected function delete($table, $conditions)
    {
        // Kết nối đến database
        $this->connect();

        // Xây dựng câu truy vấn
        $sql = "DELETE FROM {$table}";
        foreach ($conditions as $key => $value) {
            $where[]  = $key . " = ?";
            $params[] = $value;
        }
        if (!empty($where)) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }


        try {
            // Thực thi truy vấn và lấy số bản ghi bị ảnh hưởng
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $affected_rows = $stmt->rowCount();

            // Ngắt kết nối database và trả về số bản ghi bị ảnh hưởng
            $this->disconnect();
            return $affected_rows;
        } catch (PDOException $e) {
            echo "Lỗi xóa dữ liệu: " . $e->getMessage();
        }
    }

    public function createData($table, $data)
    {
        return $this->insert($table, $data);
    }

    public function readData($table, $fields, $conditions, $order, $limit)
    {
        return $this->select($table, $fields, $conditions, $order, $limit);
    }

    public function updateData($table, $data, $conditions)
    {
       return $this->update($table, $data, $conditions);
    }

    public function deleteData($table, $conditions)
    {
        return $this->delete($table, $conditions);
    }
}
