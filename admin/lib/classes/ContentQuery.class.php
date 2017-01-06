<?php

require_once 'logger.class.php';

class ContentQuery {
    
    private $pdo = null;
    private $log = null;
    private $contentlist = null;
    
    public function __construct(PDO $dbconn) {
        $this->log = Logger::getInstance();
        $this->pdo = $dbconn;        
    }

    /**
     * 
     * @return type Array with Content objects or null when nothing was found
     */
    public function getContentList() {
        try {
            $sql = 'select * from cms_content order by id';
            $this->log->log('Run query: '.$sql);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $this->contentlist = $stmt->fetchAll(PDO::FETCH_CLASS,'Content');            
        } catch (Exception $ex) {
            $this->log->log('ContentQuery select all content blocks error:'.$ex );
        }
        
        return $this->contentlist;
    }
    
    /**
     * 
     * @param Content $content
     * @return \Content
     */
    public function saveContent(Content $content) {
        
        $id = $content->getid();
        
        $ownid = $content->getOwnID();
        $text = $content->getContent();
        $title = $content->getTitle();
        $languageid = $content->getLanguageID();
        $status = $content->getStatus();
        $authorid = $content->getAuthorID();
        $createdon = $content->getCreatedOn();
        $changedon = $content->getChangedOn();
        $active = $content->getActive();
        if( $ownid == null || trim($ownid) == '' ) {
            $ownid .= $id;
            $content->setOwnID($ownid);
        }
        
        $timestamp = date("Y-m-d H:i:s");  // YYYY-MM-DD HH:MM:SS
        
        $this->log->log('ContentQuery save content details. ID: '.$id );
        
        if( $id != null && $id > 0 ) {
            // Update
            try {
                $sql = 'update cms_content set title = ?, ownid = ?, languageid = ?, active = ?, changedon = ?, content = ? where id = ? ';
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam (1, $title, PDO::PARAM_STR);                
                $stmt->bindParam (2, $ownid, PDO::PARAM_STR);
                $stmt->bindParam (3, $languageid, PDO::PARAM_INT);
                $stmt->bindParam (4, $active, PDO::PARAM_INT);
                $stmt->bindParam (5, $timestamp, PDO::PARAM_STR);
                $stmt->bindParam (6, $text, PDO::PARAM_STR);
                $stmt->bindParam (7, $id, PDO::PARAM_INT);
                $stmt->execute();
                
            } catch (Exception $ex) {
                $this->log->log('ContentQuery update error:'.$ex );
            }

        } else {
            // Insert
            try {
                $sql = 'insert into cms_content (ownid, content, title, languageid, status, authorid, createdon, changedon, active) values (?,?,?,?,?,?,?,?,?)';
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam (1, $ownid, PDO::PARAM_STR);
                $stmt->bindParam (2, $text, PDO::PARAM_STR);
                $stmt->bindParam (3, $title, PDO::PARAM_STR);
                $stmt->bindParam (4, $languageid, PDO::PARAM_STR);
                $stmt->bindParam (5, $status, PDO::PARAM_INT);
                $stmt->bindParam (6, $authorid, PDO::PARAM_INT);
                $stmt->bindParam (7, $timestamp, PDO::PARAM_STR);
                $stmt->bindParam (8, $timestamp, PDO::PARAM_STR);
                $stmt->bindParam (9, $active, PDO::PARAM_INT);
                $stmt->execute();
                
                $sql = 'SELECT LAST_INSERT_ID() as lastid';
                $row = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
                $lastid = $row['lastid'];
                $content->setid($lastid);
            } catch (Exception $ex) {
                $this->log->log('ContentQuery insert error:'.$ex );
            }
        }
        
        return $content;
    }
    
    
    /**
     * 
     * @param type $id
     * @return \Content
     */
    public function getContentByID(int $id) {
        
        $content = new Content();
        
        $this->log->log('ContentQuery getContentByID:'.$id );
        try {
            $sql = 'select * from cms_content where id = ?';
            $this->log->log('ContentQuery query:'.$sql );
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam (1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Content');
            $content = $stmt->fetch();
        } catch (Exception $ex) {
            $this->log->log('ContentQuery select error:'.$ex );
            $this->log->log('ContentQuery id:'.$id );
        }        
        
        return $content;
    }
}
 