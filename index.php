<?php

//Remove request parameters:
list($path) = explode('?', $_SERVER['REQUEST_URI']);

//Remove script path:
$path = substr($path, strlen(dirname($_SERVER['SCRIPT_NAME']))+1);
//Explode path to directories and remove empty items:
$pathInfo = array();
foreach (explode('/', $path) as $dir) {
    if (!empty($dir)) {
        $pathInfo[] = urldecode($dir);
    }
}
if (count($pathInfo) > 0) {
    //Remove file extension from the last element:
    $last = $pathInfo[count($pathInfo)-1];
    list($last) = explode('.', $last);
    $pathInfo[count($pathInfo)-1] = $last;
}