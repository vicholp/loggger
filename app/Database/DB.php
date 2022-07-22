<?php

namespace App\Database;

use PDO;

class DB
{
    private PDO $pdo;

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }

    public function __construct()
    {
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $dbname = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";

        $this->pdo = new PDO($dsn, $username, $password);
    }

    public function execute(string $query, array $binds = []): \PDOStatement
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($binds);

        return $stmt;
    }

    public static function query(string $query, array $binds = []): \PDOStatement
    {
        return (new DB())->execute($query, $binds);
    }

    public static function select(string $query, array $params = []): array
    {
        return (new DB())->execute($query, $params)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function insert(string $query, array $params = []): string|false
    {
        $pdo = new DB();

        $pdo->execute("$query", $params)->fetchAll(\PDO::FETCH_ASSOC);
        return $pdo->getPdo()->lastInsertId();
    }
}
