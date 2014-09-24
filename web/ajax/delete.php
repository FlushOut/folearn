<?php require_once("../config.php");

$id = $_POST['id'];
switch ($_POST['source']) {
    case 'user':
        $obj = new user();
        $obj->open($id);
        $obj->del();
        break;
    default:
        # code...
        break;
}