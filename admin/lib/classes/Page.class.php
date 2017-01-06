<?php

/**
 * Page object which corresponds with the fields in the Page table
 * @version 1.0
 */
class Page {

    private $id;
    private $title;
    private $content;
    private $authorid;
    private $active;
    private $url;
    private $createdon;
    private $changedon;
    private $content_blocks;
    
    public function __construct() {
    }

    /**
     * Use like: get_class_vars( "Page" )
     * This is necessary to create JSON data
     * 
     * @return type 
     * @see http://php.net/manual/en/function.get-class-vars.php
     * #see http://php.net/manual/en/function.json-encode.php
     */
    public function __sleep() {
      return( get_class_vars( __CLASS__ ) );
   }
    
    public function getid() {
        return (int)$this->id;
    }
    
    public function setid($id) {
        $this->id = (int)$id;
    }
    
    public function setURL($u) {
        $this->url = $u;
    }
    
    public function getURL() {
        return $this->url;
    }
    
    public function setTitle($t) {
        $this->title = $t;
    }

    public function getTitle() {
        return $this->title;
    }
    
    public function setContent($c) {
        $this->content = $c;
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function setAuthorID($aid) {
        $this->authorid = $aid;
    }
    
    public function getAuthorID() {
        return $this->authorid;
    }
    
    public function setActive($a) {
        $this->active = $a;
    }
    
    public function getActive() {
        return $this->active;
    }
    
    public function getCreatedOn() {
        return $this->createdon;
    }
    
    public function getChangedOn() {
        return $this->changedon;
    }
    
    public function getContentBlocks() {
        return $this->content_blocks;
    }
    
    public function setContentBlocks(Array $a) {
        $this->content_blocks = $a;
    }
}