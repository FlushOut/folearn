<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class lesson
{

    protected $table = "lessons";

    public $id = 0;
    public $fk_mobile;
    public $fk_client;
    public $date;
    public $client;
    public $discipline;
    public $hours;
    public $currency;
    public $value_wo_discount;
    public $value_discount;
    public $value_total;

    function lesson(){
        $this->con = new DataBase();
    }

    function open($query)
    {
        if(!is_array($query)){
            $result = $this->con->genericQuery("select * from " . $this->table . " where _id = $query");    
            $query = $result[0];
        }
        if (count($query) == 0)
            return false;
        else {
            $this->id = $query['_id'];
            $this->fk_mobile = $query['fk_mobile'];
            $this->fk_client = $query['fk_client'];
            $this->date = $query['date'];
            $this->client = $query['client'];
            $this->discipline = $query['discipline'];
            $this->hours = $query['hours'];
            $this->currency = $query['currency'];
            $this->value_wo_discount = $query['value_wo_discount'];
            $this->value_discount = $query['value_discount'];
            $this->value_total = $query['value_total'];

            return true;
        }
    }

    
    function change_status($id, $fk_less_stat)
    {
        $query = $this->con->genericQuery("update " . $this->table . " set fk_less_stat = ".$fk_less_stat." where _id = ".$id);

        return true;
    }

    function list_pend_lessons($fk_user)
    {
        $query = $this->con->genericQuery("select l._id,fk_mobile, l.fk_client, DATE_FORMAT( l.date,  '%d/%m/%Y' ) as date, c.name as client, d.description as discipline, l.hours, l.currency, l.value_wo_discount, l.value_discount, l.value_total from " . $this->table . " l inner join disciplines d on l.fk_discipline = d._id inner join clients c on l.fk_client = c._id where fk_user = ".$fk_user." and fk_less_stat = 1 order by date");

        $objReturn = array();

        foreach ($query as $value) {
            $less = new lesson();
            $less->open($value);
            $objReturn[] = $less;
        }

        return $objReturn;
    }

    function list_lesson_details($fk_client, $fk_lesson)
    {
        return $query = $this->con->genericQuery("select CONCAT(`start`, ' - ', `end`) as `interval` from lesson_details where fk_client = ".$fk_client. " and fk_lesson = ".$fk_lesson);        
    }
}