<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class country
{

    protected $table = "countries";

    public $id = 0;
    public $fk_language;
    public $currency;
    public $name;
    public $status;
  
    function country(){
        $this->con = new DataBase();
    }

    function open($query)
    {
        if(!is_array($query)){
            $result = $this->con->genericQuery("select * from " . $this->table . " where _id = '$query'");
            $query = $result[0];
        }

        if (count($query) == 0)
            return false;
        else {
            $this->id = $query['_id'];
            $this->fk_language = $query['fk_language'];
            $this->currency = $query['currency'];
            $this->name = $query['name'];
            $this->status = $query['status'];
            return true;
        }
    }

    function list_countries()
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " order by name");
        $objReturn = array();

        foreach ($query as $value) {
            $country = new country();
            $country->open($value);
            $objReturn[] = $country;
        }

        return $objReturn;
    }
}