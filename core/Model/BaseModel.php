<?php


namespace Warehouse\Model;


use Warehouse\Builders\MysqlQueryBuilder;
use Warehouse\Database\DB;

abstract class BaseModel extends MysqlQueryBuilder
{
    public \PDO $connection;

    public ?string $tableName = null;

    public function __construct()
    {
        $db = DB::getSingleObject();
        $this->connection = $db::connect();
    }

    public static function all()
    {
        $sql = "SELECT * FROM " . (new static)->getTableName();
        $response = (new static)->connection->query($sql);
        $fetching_status = $response->setFetchMode(\PDO::FETCH_ASSOC); // false || true
        if ($fetching_status) {
            return $response->fetchAll();
        }
    }

    public function getTableName()
    {
        if (!$this->tableName) {
            $class_name = get_class($this);
            $class_base_name = basename($class_name);
            $snake_case_class_name = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $class_base_name)); // user
            return $snake_case_class_name . "s";
        }
        return $this->tableName;
    }

    public static function create(array $data)
    {
        if (count($data) > 0) {
            $sql = "INSERT INTO " . (new static)->getTableName();
            $table_columns = array_keys($data); //['first_name', 'last_name', 'age', 'id_card', 'created_at']
            $table_columns_as_string = " ( " . implode(',', $table_columns) . " ) VALUES ";
            $sql .= $table_columns_as_string;
            $table_row_values = array_values($data);
            $table_row_values_formatted = [];
            foreach ($table_row_values as $value) {
                if (is_string($value)) {
                    $table_row_values_formatted[] = "'" . $value . "'";
                }
                if (is_int($value)) {
                    $table_row_values_formatted[] = $value;
                }
            }
            $table_row_values_formatted_as_string = "(" . implode(',', $table_row_values_formatted) . ");";
            $sql .= $table_row_values_formatted_as_string;
            $response = (new static)->connection->exec($sql);
        }
    }

    public static function delete(...$ids)
    {
        $sql = "DELETE FROM " . (new static)->getTableName() . " WHERE id";
        if (count($ids) === 1 && is_array($ids[0])) {
            // delete([1 ,3, 5, ....])
            $row_ids = "( " . implode(',', $ids[0]) . " )";
            $sql .= " IN " . $row_ids;
        } elseif (count($ids) > 0) {
            $sql .= " IN " . "( " . implode(',', $ids) . " )";
        }
        $response = (new static)->connection->exec($sql);
    }

    public static function findById(int $id)
    {
        $sql = "SELECT * FROM " . (new static)->getTableName() . " WHERE id = $id";
        $response = (new static)->connection->prepare($sql);
        $response->execute();
        $fetching_status = $response->setFetchMode(\PDO::FETCH_ASSOC);
        if ($fetching_status) {
            return $response->fetch();
        }
        return null;
    }

    public static function find(...$ids)
    {
        $single = false;
        $sql = "SELECT * FROM " . (new static)->getTableName() . " WHERE id";
        if (count($ids) === 1 && is_array($ids[0])) {
            $row_ids = "( " . implode(',', $ids[0]) . " )";
            $sql .= " IN " . $row_ids;
        } elseif (count($ids) === 1 && (is_int($ids[0]) || ctype_digit($ids[0]))) {
            $sql .= "=" . $ids[0];
            $single = true;
        } elseif (count($ids) > 0) {
            $sql .= " IN " . "( " . implode(',', $ids) . " )";
        }
        $response = (new static)->connection->prepare($sql);
        $response->execute();
        $fetching_status = $response->setFetchMode(\PDO::FETCH_ASSOC);
        if ($fetching_status && $single) {
            return $response->fetch();
        }
        if ($fetching_status && !$single) {
            return $response->fetchAll();
        }
        return null;
    }


    public static function whereOne(array $params)
    {
        // ['name', '=', 'value']
        $part_sql = $params[0] . " " . $params[1] . " '" . $params[2] . "'";
        $sql = "SELECT * FROM " . (new static)->getTableName() . " WHERE " . $part_sql . " LIMIT 1";
        $response = (new static)->connection->prepare($sql);
        $response->execute();
        $fetching_status = $response->setFetchMode(\PDO::FETCH_ASSOC);
        if ($fetching_status) {
            return $response->fetch();
        }
        return null;
    }


    public static function update(array $data,int  $id){
        $sql = "SELECT * FROM " . (new static)->getTableName() ;
        $response = (new static)->connection->prepare($sql);
        $response->execute();
        $fetching_status = $response->setFetchMode(\PDO::FETCH_ASSOC); // false || true
        if ($fetching_status) {
            $values = $response->fetch();
        }
        $keys = array_keys($values);


        $sql = "UPDATE ". (new static)->getTableName() ." SET ";
        $table_columns = array_values($data);
        $array = [];
        if(count($values) == count($keys)){
            for($i=0;$i < count($values); $i++){
                $array[]= $keys[$i]."='".$table_columns[$i]."'";
            }
            $codes = implode(",",$array);
        }
        $sql .= $codes . " WHERE id = $id;";
        $response = (new static)->connection->prepare($sql);
        $response->execute();
    }


}