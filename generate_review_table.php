<?php
require_once( 'gpc_api.php' );
require_once( 'sprint_api.php' );
$t_sprint_retros_id = gpc_get_int( 'sr_id', 0 );
?>

<caption>How was the sprint </caption> 
  <tr>
    <th scope="col" abbr="Item" width="200">Item</th>
<?php
	$t_columns = Array();
	get_review_column($t_columns);
	foreach ($t_columns as $id => $column) {
		if("Comment" == $column)
		{
	    echo '    <th scope="col" value="'.$id.'" name="'.$column.'">'.$column.'</th>
	';
		}
		else
		{
	    echo '    <th scope="col" value="'.$id.'" name="'.$column.'" width="50">'.$column.'</th>
	';
		}
	}
?>

<?php
	get_review_items($t_items);
	$t_item_values = Array();
	get_review_item_value_by_id($t_item_values, $t_sprint_retros_id);
//	var_dump($t_item_values);
//	echo '###########################################################
//	';
	$t_column_index = 0;
	foreach ($t_items as $item_id => $item)
	{
		++$t_item_index;
		echo '<tr>
';
		echo '   <th scope="row" class="spec">'.$item.'</th>
';
		foreach ($t_columns as $id => $column) {
			if("Comment" == $column)
			{
				echo '    <td ><div class="'.$column.'" name="'.$column.'_'.$t_item_index.'" value="'.$t_item_values[$item_id][$column].'" >'.$t_item_values[$item_id][$column].'</div></td>
';
			}
			else
			{
				echo '    <td ><img class="'.$column.'" src="'.get_img_src_by_item_value($column,$t_item_values[$item_id][$column]).'" name="'.$column.'_'.$t_item_index.'"  value="'.$t_item_index.'" /></td>
';
			}
	  }

	}



	

