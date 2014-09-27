<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class schedule
{

    protected $table = "schedules";

    public $id = 0;
    public $fk_user;
    public $date;
    public $status;

    public $create_date;
    public $create_user;
    public $update_date;
    public $update_user;


    public $hours = array();
    public $list_hours;

    function schedule(){
        $this->con = new DataBase();
        $this->list_hours = array(
        "00:00-01:00" => "00:00-01:00",
        "01:00-02:00" => "01:00-02:00",
        "02:00-03:00" => "02:00-03:00",
        "03:00-04:00" => "03:00-04:00",
        "04:00-05:00" => "04:00-05:00",
        "05:00-06:00" => "05:00-06:00",
        "06:00-07:00" => "06:00-07:00",
        "07:00-08:00" => "07:00-08:00",
        "08:00-09:00" => "08:00-09:00",
        "09:00-10:00" => "09:00-10:00",
        "10:00-11:00" => "10:00-11:00",
        "11:00-12:00" => "11:00-12:00",
        "12:00-13:00" => "12:00-13:00",
        "13:00-14:00" => "13:00-14:00",
        "14:00-15:00" => "14:00-15:00",
        "15:00-16:00" => "15:00-16:00",
        "16:00-17:00" => "16:00-17:00",
        "17:00-18:00" => "17:00-18:00",
        "18:00-19:00" => "18:00-19:00",
        "19:00-20:00" => "19:00-20:00",
        "20:00-21:00" => "20:00-21:00",
        "21:00-22:00" => "21:00-22:00",
        "22:00-23:00" => "22:00-23:00",
        "23:00-00:00" => "23:00-00:00"
        );  
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
            $this->fk_user = $query['fk_user'];
            $this->date = $query['date'];
            $this->status = $query['status'];
            
            $this->create_date = $query['create_date'];
            $this->create_user = $query['create_user'];
            $this->update_date = $query['update_date'];
            $this->update_user = $query['update_user'];

            $query_hours = $this->con->genericQuery("select CONCAT(`start`, '-', `end`) as `interval` from schedule_details where fk_schedule = " . $this->id);

            if (count($query_hours) > 0) {
                foreach ($query_hours as $value) {
                    array_push($this->hours,$value['interval']);
                }
            }
            return true;
        }
    }
    function openByUserDate($idUser, $dtSchedule)
    {
        if(!is_array($query)){
            $result = $this->con->genericQuery("select * from " . $this->table . " where fk_user = ".$idUser." and date='".$dtSchedule."'");    
            $query = $result[0];
        }
        if (count($query) == 0)
            return false;
        else {
            $this->id = $query['_id'];
            $this->fk_user = $query['fk_user'];
            $this->date = $query['date'];
            $this->status = $query['status'];
            
            $this->create_date = $query['create_date'];
            $this->create_user = $query['create_user'];
            $this->update_date = $query['update_date'];
            $this->update_user = $query['update_user'];

            $query_hours = $this->con->genericQuery("select CONCAT(`start`, '-', `end`) as `interval` from schedule_details where fk_schedule = " . $this->id);

            if (count($query_hours) > 0) {
                foreach ($query_hours as $value) {
                    array_push($this->hours,$value['interval']);
                }
            }

            return true;
        }
    }
    

    function save($fk_user, $date, $hours)
    {
        $now = new DateTime();
        $dadosS["fk_user"] = $fk_user;
        $dadosS["date"] = addslashes($date);
        $dadosS["create_date"] = addslashes($now->format('Y-m-d H:i:s'));
        $dadosS["status"] = 1;
        if ($this->id > 0) {
            $dadosS["_id"] = $this->id;
            if($this->con->update($this->table,$dadosS) > 0){
                return $this->saveHours($this->id,$hours);
            }
        } else {
            $idSchedule = $this->con->insert($this->table,$dadosS);
            if($idSchedule > 0){
                return $this->saveHours($idSchedule, $hours);
            }
        }
    }

    function saveHours($idSchedule, $hours)
    {
        $query = "delete from schedule_details where fk_schedule=". $idSchedule;
        $this->con->genericQuery($query);
        foreach ($hours as $value) {
            list($start, $end) = split('[-]', $value); 
            $query = "insert into schedule_details(fk_schedule, start, end, status)
                      values(".$idSchedule.",'".$start."','".$end."',1)";
            $this->con->genericQuery($query);
        }
        return true;   
    }

    function del()
    {
        $query = $this->con->genericQuery("delete from " . $this->table . " where _id=" . $this->id);
        $querydet = $this->con->genericQuery("delete from schedule_details where fk_schedule=" . $this->id);
    }

    function getSchedulesByIdMonth($idUser,$month)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where fk_user = ".$idUser." and MONTH(date)='".$month."'");

        $objReturn = array();

        foreach ($query as $value) {
            $sche = new schedule();
            $sche->open($value);
            $objReturn[] = $sche;
        }

        return $objReturn;
    }

    function getByUserDate($idUsers,$dtStart,$dtEnd)
    {
        return $query = $this->con->genericQuery("select s._id as id, u.name as user, DATE_FORMAT(s.date,'%d/%m/%Y') as date, MONTHNAME(s.date) as month, DAYNAME(s.date) as day, COUNT(s._id) AS hours from " . $this->table . " s inner join users u on s.fk_user = u._id inner join schedule_details sd on s._id = sd.fk_schedule where s.fk_user in ({$idUsers}) and (s.date between STR_TO_DATE(  '".$dtStart."',  '%d-%m-%Y' ) and STR_TO_DATE(  '".$dtEnd."',  '%d-%m-%Y' )) group by s.fk_user, s.date");
    }

    


}