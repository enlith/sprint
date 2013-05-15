<?php

require_once( 'gpc_api.php' );
require_once( 'sprint_api.php' );
$t_sprint_retros_id = gpc_get_int( 'save_retros', 0 );
$t_status_1 = gpc_get_string( 'Status_1' );
var_dump($t_sprint_retros_id);

$t_retrospective_id = save_retrospective($t_sprint_retros_id);

$url = 'Retrospective_form.php?retrosid='.$t_retrospective_id;
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">'; 
//add one line
?>