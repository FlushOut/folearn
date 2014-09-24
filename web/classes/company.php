<?php
class company
{
    protected $table = "companies";

    public $id = 0;
    public $fk_country;
    public $name;
    public $logo;
    public $logo_type;
    public $status;
    public $status_payment;
    
    public $create_date;
    public $create_user;
    public $update_date;
    public $update_user;

    function company(){
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
            $this->logo = $query[0]['logo'];
            $this->logo_type = $query[0]['logo_type'];
            $this->status = $query[0]['status'];
            $this->status_payment = $query[0]['status_payment'];

            return true;
        }
    }

    function save($name, $foto, $type)
    {
        $pont = fopen($foto, "rb");
        $fotoFinal = fread($pont,filesize($foto));
        fclose($pont);
        $fotoFinal = addslashes($fotoFinal);

        $dados["name"] = $name;
        $dados["logo"] = $fotoFinal;
        $dados["logo_type"] = $type;
        
        if ($this->id > 0) {
            $dados["id"] = $this->id;
            return $this->con->update($this->table,$dados);
        } else {
            return $this->con->insert($this->table,$dados);
        }
    }

    function create($name, $fk_country)
    {
        $dados["fk_country"] = $fk_country;
        $dados["name"] = $name;
        $dados["status"] = 1;
        $dados["status_payment"] = 1;

        return $this->con->insert($this->table,$dados);
    }

}