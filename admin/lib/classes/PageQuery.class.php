<?php

require_once 'logger.class.php';
require_once 'Page.class.php';
require_once 'Content.class.php';

class PageQuery {
    
    private $pdo = null;
    private $log = null;
    private $apage = null;
    private $pagelist = null;
    
    public function __construct(PDO $dbconn) {
        $this->log = Logger::getInstance();
        $this->pdo = $dbconn;        
    }

    /**
     * 
     * @param type $apage The Page object
     */
    public function savePageDetails(Page $ap) {
        
        $id = $ap->getID();
        $title = $ap->getTitle();
        $url = $ap->getURL();
        $authorid = $ap->getAuthorID();
        $active = $ap->getActive();
        $content = $ap->getContent();
        $timestamp = date("Y-m-d H:i:s");  // YYYY-MM-DD HH:MM:SS
        
        $this->log->log('PageQuery save page details. Page ID: '.$id );
        
        if( $id == null && $id < 1) {   // Check on the default -1 value.
            try {
                // Insert
                $sql = 'insert into cms_page (id, title, url, authorid, active, createdon, changedon, content) values (?,?,?,?,?,?,?,?)';
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam (1, $id, PDO::PARAM_INT);
                $stmt->bindParam (2, $title, PDO::PARAM_STR);                
                $stmt->bindParam (3, $url, PDO::PARAM_STR);
                $stmt->bindParam (4, $authorid, PDO::PARAM_INT);
                $stmt->bindParam (5, $active, PDO::PARAM_INT);
                $stmt->bindParam (6, $timestamp, PDO::PARAM_STR);
                $stmt->bindParam (7, $timestamp, PDO::PARAM_STR);
                $stmt->bindParam (8, $content, PDO::PARAM_STR);
                $stmt->execute();
                
                $sql = 'SELECT LAST_INSERT_ID() as lastid';
                $row = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
                $lastid = $row['lastid'];
                $ap->setID($lastid);
                
            } catch (Exception $ex) {
                $this->log->log('PageQuery insert error:'.$ex );
            }
        } else {
            try {
                // Update
                $sql = 'update cms_page set title = ?, url = ?, active = ?, changedon = ?, content = ? where id = ? ';
                // $this->log->log('PageQuery update statement:'.$sql );
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam (1, $title, PDO::PARAM_STR);
                $stmt->bindParam (2, $url, PDO::PARAM_STR);
                $stmt->bindParam (3, $active, PDO::PARAM_INT);
                $stmt->bindParam (4, $timestamp, PDO::PARAM_STR);
                $stmt->bindParam (5, $content, PDO::PARAM_STR);
                $stmt->bindParam (6, $id, PDO::PARAM_INT);
                $stmt->execute();
            } catch (Exception $ex) {
                $this->log->log('PageQuery update error:'.$ex );
            }
        }
        
        return $ap;
    }
    
    /**
     * 
     * @param int $id
     * @return \Page
     */
    public function getPageByID(int $id) {

        // Get all the page details
        $this->log->log('PageQuery getPageByID:'.$id );
        try {
            $query = 'select * from cms_page where id = ?';
            $this->log->log('PageQuery query:'.$query );
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam (1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
            $this->apage = $stmt->fetch();
            $this->log->log($this->apage->getid().'Current page content = '.$this->apage->getContent() );
        } catch (Exception $ex) {
            $this->log->log('PageQuery select error:'.$ex );
            $this->log->log('PageQuery page id:'.$id );
        }
        
        if( $this->apage != null ) {
            // Get the content blocks attached to this page (if any)
            try {
                $query = 'select * from cms_content where cms_content.id in (select contentid from cms_pagecontent where pageid = ?)';
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam (1, $id, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Content');
                $content_blocks = $stmt->fetchAll();
                $this->apage->setContentBlocks($content_blocks);
            } catch (Exception $ex) {
                $this->log->log('PageQuery select error:'.$ex );
                $this->log->log('PageQuery page id:'.$id );
            }
        }
        return $this->apage;
    }
    
    /**
     * Get a list of all pages available.
     * @return Array Holding Page objects or null when no result was found
     */
    public function getPageList() {
        try {
            $query = 'select * from cms_page order by id';
            
            $this->log->log('Run query: '.$query);
            
            $stmt = $this->pdo->prepare($query);            
            $stmt->execute();
            $this->pagelist = $stmt->fetchAll(PDO::FETCH_CLASS,'Page');            
        } catch (Exception $ex) {
            $this->log->log('PageQuery select all pages error:'.$ex );
            $this->pagelist = null;
        }
        
        return $this->pagelist;
    }    
}
 