<?php

class Content {

    private $id;
    private $ownid;
    private $content;
    private $title;
    private $languageid;
    private $status;
    private $authorid;
    private $createdon;
    private $changedon;
    private $active;

    public function __construct() {

    }
    
    public function getid() {
        return $this->id;
    }
    
    public function setid($a) {
        $this->id = $a;
    }
    
    public function getOwnID() {
        return $this->ownid;
    }
    
    public function setOwnID($a) {
        $this->ownid = $a;
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function setContent($a) {
        $this->content = $a;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function setTitle($a) {
        $this->title = $a;
    }
    
    public function getLanguageID() {
        return $this->languageid;
    }
    
    public function setLanguageID($a) {
        $this->languageid = $a;
    }
    
    public function setStatus($a) {
        $this->status = $a;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setAuthorID($a) {
        $this->authorid = $a;
    }
    
    public function getAuthorID() {
        return $this->authorid;
    }
    
    public function getCreatedOn() {
        return $this->createdon;
    }
    
    public function setCreatedOn($a) {
        $this->createdon = $a;
    }
    
    public function getChangedOn() {
        return $this->changedon;
    }
    
    public function setChangedOn($a) {
        $this->changedon = $a;
    }
    
    public function getActive() {
        return $this->active;
    }
    
    public function setActive($a) {
        $this->active = $a;
    }
}