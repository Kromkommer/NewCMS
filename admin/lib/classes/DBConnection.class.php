<?php

require_once 'logger.class.php';

class DBConnection{

    protected $db;
    private $log = null;
    
    private $db_host = 'localhost';
    private $db_pw = 'newcms';
    private $db_user = 'newcms';
    private $db_name = 'newcms';
    private $db_charset = 'utf8';

    /**
     * This will create a database connection.
     * Call the getPDOConnection to get the actual PDO database link in order to run queries.
     */
    public function __construct() {        
        
        $this->log = Logger::getInstance();
        
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_PERSISTENT         => true,
        ];
        
        try{
            $pdo = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name.";charset=".$this->db_charset, $this->db_user, $this->db_pw, $opt );
            $this->db = $pdo;
        } catch(PDOException $e){
            $this->log->log($e->getMessage());
            $this->db = null;
        }
    }
   
    /**
     * 
     * @return type PDO Database connection object or null if it could not be initialized.
     */
    public function getPDOConnection() {
        return $this->db;
    }
}
