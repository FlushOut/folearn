<?php
class client
{
    protected $table = "clients";

    public $id = 0;
    public $fk_country;
    public $name;
    public $email;
    public $phone;
    public $status;
    
    public $create_date;
    public $create_user;
    public $update_date;
    public $update_user;

    function client(){
        $this->con = new DataBase();
    }

    function open($id)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where _id = '$id'");

        if (count($query) == 0)
            return false;
        else {
            $this->id = $query[0]['_id'];
            $this->fk_country = $query[0]['fk_country'];
            $this->name = $query[0]['name'];
            $this->email = $query[0]['email'];
            $this->phone = $query[0]['phone'];
            $this->status = $query[0]['status'];

            return true;
        }
    }
}