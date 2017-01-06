<?php

class Autoloader
{
    public static function loader($class)
    {
        $filename = $class . '.class.php';
        $file ='lib'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.$filename;
        if (!file_exists($file))
        {
            return false;
        }
        include $file;
    }
}