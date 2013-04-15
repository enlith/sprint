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
		var g_id;
		var g_status_imgs = new Array(); 
    $(document).ready(function ()
    {
    	
        $("#btnClose").click(function (e)
        {
            HideDialog();
            e.preventDefault();
        });
				
//				$('img[id^="Status_"]').click(function (e)
//		    {
//		    	var id = $(this).attr("id");
//		    	updateStatus(id);
//		    });
//
//				$('img[id^="Trend_"]').click(function (e)
//		    {
//		    	var id = $(this).attr("id");
//		    	updateTrend(id);
//		    });
//
//				$('div[id^="Comment_"]').click(function (e)
//		    {
//		    	var comment = $(this).html();
//		    	var new_comment = prompt('What is your comment?', comment);
//		    	if (new_comment) $(this).html(new_comment);
//		    });
//

//				$('div[id^="Comment_"]').parent().click(function (e)
//		    {
//		    	var comment = $(this).find('div[id^="Comment_"]').html();
//		    	var new_comment = prompt('What is your comment?', comment);
//		    	if (new_comment) $(this)..find('div[id^="Comment_"]').html(new_comment);
//		    });
		    
        $("#btnSubmit").click(function (e)
        {
            var option = $("#options input:radio:checked").val();
            var src = "images/red.gif";
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
            $("#" + g_id).attr("src",src);
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
	//generate_review_table.php
//  alert( "Data Saved: " + msg );
  $("#mytable").html(msg);
});
//    	$.ajax({ type: "GET", url: "test.php", data: {sr_id: value}, function(data) {
//			$("#mytable").html(data);
//			});
    	
//    	$("#mytable").load("generate_review_table.php?sr_id=".value);
//    	$.ajax({
//    		url: "dialog.html",
//    		cache: false}).done(function( html ) {
//  			$("#mytable").html("TEST");
//			});
    });
        
    });

		$(document).on("click", 'img[id^="Status_"]', function(){ 
			var id = $(this).attr("id");
		  updateStatus(id); 
		});
		
		$(document).on("click", 'img[id^="Trend_"]', function(){ 
    	var id = $(this).attr("id");
    	updateTrend(id); 
		});

		$(document).on("click", 'div[id^="Comment_"]', function(){ 
    	var comment = $(this).html();
    	var new_comment = prompt('What is your comment?', comment);
    	if (new_comment) $(this).html(new_comment);
		});

		$(document).on("click", '#save_retros', function(){ 
    	var id = $(this).attr("id");
    	updateTrend(id); 
		});


//has problem	
//		$(document).on("click",'td[id^="Comment_"]', function(){
//			var comment_div =  $(this).find('div[id^="Comment_"]');
//    	var comment = comment_div.html();
//    	var new_comment = prompt('What is your comment?', comment);
//    	if (new_comment) comment_div.html(new_comment);
//		});
		

    function ShowDialog(id)
    {
    		g_id = id;
        $("#overlay").show();
        $("#dialog").fadeIn(300);
				$("#overlay").unbind("click");
    }

    function HideDialog()
    {
        $("#overlay").hide();
        $("#dialog").fadeOut(300);
    }

//    function updateComment(id)
//    {
//        var comment = document.getElementById(id).innerHTML
//        var new_comment = prompt('What is your comment?', comment);
//        if (new_comment) document.getElementById(id).innerHTML = new_comment;
//    }
//
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
<form method="post" action="Retrospectivesave.php">
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
    <td ><img border="0" src="images/green.gif" id="Status_1"  /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_1" /></td>
    <td ><div class="Comment" id="Comment_1" >Comment 1 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="RADIATORS" class="spec">RADIATORS</th>
    <td ><img border="0" src="images/green.gif" id="Status_2"  /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_2" /></td>
    <td ><div class="Comment" id="Comment_2" >Comment 2 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="TEST HOTEL" class="spec">TEST HOTEL</th>
    <td ><img border="0" src="images/green.gif" id="Status_3"  /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_3" /></td>
    <td ><div class="Comment" id="Comment_3" >Comment 3 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="LINE" class="spec">LINE</th>
    <td ><img border="0" src="images/green.gif" id="Status_4"  /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_4" /></td>
    <td ><div class="Comment" id="Comment_4" >Comment 4 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="TOOL/ENVIRONMENT" class="spec">TOOL/ENVIRONMENT</th>
    <td ><img border="0" src="images/green.gif" id="Status_5"  /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_5" /></td>
    <td ><div class="Comment" id="Comment_5" >Comment 5 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="CI" class="spec">CI</th>
    <td ><img border="0" src="images/green.gif" id="Status_6"  /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_6" /></td>
    <td ><div class="Comment" id="Comment_6" >Comment 6 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="3GSIM" class="spec">3GSIM</th>
    <td ><img border="0" src="images/green.gif" id="Status_7"  /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_7" /></td>
    <td ><div class="Comment" id="Comment_7" >Comment 7 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="DEPENDENCIES" class="spec">DEPENDENCIES</th>
    <td ><img border="0" src="images/green.gif" id="Status_8"  /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_8" /></td>
    <td ><div class="Comment" id="Comment_8" >Comment 8  ...</div></td>
  </tr>
</table>
<div class="ui-widget"><input id="sprint_name"> </input><input type="image" id="save_retros" src="images/save.jpg" alt="Submit"/></div>
</form>

<!--
<div id="comment_dialog">
	<textarea rows="5" cols="30" id="popup_prompt"></textarea>
</div>
-->
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
