<?php
require_once( 'gpc_api.php' );
require_once( 'sprint_api.php' );
$t_xft_id = gpc_get_int( 'xft_id', 0 );
$t_sprint_list = Array();
get_XFT_sprint_list($t_xft_id, $t_sprint_list);
?>