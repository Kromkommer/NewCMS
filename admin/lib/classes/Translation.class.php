<?php

require_once 'logger.class.php';

class Translation {
    
    private $language_iso2 = 'NL';
    private $language_cntry2 = 'nl';
    private $basedir = '';
    private $translations = Array();

    private $log = null;

    public function __construct($country, $language, $bd) 
    {
        $this->language_cntry2 = $country;
        $this->language_iso2 = $language;
        $this->basedir = $bd;
        $this->log = Logger::getInstance();
        $this->loadTranslation();
    }

    /**
     * Separate  function, might be useful in the future
     */
    private function loadTranslation()
    {
        $lines = file($this->basedir.DIRECTORY_SEPARATOR.$this->language_cntry2."_".$this->language_iso2.DIRECTORY_SEPARATOR."admin.properties");
        foreach($lines as $line)
        {
            // $this->log->log('TRL: '.$line );
            if( substr($line, 0, 1) != "#" && stripos($line,"=") > 0 ) {
                $pieces = explode("=", $line);
                $this->translations[trim($pieces[0])] = $pieces[1];
            }
        }
    }

    /**
     * 
     * @param type $id
     */
    public function getText($id) {
        // $this->log->log('TRL: get id: ['.$id.'] = '.$this->translations[$id] );
        if( array_key_exists($id, $this->translations ) ) {
            return trim($this->translations[$id]);
        }
        return 'Key not found ['.$id.']';
    }
}