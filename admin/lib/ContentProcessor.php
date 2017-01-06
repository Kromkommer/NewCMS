<?php
$log = Logger::getInstance();


if (isset($action) && $action != null ) {

    $db_conn = new DBConnection();
    $pdo = $db_conn->getPDOConnection();
    $ctntqry = new ContentQuery($pdo);    
    $currentContent = new Content();
    
    $ctid_post = filter_input(INPUT_POST, 'content_id');
    $ctid_get = filter_input(INPUT_GET, 'content_id');
    
    if(isset($ctid_post) && is_numeric($ctid_post)) {
        $ctid = (int)$ctid_post;
        $currentContent->setid($ctid);
    } else if(isset($ctid_get) && is_numeric($ctid_get)) {
        $ctid = (int)$ctid_get;
        $currentContent->setid($ctid);
    } else {
        $ctid = null;
    }
    
    switch ($action) {
        
        case "content":
            
            $contentlist = $ctntqry->getContentList();
            
            break;
        
        case "newcontent":

            
            
            break;


        case "save_content_details":
            
            $text = filter_input(INPUT_POST, 'content_data');
            $ownid = filter_input(INPUT_POST, 'content_ownid');
            $title = filter_input(INPUT_POST, 'content_title');
            $languageid = filter_input(INPUT_POST, 'languageid');
            $status = filter_input(INPUT_POST, 'status');
            $authorid = filter_input(INPUT_POST, 'authorid');
            $active = filter_input(INPUT_POST, 'active');
            
            $currentContent->setOwnID($ownid);
            $currentContent->setContent($text);
            $currentContent->setTitle($title);
            $currentContent->setLanguageID($languageid);
            $currentContent->setStatus($status);
            $currentContent->setAuthorID($authorid);
            $currentContent->setActive($active);
            
            // The object is returned with the new ID in case it's an insert statement.
            $currentContent = $ctntqry->saveContent($currentContent);

            break;
        
        
        case "editcontent":
            
            $currentContent = $ctntqry->getContentByID($ctid);
            
            break;
        
    }
}