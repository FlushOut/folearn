<?php
/**
 * Created by JetBrains PhpStorm.
 * User: john borrego
 * Date: 16/04/14
 * Time: 22.30
 * To change this template use File | Settings | File Templates.
 */

class discount
{

    protected $table = "discounts";

    public $id = 0;
    public $fk_company;
    public $code;
    public $percent;
    public $condition_start;
    public $condition_end;
    public $status;

    public $create_date;
    public $create_user;
    public $update_date;
    public $update_user;
  
    function discount(){
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
            $this->fk_company = $query['fk_company'];
            $this->code = $query['code'];
            $this->percent = $query['percent'];
            $this->condition_start = $query['condition_start'];
            $this->condition_end = $query['condition_end'];
            $this->status = $query['status'];

            return true;
        }
    }

    function save($fk_company, $code, $percent, $condition_start, $condition_end)
    {
        $now = new DateTime();
        $dadosS["fk_company"] = $fk_company;
        $perc = round($percent/100,2);
        if(strlen(rtrim($code))>0) $dadosS["code"] = addslashes($code);
        if(strlen(rtrim($perc))>0) $dadosS["percent"] = addslashes($perc);
        if(strlen(rtrim($condition_start))>0) $dadosS["condition_start"] = addslashes($condition_start);
        if(strlen(rtrim($condition_end))>0) $dadosS["condition_end"] = addslashes($condition_end);
        $dadosS["create_date"] = addslashes($now->format('Y-m-d H:i:s'));
        $dadosS["status"] = 1;

       if ($this->id > 0) {
            $dadosS["_id"] = $this->id;
            return $this->con->update($this->table,$dadosS);
        } else {
            return $this->con->insert($this->table,$dadosS);
        }
    }

    function list_discounts($fk_company)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where fk_company = '$fk_company' and status=1");

        $objReturn = array();

        foreach ($query as $value) {
            $discount = new discount();
            $discount->open($value);
            $objReturn[] = $discount;
        }

        return $objReturn;
    }

    function list_DiscountsById($id)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where _id in ({$id})");

        $objReturn = array();

        foreach ($query as $value) {
            $discount = new discount();
            $discount->open($value);
            $objReturn[] = $discount;
        }

        return $objReturn;
    }

    function del()
    {
        $query = $this->con->genericQuery("delete from " . $this->table . " where _id=" . $this->id);
    }
}