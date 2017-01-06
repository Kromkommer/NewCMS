<?php

/**
 * Basic logging class
 * 
 */
final class Logger {

    private static $instance = null;	 
    private $file = '';
    private function __clone() {}
    private function __construct() { }    
    
    public static function getInstance() {
      	if(self::$instance == null)
      	{
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Set the logfile name
     * @param type $logfile
     */
    public function setLogfile($logfile) {
        $this->file = $logfile;
    }
    
    /**
     * Log any content to a log file
     * @param $content any log message.
    **/
    public function log($content){
        if( LOG_ON == true ) {
            if( isset($content) && $content != null && strlen($content) > 0 ) {
                $fp = fopen($this->file,"a") or die ("Error opening file in write mode!");
                fputs($fp,$content.PHP_EOL);
                fclose($fp) or die ("Error closing file!");
            }
	}
    }
}
