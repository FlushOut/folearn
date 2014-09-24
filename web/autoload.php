<?php
function my_autoload($pClassName)
{
    if (is_file("../classes/" . $pClassName . ".php")) {
        require_once("../classes/" . $pClassName . ".php");
    } else if (is_file("../sys/" . $pClassName . ".php")) {
        require_once("../sys/" . $pClassName . ".php");
    } else {
        die("'" . $pClassName . "' class was called, but the file was not encountered.");
    }
}

spl_autoload_register("my_autoload");
?>