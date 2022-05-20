<?php
class Db
{
    private static $connection;

    public function connect()
    {

        if (!isset(self::$connection)) {

            $config = parse_ini_file('./config.ini');
            self::$connection = new mysqli($config['server'], $config['username'], $config['password'], $config['dbname']);
        }

        if (self::$connection === false) {
            return false;
        }
        return self::$connection;
    }

    public function query($query)
    {
        // Connect to the database
        $connection = $this->connect();

        // Query the database
        $result = $connection->query($query);

        return $result;
    }

    public function select($query)
    {
        $rows = array();
        $result = $this->query($query);
        if ($result === false) {
            return false;
        }
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function destroy($sessionId)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM sessions WHERE session_id = ?");
            $stmt->bind_param("s", $sessionId);
            $stmt->execute();
            $stmt->close();

            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    }
    public function error()
    {
        $connection = $this->connect();
        return $connection->error;
    }

    public function quote($value)
    {
        $connection = $this->connect();
        return "'" . $connection->real_escape_string($value) . "'";
    }
}