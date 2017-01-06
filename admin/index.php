<?php

session_start();

/**
 * The back-office pages are served via this index.php file.
 * The action determines which template should be loaded
 * 
 */


// Set basic settings and class loading
include('cms-load.php');

// The actions coming from the url parameter: action
$action = (string)filter_input(INPUT_POST, 'action');
if( $action == null || $action == '' ) {
    $action = (string)filter_input(INPUT_GET, 'action');
}



// Determine which action to take
if (isset($action) && $action != null ) {
    
    switch ($action) {
        case "pages":
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'PageProcessor.php');
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'pages_idx.php');
            break;

        case "newpage":
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'page_details.php');
            break;

        /* Process page_details functionality */
        case "save_page_details":
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'PageProcessor.php');
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'page_details.php');
            break;
        
        case "editpage":
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'PageProcessor.php');
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'page_details.php');
            break;

        case "content":
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'ContentProcessor.php');
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'content_idx.php');
            break;

        case "newcontent":
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'ContentProcessor.php');
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'content_details.php');
            break;        
        
        case "save_content_details":
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'ContentProcessor.php');
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'content_details.php');
            break;
        
        case "editcontent":
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'ContentProcessor.php');
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'content_details.php');
            break;

        case "menu":
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'MenuProcessor.php');
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'menu_idx.php');
            break;
        
        /* Default when no action (or incorrect) is provided */
        default:
            require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'dashboard.php');
    }
} else {
    require_once(ROOT_DIR.DIRECTORY_SEPARATOR.'dashboard.php');
}
