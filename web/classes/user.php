<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class user
{

    protected $table = "users";

    public $id = 0;
    public $fk_company;
    public $name;
    public $email;
    public $password;
    public $phone;
    public $code_conf;
    public $status_conf;
    public $status;

    public $create_date;
    public $create_user;
    public $update_date;
    public $update_user;
    public $profiles = array();
    public $disciplines = array();

    function user(){
        $this->con = new DataBase();
    }

    function login($email, $password)
    {
        $email = addslashes($email);
        $password = md5($password);
        $us = NULL;

        $query = $this->con->genericQuery("select * from " . $this->table . " where status=1 and email='". $email ."' and password='" . $password . "'");

        if (count($query) == 0){
            return false;
        }
        else {
            $u = new user();
            $u->open($query[0]['_id']);
            $us = $u;
        }

        return $us;
    }

     function open($query)
    {
        if(!is_array($query)){

            if(is_numeric($query))
                $result = $this->con->genericQuery("select * from " . $this->table . " where _id = $query");    
            else
                $result = $this->con->genericQuery("select * from " . $this->table . " where email = '$query'");

            $query = $result[0];
                
        }
        if (count($query) == 0)
            return false;
        else {
            $this->id = $query['_id'];
            $this->code_conf = $query['code_conf'];
            $this->name = $query['name'];
            $this->email = $query['email'];
            $this->phone = $query['phone'];
            $this->status = $query['status'];
            $this->status_conf = $query['status_conf'];
            $this->fk_company = $query['fk_company'];

            $this->create_date = $query['create_date'];
            $this->create_user = $query['create_user'];
            $this->update_date = $query['update_date'];
            $this->update_user = $query['update_user'];

            $query_profiles = $this->con->genericQuery("select fk_profile from user_profiles 
                                                        where fk_user = " . $this->id);
            
            if (count($query_profiles) > 0) {
                foreach ($query_profiles as $value) {
                    if($value['fk_profile'] == 2){
                        $query_disciplines = $this->con->genericQuery("select CONCAT(`fk_discipline`, ' - ', `price`) as `disciplines_price` from user_disciplines 
                                                        where fk_user = " . $this->id);
                        if (count($query_disciplines) > 0) {
                            foreach ($query_disciplines as $vdisc) {
                                array_push($this->disciplines,$vdisc['disciplines_price']);
                            }
                        }
                    }
                    array_push($this->profiles,$value['fk_profile']);
                }
            }

            return true;
        }
    }

    function save($fk_company, $name, $email, $phone, $password)
    {
        $now = new DateTime();
        $dadosS["fk_company"] = $fk_company;
        if(strlen(rtrim($name))>0) $dadosS["name"] = addslashes($name);
        if(strlen(rtrim($email))>0) $dadosS["email"] = addslashes($email);
        if(strlen(rtrim($phone))>0) $dadosS["phone"] = addslashes($phone);
        if(strlen(rtrim($password))>0) $dadosS["password"] = md5($password);
        $dadosS["create_date"] = addslashes($now->format('Y-m-d H:i:s'));
        $dadosS["status"] = 1;
        if ($this->id > 0) {
            $dadosS["_id"] = $this->id;
            return $this->con->update($this->table,$dadosS);
        } else {
            return $this->con->insert($this->table,$dadosS);
        }
        
    }

    function saveProfiles($idUser, $profiles)
    {
        $query = "delete from user_profiles where fk_user=" . $idUser;
        $this->con->genericQuery($query);
        $first = true;
        foreach ($profiles as $value) {
            $first_prof = 0;
            if($first){
                $first_prof = 1;
                $first = false;
            }
            
            $query = "insert into user_profiles(fk_user,fk_profile,first_profile)
                      values(".$idUser.",".$value.",".$first_prof.")";
            $this->con->genericQuery($query);
        }   
    }

    function saveDiscplines($idUser, $disciplines_price)
    {
        $query = "delete from user_disciplines where fk_user=" . $idUser;
        $this->con->genericQuery($query);
        $first = true;
        foreach ($disciplines_price as $value) {
            list($discpline, $price) = split(' - ', $value);
            $query = "insert into user_disciplines(fk_user,fk_discipline,price)
                      values(".$idUser.",".$discpline.",".$price.")";
            $this->con->genericQuery($query);
        }   
    }
    
    function list_users($fk_company)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where fk_company = '$fk_company'");

        $objReturn = array();

        foreach ($query as $value) {
            $user = new user();
            $user->open($value);
            $objReturn[] = $user;
        }

        return $objReturn;
    }

    function del()
    {
        $query = $this->con->genericQuery("delete from " . $this->table . " where _id=" . $this->id);
    }

    function list_profiles()
    {
        return $query = $this->con->genericQuery("select * from profiles where status = 1");        
    }

    function createAdmin($fk_company, $name, $email, $phone, $password)
    {
        $now = new DateTime();
        $dadosC["fk_company"] = $fk_company;
        $dadosC["name"] = addslashes($name);
        $dadosC["email"] = addslashes($email);
        $dadosC["phone"] = addslashes($phone);
        $dadosC["password"] = md5($password);
        $dadosC["create_date"] = addslashes($now->format('Y-m-d H:i:s'));
        $dadosC["status"] = 1;
        $dadosC["status_conf"] = 0;

        $idUser = $this->con->insert($this->table,$dadosC);
        $admin = array(1); 
        $this->saveProfiles($idUser,$admin);

        return $idUser;
    }

    function vEmail($id, $code)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where _id=" . $id . " and code_conf=" . $code);
        if (count($query) == 0){
            return false;
        }else{
            $uv = NULL;
            $dadosV["_id"] = $id;
            $dadosV["status_conf"] = 1;
            $up = $this->con->update($this->table,$dadosV);    
            if($up > 0){
                $objReturn = array();
                foreach ($query as $value) {
                    $user = new user();
                    $user->open($value);
                    $objReturn[] = $user;
                }
                return $objReturn[0];    
            }else{
                return false;
            }
        }
    }
    
    function sendCode($idUser, $email)
    {   

        $fromName = "FlushOut Contact";
        $fromEmail = "contact@flushoutsolutions.com";
        $code =  rand(1000,9999);

        $headers = "From: $fromName $fromEmail\r\n";
        $headers .= "X-Mailer: PHP5\n";
        $headers .= 'MIME-Version: 1.0' . "\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
        $subject = "Code Confirmation";
        $body = "<div marginheight='0' marginwidth='0' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif;line-height:21px;color:#404040'>";
        $body .= "<div style='max-width:650px;margin:0 auto;padding:20px 0'>";
        $body .= "<table width='100%' cellpadding='0' cellspacing='0' border='0' style='font-family:Helvetica,Arial;font-size:12px;color:#404040'>";
        $body .= "  <tbody>";
        $body .= "   <tr>";
        $body .=    "  <td width=100%'>";   
        $body .= "<table bgcolor='#FFFFFF' width='97%' cellpadding='0' cellspacing='0' border='0' align='center' style='border-radius:4px;font-family:Helvetica,Arial;font-size:12px;color:#404040;border:1px solid #ddd'>";
        $body .= "    <tbody>";
        $body .= "       <tr>";
        $body .= "                    <td width='100%''>";
        $body .= "                        <table width='100%' cellpadding='0' cellspacing='0' border='0' style='font-family:Helvetica,Arial;font-size:12px;color:#404040'>";
        $body .= "                            <tbody>";
        $body .= "                                <tr>";
        $body .= "                                    <td bgcolor='#f2f2f2' width='100%'' style='border-radius:3px 3px 0px 0px;font-size:34px;font-weight:700;letter-spacing:-1px;border-bottom-style:solid;border-bottom-color:#ddd;border-bottom-width:1px;padding:20px 20px 20px'>";
        $body .= "                                        <img src='http://learn.flushoutsolutions.com/img/flushout-logo.png' width='120' height='76' alt='FlushOut' style='display:block;border:0'>";
        $body .= "                                    </td>";
        $body .= "                                </tr>";
        $body .= "                                <tr>";
        $body .= "                                    <td width='100%' style='padding:30px 30px 20px'>";           
        $body .= "                                       <h1 style='font-size:24px;font-weight:700;margin:0 0 5px;padding:0 0 6px;border:0;color:#404040 !important'>Welcome! Please validate your email</h1>";
        $body .= "                                        <div>Thanks for signing up with FOLearn! Your Code is: <strong>".$code."</strong>.</div>";  
        $body .= "                                        <div style='text-align:center;padding:0' align='center'>";
        $body .= "                                            <div style='vertical-align:top;text-align:center;display:inline-block;font-size:14px;color:#ffffff;background-color:#00a5d5;border-radius:3px;margin:20px 0;padding:6px 12px' align='center'>";
        $body .= "                                                <a href='http://learn.flushoutsolutions.com/pages/verifyemail.php?user=".$idUser."' style='color:#fff!important;text-decoration:none!important;display:inline-block;background-color:#00a5d5;border:0' target='_blank'>";
        $body .= "                                                Validate Account";
        $body .= "                                                </a>"; 
        $body .= "                                            </div>";
        $body .= "                                        </div>";
        $body .= "                                    </td>";
        $body .= "                                </tr>";
        $body .= "                            </tbody>";
        $body .= "                        </table>";
        $body .= "                    </td>";
        $body .= "                </tr>";
        $body .= "            </tbody>";
        $body .= "        </table>";
        $body .= "        </td>";
        $body .= "        </tr>";
        $body .= "        </tbody>";
        $body .= "        </table>";
        $body .= "        </div>";
        $body .= "        </div>";

        if ($email != '' && $code > 999){
            if (mail($email,$subject,$body,$headers)){
                $dadosSE["_id"] = $idUser;
                $dadosSE["code_conf"] = $code;
                return $this->con->update($this->table,$dadosSE);        
            } else {
                return false;
            }
        } else {
            return false;
        }   
    }

    function verifExistsEmail($email)
    {
        $query = $this->con->genericQuery("select 1 from " . $this->table . " where email = '$email'");
        if (count($query) == 0){
            return 0;
        }else{
           return 1;
        }
    }

    function verifExistsEmailUp($emailold,$emailnew)
    {
        if (rtrim($emailold) == rtrim($emailnew)) {
            return 0;
        }else{
            $query = $this->con->genericQuery("select 1 from " . $this->table . " where email = '$emailnew' and email <> '$emailold'");
            if (count($query) == 0){
                return 0;
            }else{
               return 1;
            }
        }
    }
}