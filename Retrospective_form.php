<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
require_once( 'gpc_api.php' );
require_once( 'sprint_api.php' );
$t_retrosid = gpc_get_int( 'retrosid', $t_retrosid );
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sprint Retrospective</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript">
		var g_selected_obj_id;
		var g_status_imgs = new Array(); 
    $(document).ready(function ()
    {
    		var retrosid = '<?php echo $t_retrosid; ?>';
    		if(0 != retrosid)
    		{
    			$('#mytable').load('generate_sprint_list.php',{ sr_id: retrosid } );
    		}
        $("#btnClose").click(function (e)
        {
            HideDialog();
            e.preventDefault();
        });
		    
        $("#btnSubmit").click(function (e)
        {
            var option = $("#options input:radio:checked").val();
            var obj = $('[id="'+g_selected_obj_id+'"]');
            var inputObj = $('[name="'+g_selected_obj_id+'"]');
            var src = "images/red.gif";
            //value == option
            if (option == "Good")
            {
            	src = "images/green.gif";
            }
            else if (option == "Ugly")
            {
            	src = "images/yellow.gif";
            }
            else if (option == "Bad")
            {
            	src = "images/red.gif";
            }
            else if (option == "Flat")
            {
            	src = "images/flat.gif";
            }
            else if (option == "Up")
            {
            	src = "images/up.gif";
            }
            else if (option == "Down")
            {
            	src = "images/down.gif";
            }
            obj.attr("src",src);
            inputObj.attr("value",option);
            HideDialog();
            e.preventDefault();
        });
        
    $('#XFT').bind('change', function(e) {
    	var value = $(this).val(); 
    	$.ajax({
  			type: "POST",
  			url: "generate_review_table.php",
  			data: { xft_id: value }
			}).done(function( msg ) {
			  $("#sprint_name").html(msg);
		});
		
//    $.ajax({
//  			type: "POST",
//  			url: "generate_sprint_list.php",
//  			data: { sr_id: -1, xft_id: value }
//			}).done(function( msg ) {
//			  $("#mytable").html(msg);
//			  $('[name="save_retros"]').attr("value",-1);
//		});		

		
    });//$('#XFT').bind('change'
    $('#sprint_name').bind('change', function(e) {
    	var value = $(this).val();
    	if(0 == value)
    	{
    		var sprint_name = prompt('What is new sprint name?', "Sprint_");
			  $('[name="new_sprint_name"]').attr("value",sprint_name);
			  $('[name="save_retros"]').attr("value",value);
	    	$.ajax({
	  			type: "POST",
	  			url: "generate_init_table.php",
	  			data: { sr_id: value, sp_name: sprint_name}
				}).done(function( msg ) {
				  $("#mytable").html(msg);
			});
    	}
    	else
    	{
	    	$.ajax({
	  			type: "POST",
	  			url: "generate_sprint_list.php",
	  			data: { sr_id: value }
				}).done(function( msg ) {
				  $("#mytable").html(msg);
				  $('[name="save_retros"]').attr("value",value);
			});
    	}

    });//$('#sprint_name').bind('change'
    $('#new_retros').bind('click', function(e) {
    	var value = $(this).val(); 
    	var sprint_name = prompt('What is new sprint name?', "Sprint_");
    	$.ajax({
  			type: "POST",
  			url: "generate_init_table.php",
  			data: { sr_id: value }
			}).done(function( msg ) {
			  $("#mytable").html(msg);
		});
    });//$('#new_retros').bind('change'


    });

		$(document).on("click", 'img[id^="Status_"]', function(e){ 
			e.preventDefault();
			var id = $(this).attr("id");
		  updateStatus(id); 
		});
		
		$(document).on("click", 'img[id^="Trend_"]', function(e){
			e.preventDefault();
    	var id = $(this).attr("id");
    	updateTrend(id); 
		});

		$(document).on("click", 'div[id^="Comment_"]', function(e){
			e.preventDefault();
    	var comment = $(this).html();
    	var new_comment = prompt('What is your comment?', comment);
    	if (new_comment) 
    	{
    		$(this).html(new_comment);
    		var id = $(this).attr("id");
    		$('[name="'+id+'"]').attr("value",new_comment);
    	}
		});
		

//		$(document).on("click", '#save_retros', function(e){
//			e.preventDefault();
//    	$.ajax({type:'POST', url: 'Retrospectivesave.php', data:$("#mytable :input").serialize(), success: function(response) {
//    	$('#sprint_name').html(response);
//			}});
//		});

    function ShowDialog(id)
    {
    		g_selected_obj_id = id;
        $("#overlay").show();
        $("#dialog").fadeIn(300);
				$("#overlay").unbind("click");
    }

    function HideDialog()
    {
        $("#overlay").hide();
        $("#dialog").fadeOut(300);
    }

    function updateStatus(id)
    {
    	$("#options img[id=option1]").attr("src","images/green.gif");
    	$("#options img[id=option2]").attr("src","images/yellow.gif");
    	$("#options img[id=option3]").attr("src","images/red.gif");
    	$("#options input[id=option1]").attr("value","Good");
    	$("#options input[id=option2]").attr("value","Ugly");
    	$("#options input[id=option3]").attr("value","Bad");
    	$("#web_dialog_title").html("How was the status?");
    	ShowDialog(id);
    }

    function updateTrend(id)
    {
    	$("#options img[id=option1]").attr("src","images/flat.gif");
    	$("#options img[id=option2]").attr("src","images/up.gif");
    	$("#options img[id=option3]").attr("src","images/down.gif");
    	$("#options input[id=option1]").attr("value","Flat");
    	$("#options input[id=option2]").attr("value","Up");
    	$("#options input[id=option3]").attr("value","Down");
    	$("#web_dialog_title").html("How was the trend?");
    	ShowDialog(id);
    }

  
	  $(function() {
    var availableSprints = [
      "Sprint1",
      "Sprint2",
      "Sprint3",
      "Sprint4",
      "Sprint5",
      "Sprint6",
      "Sprint7",
      "Sprint8",
      "Sprint9",
      "Sprint10",
      "Sprint11",
      "Sprint12",
      "Sprint13",
      "Sprint14",
      "Sprint15",
      "Sprint16",
      "Sprint17",
      "Sprint18",
      "Sprint19",
      "Sprint20",
      "Sprint21",
      "Sprint22"
    ];
    $( "#sprint_name" ).autocomplete({
      source: availableSprints
    });
  });

</script>
</head>

<body>
<form method="post" id="RetrospectiveForm" action="Retrospectivesave.php">
<div id="XFT_Sprint">
	<select id="XFT" name="xft_id">
<?php
get_XFT_Masters();
?>
	</select>
	<select id="sprint_name">
	</select>
<!--
	<input id="new_retros" type="image" name="new_retros" value="0" src="images/new.png" alt="New"/>
-->
</div>
<!--
<input id="sprint_name" value="Sprint_7" readonly> </input>
-->
<table id="mytable" cellspacing="0" summary="Sprint Retrospective" width="90%">
<caption>How was the sprint </caption> 
  <tr>
    <th scope="col" abbr="Item" width="200">Item</th>
    <th scope="col" abbr="Status" width="50">Status</th>
    <th scope="col" abbr="Trend" width="50">Trend</th>
    <th scope="col" abbr="Comment">Comment</th>
  </tr>
  <tr>
    <th scope="row" abbr="OPO" class="spec">OPO</th>
    <td ><img border="0" src="images/green.gif" id="Status_1" /><input type="hidden" name="Status_1" value="Good"></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_1" /><input type="hidden" name="Trend_1" value="Flat"></td>
    <td ><div class="Comment" id="Comment_1" >No Comment</div><input type="hidden" name="Comment_1" value="No Comment"></td>
  </tr>
  <tr>
    <th scope="row" abbr="RADIATORS" class="spec">RADIATORS</th>
    <td ><img border="0" src="images/green.gif" id="Status_2" /><input type="hidden" name="Status_2" value="Good"></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_2" /><input type="hidden" name="Trend_2" value="Flat"></td>
    <td ><div class="Comment" id="Comment_2" >No Comment</div><input type="hidden" name="Comment_2" value="No Comment"></td>
  </tr>
  <tr>
    <th scope="row" abbr="TEST HOTEL" class="spec">TEST HOTEL</th>
    <td ><img border="0" src="images/green.gif" id="Status_3" /><input type="hidden" name="Status_3" value="Good"></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_3" /><input type="hidden" name="Trend_3" value="Flat"></td>
    <td ><div class="Comment" id="Comment_3" >No Comment</div><input type="hidden" name="Comment_3" value="No Comment"></td>
  </tr>
  <tr>
    <th scope="row" abbr="LINE" class="spec">LINE</th>
    <td ><img border="0" src="images/green.gif" id="Status_4" /><input type="hidden" name="Status_4" value="Good"></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_4" /><input type="hidden" name="Trend_4" value="Flat"></td>
    <td ><div class="Comment" id="Comment_4" >No Comment</div><input type="hidden" name="Comment_4" value="No Comment"></td>
  </tr>
  <tr>
    <th scope="row" abbr="TOOL/ENVIRONMENT" class="spec">TOOL/ENVIRONMENT</th>
    <td ><img border="0" src="images/green.gif" id="Status_5" /><input type="hidden" name="Status_5" value="Good"></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_5" /><input type="hidden" name="Trend_5" value="Flat"></td>
    <td ><div class="Comment" id="Comment_5" >No Comment</div><input type="hidden" name="Comment_5" value="No Comment"></td>
  </tr>
  <tr>
    <th scope="row" abbr="CI" class="spec">CI</th>
    <td ><img border="0" src="images/green.gif" id="Status_6" /><input type="hidden" name="Status_6" value="Good"></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_6" /><input type="hidden" name="Trend_6" value="Flat"></td>
    <td ><div class="Comment" id="Comment_6" >No Comment</div><input type="hidden" name="Comment_6" value="No Comment"></td>
  </tr>
  <tr>
    <th scope="row" abbr="3GSIM" class="spec">3GSIM</th>
    <td ><img border="0" src="images/green.gif" id="Status_7" /><input type="hidden" name="Status_7" value="Good"></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_7" /><input type="hidden" name="Trend_7" value="Flat"></td>
    <td ><div class="Comment" id="Comment_7" >No Comment</div><input type="hidden" name="Comment_7" value="No Comment"></td>
  </tr>
  <tr>
    <th scope="row" abbr="DEPENDENCIES" class="spec">DEPENDENCIES</th>
    <td ><img border="0" src="images/green.gif" id="Status_8" /><input type="hidden" name="Status_8" value="Good"></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_8" /><input type="hidden" name="Trend_8" value="Flat"></td>
    <td ><div class="Comment" id="Comment_8" >No Comment</div><input type="hidden" name="Comment_8" value="No Comment"></td>
  </tr>
</table>
<input name="new_sprint_name" type="hidden" value="">
<input type="hidden" name="save_retros" value="<?php echo $t_retrosid ?>" />
<div class="ui-widget"><input type="image" src="images/save.jpg" alt="Submit"/></div>
</form>

    <div id="overlay" class="web_dialog_overlay"></div>
    <div id="dialog" class="web_dialog">
        <table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
            <tr class="default">
                <td class="web_dialog_title" id="web_dialog_title"">Online Survey</td>
                <td class="web_dialog_title align_right">
                    <a href="#" id="btnClose">Close</a>
                </td>
            </tr>

            <tr class="default">
                <td class="default" colspan="2" style="padding-left: 15px;">
                    <div id="options">
                        <input id="option1" name="option" type="radio" checked="checked" value="" /> <img id="option1" border="0" src="images/green.gif" />
                        <input id="option2" name="option" type="radio" value="" /> <img id="option2" border="0" src="images/yellow.gif" />
                        <input id="option3" name="option" type="radio" value="" /> <img id="option3" border="0" src="images/yellow.gif" />
                    </div>
                </td>
            </tr>
            <tr class="default">
                <td class="default" colspan="2" style="text-align: center;">
                    <input id="btnSubmit" type="button" value="Submit" />
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
