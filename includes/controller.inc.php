<?php

// commodity variable to bypass the controller
if(isset($retour) && $retour == true) {
    $retour = false;
    return;
}

$config = array(
    'file_root'     => '/home/pascal/mozfr/www/',
    'server_name'   => 'www.mozfr.org',
    'static_prefix' => '',
);


// mod local pascal
if( !in_array($_SERVER['SERVER_NAME'], array('mozfr.org', 'www.mozfr.org')) ) {
    $config['file_root'] = '/var/www/mozfr/';
    $config['server_name'] = 'www.monsite-mozfr.org';
}


// our special functions
include $config['file_root'] . 'includes/functions.inc.php';


// make sure we have a few variables defined to avoid php warnings if they don't exist
$url_site  = 'http://' . $config['server_name'];
$theme     = 'asterix';
$page_id   = (isset($page_id))   ? $page_id                         : '';
$meta_desc = (isset($meta_desc)) ? $meta_desc                       : '';
$title     = empty($title)       ? 'Communauté Mozilla francophone' : $title;
$header    = $config['file_root'].'templates/' . $theme . '/header.inc.html';
$footer    = $config['file_root'].'templates/' . $theme . '/footer.inc.html';
$file      = 'content.inc.html';

// a few commodity variables that are much easier to use in the template than appending config vars
$host_root    = $config['url_scheme'] . '://' . $config['server_name'] . '/';
$host_l10n    = $host_root . $lang;
$host_enUS    = $host_root . 'en-US';
$firefox_link = $host_l10n . '/firefox/';

// here we define our per-page includes
$pages = array(
    'home'      => 'home.inc.html',
    'manifesto' => 'manifesto.inc.html',
);


// add the include if it exists only
if (array_key_exists($page_id, $pages) && $pages[$page_id] != '') {
    include $config['file_root'].'includes/pages/'.$pages[$page_id];
    include $header;
    include $content;
    include $footer;
} else {
    echo "page n'existe pas";
}
