<?php
namespace App\Database;

/**
 * Description of Conexao
 *
 * @author Evandro Lacerda <evandroplacerda@@gmail.com>
 */
class Conexao
{

    private $dbname;
    private $user;
    private $password;
    private $host;
    private $connection = null;

    public function __construct()
    {
        $config = include __DIR__ . '/../config/config.php';

        $this->dbname = $config['database']['dbname'];
        $this->user = $config['database']['user'];
        $this->password = $config['database']['password'];
        $this->host = $config['database']['host'];

        return $this;
    }

    public function getConnection()
    {

        if ($this->connection === null) {
            try {
                $dsn = sprintf("mysql:host=%s;dbname=%s;charset=utf8", $this->host, $this->dbname);
                $this->connection = new \PDO($dsn, $this->user, $this->password);
                $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $exc) {
                echo $exc->getTraceAsString();
            }
        }

        return $this->connection;
    }

}
