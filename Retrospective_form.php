<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
require_once( 'gpc_api.php' );
require_once( 'sprint_api.php' );
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sprint Retrospective</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript">
		var g_selected_obj_name;
		var g_status_imgs = new Array(); 
    $(document).ready(function ()
    {
    	
        $("#btnClose").click(function (e)
        {
            HideDialog();
            e.preventDefault();
        });
		    
        $("#btnSubmit").click(function (e)
        {
            var option = $("#options input:radio:checked").val();
            var obj = $('[name="'+g_selected_obj_name+'"]');
            var src = "images/red.gif";
            var value = "1";
            if (option == "Good")
            {
            	src = "images/green.gif";
            	value = "1";
            }
            else if (option == "Ugly")
            {
            	src = "images/yellow.gif";
            	value = "2";
            }
            else if (option == "Bad")
            {
            	src = "images/red.gif";
            	value = "3";
            }
            else if (option == "Flat")
            {
            	src = "images/flat.gif";
            	value = "1";
            }
            else if (option == "Up")
            {
            	src = "images/up.gif";
            	value = "2";
            }
            else if (option == "Down")
            {
            	src = "images/down.gif";
            	value = "3";
            }
            obj.attr("src",src);
            obj.attr("value",value);
            HideDialog();
            e.preventDefault();
        });
        
    $('#XFT').bind('change', function(e) {
    	var value = $(this).val(); 
    	$.ajax({
  			type: "POST",
  			url: "generate_review_table.php",
  			data: { sr_id: value }
			}).done(function( msg ) {
			  $("#mytable").html(msg);
		});
    });
    
    $.ajax({type:'POST', url: 'Retrospectivesave.php', data:$('#ContactForm').serialize(), success: function(response) {
    $('#ContactForm').find('.form_result').html(response);
}});
        
    });

		$(document).on("click", 'img[name^="Status_"]', function(){ 
			var name = $(this).attr("name");
		  updateStatus(name); 
		});
		
		$(document).on("click", 'img[name^="Trend_"]', function(){ 
    	var name = $(this).attr("name");
    	updateTrend(name); 
		});

		$(document).on("click", 'div[name^="Comment_"]', function(){ 
    	var comment = $(this).html();
    	var new_comment = prompt('What is your comment?', comment);
    	if (new_comment) 
    	{
    		$(this).html(new_comment);
    		$(this).attr("value",new_comment);
    	}
		});

		$(document).on("click", '#save_retros', function(){ 
    	var name = $(this).attr("name");
    	updateTrend(name); 
		});

    function ShowDialog(name)
    {
    		g_selected_obj_name = name;
        $("#overlay").show();
        $("#dialog").fadeIn(300);
				$("#overlay").unbind("click");
    }

    function HideDialog()
    {
        $("#overlay").hide();
        $("#dialog").fadeOut(300);
    }

    function updateStatus(name)
    {
    	$("#options img[id=option1]").attr("src","images/green.gif");
    	$("#options img[id=option2]").attr("src","images/yellow.gif");
    	$("#options img[id=option3]").attr("src","images/red.gif");
    	$("#options input[id=option1]").attr("value","Good");
    	$("#options input[id=option2]").attr("value","Ugly");
    	$("#options input[id=option3]").attr("value","Bad");
    	$("#web_dialog_title").html("How was the status?");
    	ShowDialog(name);
    }

    function updateTrend(name)
    {
    	$("#options img[id=option1]").attr("src","images/flat.gif");
    	$("#options img[id=option2]").attr("src","images/up.gif");
    	$("#options img[id=option3]").attr("src","images/down.gif");
    	$("#options input[id=option1]").attr("value","Flat");
    	$("#options input[id=option2]").attr("value","Up");
    	$("#options input[id=option3]").attr("value","Down");
    	$("#web_dialog_title").html("How was the trend?");
    	ShowDialog(name);
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
<select id="XFT">
<?php
get_XFT_Masters();
?>
</select>
<table id="mytable" cellspacing="0" summary="Sprint Retrospective" width="90%">
<caption>How was the sprint </caption> 
  <tr>
<!--    <th scope="col" abbr="Item" class="nobg">Item</th>  -->
    <th scope="col" abbr="Item" width="200">Item</th>
    <th scope="col" abbr="Status" width="50">Status</th>
    <th scope="col" abbr="Trend" width="50">Trend</th>
    <th scope="col" abbr="Comment">Comment</th>
  </tr>
  <tr>
    <th scope="row" abbr="OPO" class="spec">OPO</th>
    <td ><img border="0" src="images/green.gif" name="Status_1" value="1" /></td>
    <td ><img border="0" src="images/flat.gif" name="Trend_1" value="1" /></td>
    <td ><div class="Comment" name="Comment_1" value="Comment 1 ... " >Comment 1 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="RADIATORS" class="spec">RADIATORS</th>
    <td ><img border="0" src="images/green.gif" name="Status_2" value="1" /></td>
    <td ><img border="0" src="images/flat.gif" name="Trend_2" value="1" /></td>
    <td ><div class="Comment" name="Comment_2" value="Comment 2 ... " >Comment 2 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="TEST HOTEL" class="spec">TEST HOTEL</th>
    <td ><img border="0" src="images/green.gif" name="Status_3" value="1" /></td>
    <td ><img border="0" src="images/flat.gif" name="Trend_3" value="1" /></td>
    <td ><div class="Comment" name="Comment_3" value="Comment 3 ... " >Comment 3 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="LINE" class="spec">LINE</th>
    <td ><img border="0" src="images/green.gif" name="Status_4" value="1" /></td>
    <td ><img border="0" src="images/flat.gif" name="Trend_4" value="1" /></td>
    <td ><div class="Comment" name="Comment_4" value="Comment 4 ... " >Comment 4 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="TOOL/ENVIRONMENT" class="spec">TOOL/ENVIRONMENT</th>
    <td ><img border="0" src="images/green.gif" name="Status_5" value="1" /></td>
    <td ><img border="0" src="images/flat.gif" name="Trend_5" value="1" /></td>
    <td ><div class="Comment" name="Comment_5" value="Comment 5 ... " >Comment 5 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="CI" class="spec">CI</th>
    <td ><img border="0" src="images/green.gif" name="Status_6" value="1" /></td>
    <td ><img border="0" src="images/flat.gif" name="Trend_6" value="1" /></td>
    <td ><div class="Comment" name="Comment_6" value="Comment 6 ... " >Comment 6 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="3GSIM" class="spec">3GSIM</th>
    <td ><img border="0" src="images/green.gif" name="Status_7" value="1" /></td>
    <td ><img border="0" src="images/flat.gif" name="Trend_7" value="1" /></td>
    <td ><div class="Comment" name="Comment_7" value="Comment 7 ... " >Comment 7 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="DEPENDENCIES" class="spec">DEPENDENCIES</th>
    <td ><img border="0" src="images/green.gif" name="Status_8" value="1" /></td>
    <td ><img border="0" src="images/flat.gif" name="Trend_8" value="1" /></td>
    <td ><div class="Comment" name="Comment_8" value="Comment 8 ... " >Comment 8  ...</div></td>
  </tr>
</table>
<div class="ui-widget"><input id="sprint_name"> </input><input type="image" id="save_retros" src="images/save.jpg" alt="Submit"/></div>
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
