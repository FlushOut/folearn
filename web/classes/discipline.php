<?php
/**
 * Created by JetBrains PhpStorm.
 * User: john borrego
 * Date: 16/04/14
 * Time: 22.30
 * To change this template use File | Settings | File Templates.
 */

class discipline
{

    protected $table = "disciplines";

    public $id = 0;
    public $fk_disc_type;
    public $description;
    public $status;

    public $create_date;
    public $create_user;
    public $update_date;
    public $update_user;
  
    function discipline(){
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
            $this->fk_disc_type = $query['fk_disc_type'];
            $this->description = $query['description'];
            $this->status = $query['status'];

            return true;
        }
    }

    function listByType($idDiscType)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where fk_disc_type = ".$idDiscType." and status=1");

        $objReturn = array();

        foreach ($query as $value) {
            $disc = new discipline();
            $disc->open($value);
            $objReturn[] = $disc;
        }

        return $objReturn;
    }
}