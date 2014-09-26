<?php
/**
 * Created by JetBrains PhpStorm.
 * User: john borrego
 * Date: 16/04/14
 * Time: 22.30
 * To change this template use File | Settings | File Templates.
 */

class disciplinetype
{

    protected $table = "discipline_types";

    public $id = 0;
    public $description;
    public $status;

    public $create_date;
    public $create_user;
    public $update_date;
    public $update_user;
  
    function disciplinetype(){
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
            $this->description = $query['description'];
            $this->status = $query['status'];

            return true;
        }
    }

    function list_disc_types()
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where status=1");

        $objReturn = array();

        foreach ($query as $value) {
            $disctype = new disciplinetype();
            $disctype->open($value);
            $objReturn[] = $disctype;
        }

        return $objReturn;
    }
}