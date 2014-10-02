<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class dashboard
{

    function dashboard(){
        $this->con = new DataBase();
    }
    
    function format_date($strDate)
    {
        $Y = substr($strDate, 0, 4);
        $m = substr($strDate, 5, 2);
        $d = substr($strDate, 8, 2);

        $G = substr($strDate, 11, 2);
        $i = substr($strDate, 14, 2);
        $s = substr($strDate, 17, 2);

        return "$d/$m/$Y at $G:$i:$s";
    }

    function sendEmail($fromName, $fromEmail, $to, $subject, $body)
    {   


        $headers = "From: $fromName $fromEmail\r\n";
        $headers .= "X-Mailer: PHP5\n";
        $headers .= 'MIME-Version: 1.0' . "\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        if (mail($to,$subject,$body,$headers)){
            return true;
        } else {
            return false;
        }
    }

    function getTopUsersByCompany($fk_company)
    {
        return $query = $this->con->genericQuery("select u.name as user, ur.average, ur.quantity from user_rankings ur inner join users u on ur.fk_user = u._id where u.fk_company =".$fk_company."  and (ur.average <= 3.4) order by ur.average ASC, ur.quantity DESC LIMIT 5");
    }

    function getBadUsersByCompany($fk_company)
    {
        return $query = $this->con->genericQuery("select u.name as user, ur.average, ur.quantity from user_rankings ur inner join users u on ur.fk_user = u._id where u.fk_company =".$fk_company."  and (ur.average >= 3.5) order by ur.average DESC, ur.quantity DESC LIMIT 5");
    }
}

