<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class payment
{

    protected $table = "payments";

    public $id = 0;
    public $sequence;
    public $fk_company;
    public $date_start;
    public $date_end;
    public $invoice;
    public $lessons;
    public $type;
    public $status;
  
    function payment(){
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
            $this->sequence = $query['sequence'];
            $this->fk_company = $query['fk_company'];
            $this->date_start = $query['date_start'];
            $this->date_end = $query['date_end'];
            $this->invoice = $query['invoice'];
            $this->lessons = $query['lessons'];
            $this->type = $query['type'];
            $this->status = $query['status'];
            return true;
        }
    }

    function byCompany($fkcompany)
    {
        $result = $this->con->genericQuery("select * from " . $this->table . " where fk_company = '$fkcompany' order by sequence DESC limit 1");
        $query = $result[0];

        if (count($query) == 0){
            return false;
        }else {
            $this->id = $query['_id'];
            $this->sequence = $query['sequence'];
            $this->fk_company = $query['fk_company'];
            $this->date_start = $query['date_start'];
            $this->date_end = $query['date_end'];
            $this->invoice = $query['invoice'];
            $this->lessons = $query['lessons'];
            $this->type = $query['type'];
            $this->status = $query['status'];
            return true;
        }
    }

    function getDashboardAccountStat($fkcompany){
        $result = $this->con->genericQuery("select month(date_start) AS `dateMonth`, invoice, lessons from " . $this->table . " where fk_company = '$fkcompany' ORDER BY date_start ASC limit 7");
        return $result;
    }

    function createFree($fk_company)
    {
        $dtS = date("Y-m-d");

        $stE = strtotime($dtS ."+ 30 days");
        $dtE = date("Y-m-d",$stE); 

        $dados["sequence"] = 1;
        $dados["fk_company"] = $fk_company;
        $dados["date_start"] = addslashes($dtS);
        $dados["date_end"] = addslashes($dtE);
        $dados["invoice"] = 0;
        $dados["lessons"] = 0;
        $dados["type"] = "F";
        $dados["status"] = 1;

        $idPayment = $this->con->insert($this->table,$dados);
        return $idPayment; 

        
    }

    function getByDate($fk_company,$dtIni,$dtEnd){
        $query = $this->con->genericQuery("select * from " . $this->table . " where fk_company = {$fk_company} and (date_start between STR_TO_DATE('".$dtIni."','%m-%Y') and STR_TO_DATE('".$dtEnd."','%m-%Y')) order by date_start");
        $objReturn = array();

       foreach ($query as $value) {
            $py = new payment();
            $py->open($value);
            $objReturn[] = $py;
        }

        return $objReturn;

    }    
}