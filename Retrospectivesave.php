<?php

require_once( 'gpc_api.php' );
require_once( 'sprint_api.php' );

$t_retrospective_id = save_retrospective();

$url = 'Retrospective_form.php?retrosid='.$t_retrospective_id;
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">'; 
//add one line
?>