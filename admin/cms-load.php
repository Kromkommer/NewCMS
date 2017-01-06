<?php
/**
 * This is the bootstrap / startup file.
 */

define('ROOT_DIR', __DIR__);
define('CMS_DOMAIN', $_SERVER['HTTP_HOST']);
define('LOG_FILE', ROOT_DIR.DIRECTORY_SEPARATOR.'cms_log.log');
define('LOG_ON', true );

$language = 'NL';   // Language code
$country = 'nl';    // Country code
$currency = 'EUR';  // For future reference
$basedir = ROOT_DIR.DIRECTORY_SEPARATOR.'text';

require_once('lib'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'autoloader.class.php');
spl_autoload_extensions(".php, *.class.php");
spl_autoload_register('Autoloader::loader');


function getHeader() {
    return include(ROOT_DIR.DIRECTORY_SEPARATOR.'header.php');
}

function getFooter() {
    return include(ROOT_DIR.DIRECTORY_SEPARATOR.'footer.php');	
}

function getNavbar() {
    return include(ROOT_DIR.DIRECTORY_SEPARATOR.'inc/navbar.php');	
}

function getCMSHostName() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'].'/newcms/admin';
    return $protocol.$domainName;
}

/**
 * Logging init
 */

$log = Logger::getInstance();
$log->setLogfile(LOG_FILE);
// $log->log('CMS_DOMAIN = '.CMS_DOMAIN );

/**
 * Language and translations
 */
$trl = new Translation($country,$language,$basedir);
