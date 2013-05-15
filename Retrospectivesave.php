<?php

require_once( 'gpc_api.php' );
require_once( 'sprint_api.php' );
$t_sprint_retros_id = gpc_get_int( 'save_retros', 0 );
$t_xft_id = gpc_get_int( 'xft_id', 0 );
$t_new_sprint_name = gpc_get_string( 'new_sprint_name' );
$t_status_array = array();
$t_trend_array = array();
$t_comment_array = array();
foreach ( $_POST as $key => $value )
{
    if ( preg_match('/Status/', $key) )
    {
    	array_push($t_status_array, $value);
   	}
   	elseif ( preg_match('/Trend/', $key) )
   	{
    	array_push($t_trend_array, $value);
   	}
   	elseif ( preg_match('/Comment/', $key) )
   	{
    	array_push($t_comment_array, $value);
   	}
}

//if new sprint restrospective, then table  retrospective_table needs sprint name, xft_id, startweek AND retros_review_items_table needs all Status/Trend/Comment Value.
//if only update existing restorpective, then only need sprint retrospective id and all Status/Trend/Comment values.

$t_retrospective_id = save_retrospective($t_sprint_retros_id,$t_status_array,$t_trend_array,$t_comment_array,$t_new_sprint_name,$t_xft_id);

$url = 'Retrospective_form.php?retrosid='.$t_retrospective_id;
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">'; 
//add one line
?>