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
}

