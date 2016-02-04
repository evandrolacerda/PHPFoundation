<?php

namespace App\Model;

/**
 * Description of BasicModel
 *
 * @author Evandro Lacerda <evandroplacerda@@gmail.com>
 */
abstract class BasicModel
{

    protected $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function find($id)
    {
        $id = (int) $id;
        $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");

        try {
            $statement->bindValue( ':id', $id, \PDO::PARAM_INT );
            $statement->execute();

            return $statement->fetch(\PDO::FETCH_OBJ);
        } catch (\PDOException $exc) {
            throw new \Exception('Erro ao executar find(): ' . $exc->getMessage());
        }
    }

    public function findAll()
    {
        $registros = array();
        $statement = $this->connection->prepare("SELECT * FROM {$this->table}");

        try {
            $statement->execute();

            while ($row = $statement->fetch(\PDO::FETCH_OBJ)) {
                $registros[] = $row;
            }

            return $registros;
        } catch (\PDOException $exc) {
            throw new Exception('Erro ao executar findAll(): ' . $exc->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} "
                    . "WHERE {$this->primaryKey} = :id ");
            $statement->bindValue(':id', (int) $id, \PDO::PARAM_INT);
            $statement->execute();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function insert(array $columns, array $data)
    {
        $columnsPlaceholders = implode(',', $columns);
        $placeholders = array();
        foreach ($columns as $value) {
            $placeholders[] = ":{$value}";
        }

        $sql = sprintf("INSERT INTO `%s` ( %s ) VALUES( %s )", $this->table, 
                $columnsPlaceholders, implode(',', $placeholders ) );
 
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute($data);
        } catch (\PDOException $exc) {
            throw new Exception("Erro ao executar inser statement \n" .
            $statement . "\n" . $exc->getMessage());
        }
    }
    
    /**
     * 
     * @param type $id chave primária da tabela
     * @param array $data array associativo no modelo campo => valor 
     * Exemplo array( 'nome' => 'Evandro Lacerda')
     * @throws \Exception
     */
    public function update($id, array $data)
    {
        $sql = sprintf("UPDATE %s SET ", $this->table );

        foreach ( $data as $key => $value) { 
            $sql .= sprintf("%s = ?, ", $key, $key );                
        }
        
        //remover espaços e vírgulas a mais
        $sql = rtrim( $sql );
        $sql = rtrim( $sql, ',' );
                
        
        $sql .= sprintf(" WHERE %s = %s", $this->primaryKey, (int) $id );
                
        $valores = array_values( $data );
        
        echo '<pre>';
        var_dump( $valores);
        echo '</pre>';
        //die();  
        try{
            $statement = $this->connection->prepare( $sql );
            $statement->execute( $valores );
            
        } catch (\PDOException $ex) {
            throw new \Exception("Erro ao exeutar update statement\n" . 
                    "\n". $ex->getMessage());
        }
        
    }
    
    

}
