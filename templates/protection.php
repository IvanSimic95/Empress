<?php
if( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
include $_SERVER['DOCUMENT_ROOT'].'/templates/error/403.php';
exit;
}
?>