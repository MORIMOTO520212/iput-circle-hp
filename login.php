<?php
/**
 * 
 * Login Process
 * Receives login POST requests and communicates with `wp-login.php`.
 * 
 */

session_start();

var_dump($_GET);

// token check
if ( $_GET['token'] != $_SESSION['token'] ) {
    header( 'Location:' . $_SESSION['referrer'] . '?errorcode=1' );
} else {
    echo 'token check succes';
}