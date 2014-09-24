<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 04/10/13
 * Time: 09:27
 * To change this template use File | Settings | File Templates.
 */

class DataBase extends PDO{

    protected $config;
    protected $db;
    

    public function __construct(){}
    private function __clone(){}
    public function __destruct() {
        $this->disconnect();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
    private function connect()
    {
        global $config;
        $this->config = $config;
        $dsn = "mysql:host=".$this->config['bd']['host'].";port=".$this->config['bd']['port'].";dbname=".$this->config['bd']['base'];
        $user = $this->config['bd']['user'];
        $password = $this->config['bd']['password'];
        try {
            $this->db = new PDO($dsn, $user, $password,array(
                PDO::ATTR_PERSISTENT => false));
        }
        catch( PDOException $e ) {
            echo $e->getMessage();
        }
        return ($this->db);
    }

    private function disconnect()
    {
        $this->db = null;

    }

    /*
     * CRUD
     */
    public function select($table,$columns = "*", $where = "",$orderbyfields = NULL,$order = NULL,$staring = NULL,$ending = NULL,$groupby = NULL)
    {
        $sql="select";
        $sql.=' '.$columns;
        $sql.=" from .$table";
        if (count($where) > 0) {
            $i = 0;
            foreach ($where as $item) {
                $sql .= (($i == 0) ? " WHERE " : " AND ");
                $i = 1;
                $sql .= $item;
            }
        }
        if(isset($groupby))
            $sql.=" GROUP BY $groupby";
        if(isset($orderbyfields))
            $sql.=" ORDER BY $orderbyfields $order";
        if(isset($staring))
            $sql.=" LIMIT $staring,$ending";
        $this->sql=$sql;
        $exec = $this->connect()->prepare($sql);
        $obj = array();
        foreach($this->connect()->query($exec) as $row)
            $obj[] = $row;
        self::__destruct();
        if (!empty($obj))
            return $obj;
        else
            return null;
    }
    public function insert($table,$values)
    {
        $fieldsSQL = array();
        $valuesSQL = array();
        foreach ($values as $field => $value) {
            $fieldsSQL[] = $field;            
            $valuesSQL[] = $value;
        }

        $array = array_combine($fieldsSQL,$valuesSQL);
        $key = implode(',', array_keys($array));
        $val = ':' . str_replace(',', ',:', $key);
        $insert = $this->connect()->prepare("INSERT INTO {$table} ({$key}) VALUES({$val})");
        $insert->execute($array);
        return $this->db->lastInsertId();   
        
        self::__destruct();
        if($insert->rowCount() == 0){
            return 0;
        }
        
    }

    public function update($table,$values)
    {
        $updateSQL = null;
        $id = 0;
        foreach ($values as $key => $value) {
            if ($key == "_id") {
                $id = $value;
            } else {
                $updateSQL .= ($updateSQL ? ',' : '');
                $updateSQL .= $key . "='" . $value."'";
            }
        }
        $update = $this->connect()->prepare("UPDATE " . $table . " SET " . $updateSQL . " WHERE _id=" . $id);
        try{
            $update->execute();
            return $update->rowCount();
            
        }catch (Exception $e){
            return $e->getMessage();
        }
            self::__destruct();
            

    }
    public function genericQuery($query)
    {
        $this->connect()->prepare($query);
        $obj = array();
        foreach($this->connect()->query($query) as $row){
            $obj[] = $row;
        }
        self::__destruct();
        if (!empty($obj))
            return $obj;
        else
            return null;
    }
}

?>