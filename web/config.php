<?php
session_start();
define('USE_PCONNECT', 'false');
error_reporting(1);
date_default_timezone_set($_COOKIE['timezone']);
require('autoload.php');
$config['debug'] = TRUE;

if ($_SERVER['SCRIPT_NAME'] != "/index.php") {
     if (!isset($_SESSION['loginsession']) && (!$ve) && (!$vee)) redirect("/index.php");
}

function curPageURL()
{
    $pageURL = '';
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return substr($pageURL, 0, 50);
}


if (strstr(curPageURL(), "d-") != false) {
    
    $config['bd']['host'] = '127.0.0.1';
    $config['bd']['user'] = 'root';
    $config['bd']['password'] = 'mysql';
    $config['bd']['base'] = 'dblearn';
    $config['bd']['port'] = '3306';
    
} else if (strstr(curPageURL(), ".com") != false) {
    $config['bd']['host'] = 'flushoutsolutionscom.ipagemysql.com';
    $config['bd']['user'] = 'learnuser';
    $config['bd']['password'] = 'Le@Rn2205';
    $config['bd']['base'] = 'dblearn';
    $config['bd']['port'] = '3306';
}

function redirect($url)
{
    die("<script>location.href='" . $url . "'</script>");
}

if (isset($_SESSION['loginsession'])) {
    $user = new user();
    $user->open($_SESSION['loginsession']);
    $company = new company();
    $company->open($user->fk_company);
    $menu = new menu();
    $isAdmin = false;
    $list_Access = $menu->getAccess($user->email);
    foreach ($list_Access as $value) {
        if (is_array($list_modules)) {
            if (in_array($value, $list_modules)) {
                continue;
            }
        }
        $list_modules[] = $value;
        if($value['fk_profile'] == 1) $isAdmin = true;
        if ($value['start_module'] == 1 and $value['first_profile'] == 1){
            $url = $value['url'];
        }
    }
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

function verify_access(){
    $access = 0;
    $URI="";
    $pos = strpos($_SERVER['REQUEST_URI'], '?');
    if ($pos <=0)
        $URI = $_SERVER['REQUEST_URI'];
    else
        $URI = substr($_SERVER['REQUEST_URI'], 0,strpos($_SERVER['REQUEST_URI'], '?'));
    foreach ($list_modules as $module) {
        if ($URI == $module['url']){
            $access += 1;
        }
    }
    if ($access <=0){
        redirect("/pages/noaccess.php");
    }
}


