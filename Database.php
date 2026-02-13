<?php

class Database
{
    public $conn;

    /**
     * Constructor for Database class.
     * 
     * @param array $config
     */

    public function __construct(array $config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e) {
            throw new Exception('Database connection failed: ' . $e->getMessage());
        }
    }


    /**
     *  Query the database
     * 
     * @param string $query
     * @return PDOStatement
     * @throws PDOException
     */
    public function query($query, $params = [])
    {
        try {
            // Use prepared statements to prevent SQL injection
            $stmt = $this->conn->prepare($query);
            // Bind named params
            foreach ($params as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }

            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception('Query failed to execute: ' . $e->getMessage());
        }
    }
}
