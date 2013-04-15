<?php
require_once( 'gpc_api.php' );

$countries=array('USA','CDN');
?>
<form action='?' method='post'>
  <select name='country'><?php
    foreach($countries as $key=>$country){?>
      <option value='<?php echo $key;?>'><?php echo $country;?></option>
    <?php
    } ?>
  </select>

  <input type='submit'>
</form>

<?php
if(isset($_POST['country'])){
  $chosen=(int)$_POST['country'];
  $chosen2=gpc_get_int( 'country', 0 );

  if(!isset($countries[$chosen])){?>Unknown country selection, wtf<?php exit; }?>

  <div style='margin-top:20px;'>You selected <?php echo $countries[$chosen2];?></div>

<?php }



<?php
// Make a MySQL Connection
mysql_connect("localhost", "admin", "1admin") or die(mysql_error());
mysql_select_db("test") or die(mysql_error());

// Retrieve all the data from the "example" table
$result = mysql_query("SELECT * FROM example")
or die(mysql_error());  

// store the record of the "example" table into $row
$row = mysql_fetch_array( $result );
// Print out the contents of the entry 

echo "Name: ".$row['name'];
echo " Age: ".$row['age'];

?>