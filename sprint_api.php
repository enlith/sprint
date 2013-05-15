<?php
	$g_hostname = 'localhost';
	$g_db_type = 'mysql';
	$g_database_name = 'sprint';
	$g_db_username = 'root';
	$g_db_password = '';
	
function &get_XFT_Masters(&$p_MastersArray)
{
	global $g_hostname,$g_db_type,$g_database_name,$g_db_username,$g_db_password;
	$con = mysql_connect($g_hostname, $g_db_username, $g_db_password) or die(mysql_error());
	mysql_select_db($g_database_name, $con) or die(mysql_error());
	$result = mysql_query("SELECT * FROM xft_table") or die(mysql_error());
	while($row = mysql_fetch_array($result))
  {
  	$p_MastersArray[$row['Master']] = $row['Name'];
		echo '<option value="'.$row['ID'].'">'.$row['Name'].'</option>
';
	}
	mysql_free_result($result);
	mysql_close($con);
}

function get_XFT_and_Sprints()
{
	global $g_hostname,$g_db_type,$g_database_name,$g_db_username,$g_db_password;
	$con = mysql_connect($g_hostname, $g_db_username, $g_db_password) or die(mysql_error());
	mysql_select_db($g_database_name, $con) or die(mysql_error());
	$result = mysql_query("SELECT * FROM xft_table") or die(mysql_error());
	echo '<select id="XFT">
';
	while($row = mysql_fetch_array($result))
  {
		echo '<option value="'.$row['ID'].'">'.$row['Name'].'</option>
';
	}
	echo '</select>
';
	mysql_free_result($result);
	$result = mysql_query("SELECT * FROM retrospective_table") or die(mysql_error());
	echo '<select id="sprint_name">
';
	echo '<option value="0">New Sprint...</option>
';
	while($row = mysql_fetch_array($result))
  {
  	echo '<option value="'.$row['ID'].'">'.$row['Name'].'</option>
';
	}
	echo '</select>
';
	mysql_free_result($result);
	mysql_close($con);
}

function get_XFT_last_sprint_id($p_XFT_ID)
{
	$t_sprint_list = Array();
	get_XFT_sprint_list($p_XFT_ID,$t_sprint_list);
	return max(array_keys($t_sprint_list));
}

function &get_XFT_sprint_list($p_XFT_ID,&$p_sprint_list)
{
	global $g_hostname,$g_db_type,$g_database_name,$g_db_username,$g_db_password;
	$con = mysql_connect($g_hostname, $g_db_username, $g_db_password) or die(mysql_error());
	mysql_select_db($g_database_name, $con) or die(mysql_error());
	$result = mysql_query("SELECT * FROM retrospective_table WHERE XFT_ID =".'"'.$p_XFT_ID.'"') or die(mysql_error());
	echo '<option value="0">New Sprint...</option>
';
	while($row = mysql_fetch_array($result))
  {
  	$p_sprint_list[$row['ID']] = $row['Name'];
  	echo '<option value="'.$row['ID'].'">'.$row['Name'].'</option>
';
	}
	mysql_free_result($result);
	mysql_close($con);
	return $p_sprint_list;
}


/*
SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`="sprint"
AND `TABLE_NAME`="retros_review_items_table"
*/
function &get_review_column(&$p_Columns, $p_table_name = "retros_review_items_table")
{
	global $g_hostname,$g_db_type,$g_database_name,$g_db_username,$g_db_password;
	$con = mysql_connect($g_hostname, $g_db_username, $g_db_password) or die(mysql_error());
	mysql_select_db($g_database_name, $con) or die(mysql_error());
	$query = "SELECT `COLUMN_NAME` 
						FROM `INFORMATION_SCHEMA`.`COLUMNS` 
						WHERE `TABLE_SCHEMA`=".'"'.$g_database_name.'"'.
						" AND `TABLE_NAME`=".'"'.$p_table_name.'"';
	$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result))
  {
  	if(preg_match("/.*ID$/",$row['COLUMN_NAME']) )
  	{
  		#skip
  	}
  	else
  	{
  		array_push($p_Columns, $row['COLUMN_NAME']);
  	}
	}
	mysql_free_result($result);
	mysql_close($con);
	return $p_Columns;
}

function &get_review_items(&$p_Items)
{
	global $g_hostname,$g_db_type,$g_database_name,$g_db_username,$g_db_password;
	$t_table_name = "retros_items_table";
	$con = mysql_connect($g_hostname, $g_db_username, $g_db_password) or die(mysql_error());
	mysql_select_db($g_database_name, $con) or die(mysql_error());
	$query = "SELECT * FROM ".$t_table_name;
	$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result))
  {
  	$p_Items[$row['ID']] = $row['ItemName'];
	}
	mysql_free_result($result);
	mysql_close($con);
	return $p_Items;
}

function get_img_src_by_item_value($p_review_item,$p_review_item_value)
{
	$t_image_src = "";
	switch($p_review_item)
	{
		case "Status":
			switch($p_review_item_value)
			{
				case "Good":
				$t_image_src = "images/green.gif";
				break;
				case "Ugly":
				$t_image_src = "images/yellow.gif";
				break;
				case "Bad":
				$t_image_src = "images/red.gif";
				break;			
			}
			break;
		case "Trend":
			switch($p_review_item_value)
			{
				case "Flat":
				$t_image_src = "images/flat.gif";
				break;
				case "Up":
				$t_image_src = "images/up.gif";
				break;
				case "Down":
				$t_image_src = "images/down.gif";
				break;			
			}
			break;
		case "Comment":
			break;
	}

	return  $t_image_src;
}

function &get_review_item_value_by_id(&$p_Items,$p_sprint_retros_id = 0)
{
	global $g_hostname,$g_db_type,$g_database_name,$g_db_username,$g_db_password;
	$t_table_name = "retros_review_items_table";
	$con = mysql_connect($g_hostname, $g_db_username, $g_db_password) or die(mysql_error());
	mysql_select_db($g_database_name, $con) or die(mysql_error());
	$query = "SELECT * FROM ".$t_table_name.' 
						WHERE SprintRetrosID = '.$p_sprint_retros_id;
	$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result))
  {
		$p_Items[$row['ItemID']]['Status'] = $row[2];
		$p_Items[$row['ItemID']]['Trend'] = $row[3];
		$p_Items[$row['ItemID']]['Comment'] = $row[4];
	}
	mysql_free_result($result);
	mysql_close($con);
	return $p_Items;
}

function save_retrospective($p_retros_id,&$p_status_array, &$p_trend_array, &$p_comment_array, $p_sprint_name = "", $p_xft_id = 0, $p_startweek = "")
{
	global $g_hostname,$g_db_type,$g_database_name,$g_db_username,$g_db_password;
	$t_retrospective_id = $p_retros_id;
	$t_table_name = "retrospective_table";
	$con = mysql_connect($g_hostname, $g_db_username, $g_db_password) or die(mysql_error());
	mysql_select_db($g_database_name, $con) or die(mysql_error());
	if(0 == $p_retros_id)
	{
//INSERT INTO Customers (CustomerName, ContactName, Address, City, PostalCode, Country)
//VALUES ('Cardinal','Tom B. Erichsen','Skagen 21','Stavanger','4006','Norway');		
		$query = "INSERT INTO  ".$t_table_name.' (Name, XFT_ID, StartWeek)
							VALUES ("'.$p_sprint_name.'",
							"'.$p_xft_id.'",
							"'.$p_startweek.'")';
		$result = mysql_query($query) or die(mysql_error());
		$t_retrospective_id = mysql_insert_id($con);
		#assuming status/trend/comment has same order and size.
		$t_table_name = "retros_review_items_table";
		for($i = 0 ; $i < count($p_status_array); ++$i)
		{
			$query = "INSERT INTO ".$t_table_name.' (SprintRetrosID,	ItemID,	Status,	Trend,	Comment)
								VALUES ("'.$t_retrospective_id.'",
								"'.($i+1).'",
								"'.$p_status_array[$i].'",
								"'.$p_trend_array[$i].'",
								"'.$p_comment_array[$i].'")';
			$result = mysql_query($query) or die(mysql_error());
		}
	}
	else
	{
		#assuming status/trend/comment has same order and size.
		$t_table_name = "retros_review_items_table";
		for($i = 0 ; $i < count($p_status_array); ++$i)
		{
			$query = "UPDATE ".$t_table_name.' 
								SET Status = "'.$p_status_array[$i].'",
								 Trend = "'.$p_trend_array[$i].'",
								 Comment = "'.$p_comment_array[$i].'" 
								WHERE SprintRetrosID = '.$t_retrospective_id.' AND ItemID = '.($i+1);
			$result = mysql_query($query) or die(mysql_error());
		}
	}
	return $t_retrospective_id;
}

class SprintRetrospective{
	
}
