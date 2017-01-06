<?php
$log = Logger::getInstance();
 
$active = 1;        // ToDO
$authorid = 1;      // ToDo
$pageid = -1;       // Default value or null
$content = null;
$title = null;
$url = null;        // ToDo
$currentPage = new Page();      // The current object for the page_details.php template
$currentPage->setid($pageid);

// Determine which action to take
// This processor will not generate any output, it's just here to get data and make it available for the template which will be loaded.

$log->log('Parameter \'page_id\' POST:'.filter_input(INPUT_POST,'page_id').'  GET: '.filter_input(INPUT_GET, 'page_id') );

if (isset($action) && $action != null ) {

    $db_conn = new DBConnection();
    $pdo = $db_conn->getPDOConnection();
    $pq = new PageQuery($pdo);
    
    $pgid_post = filter_input(INPUT_POST, 'page_id');
    $pgid_get = filter_input(INPUT_GET, 'page_id');
    
    if(isset($pgid_post) && is_numeric($pgid_post)) {
        $pageid = (int)$pgid_post;
        $currentPage->setID($pageid);
    } else if(isset($pgid_get) && is_numeric($pgid_get)) {
        $pageid = (int)$pgid_get;
        $currentPage->setID($pageid);
    } else {
        $pageid = null;
    }
    
    $log->log('Action = '.$action.'  Parameter page_id = :'.$pageid.' Type: '.gettype($pageid) );
    
    switch ($action) {
        
        case "save_page_details":
            
            /*
             * Note: providing a valid page id will trigger an update statement, updating that page, 
             * a pageid which is null will create trigger an insert statement adding a new page
             */
            $title = (string)filter_input(INPUT_POST, 'page_title');
            $url = (string)filter_input(INPUT_POST, 'page_url');
            $content = (string)filter_input(INPUT_POST, 'page_content');
            $currentPage->setid($pageid);
            $currentPage->setTitle($title);
            $currentPage->setContent($content);
            $currentPage->setURL($url);
            $currentPage->setActive($active);
            $currentPage->setAuthorID($authorid);
            $currentPage = $pq->savePageDetails($currentPage);

            break;
            
        case "pages":
            
            $pagelist = $pq->getPageList();
            
            break;
            
        case "editpage":

            if( $pageid != null && $pageid > 0 ) {
                $currentPage = $pq->getPageByID($pageid);
            }
            
            break;
            
        default:
            
            // Get the page details according to the page id.
            if (isset($pageid) && is_int($pageid) ) {
                $currentPage = $pq->getPageByID($pageid);
            }
    }
}