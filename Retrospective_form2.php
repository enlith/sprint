<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sprint Retrospective</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
		var g_id;
    $(document).ready(function ()
    {
    	
     //$("#comment_dialog").dialog({
     //   close: function(event, ui) { 
            // do whatever you need on close
     //   }
    //	});
    	
//    	$("div[id^='Comment']").click(function (e)
//        {
//            ShowDialog(false);
//            e.preventDefault();
//        });
        

//        $("#btnShowModal").click(function (e)
//        {
//	        $("#overlay").show();
//	        $("#dialog").fadeIn(300);
//					$("#overlay").unbind("click");
//        });

        $("#btnClose").click(function (e)
        {
            HideDialog();
            e.preventDefault();
        });

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
    });

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

//    function HideCommentDialog()
//    {
//        $("#comment_dialog").fadeOut(300);
//    } 
    
    function updateComment(id)
    {
        var comment = document.getElementById(id).innerHTML
        var new_comment = prompt('What is your comment?', comment);
        if (new_comment) document.getElementById(id).innerHTML = new_comment;
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
//    	var radios = $('#options input[id=option]');
//    	var src = $("#" + id).attr("src");
//    	$radios.filter('[value=src]').attr('checked', true);
    	$("#web_dialog_title").html("How was the trend?");
    	ShowDialog(id);
    }

</script>
</head>

<body>
<table id="mytable" cellspacing="0" summary="The technical specifications of the Apple PowerMac G5 series">
<caption>How was the sprint </caption>
  <tr>
<!--    <th scope="col" abbr="Item" class="nobg">Item</th>  -->
    <th scope="col" abbr="Item">Item</th>
    <th scope="col" abbr="Status">Status</th>
    <th scope="col" abbr="Trend">Trend</th>
    <th scope="col" abbr="Comment">Comment</th>
  </tr>
  <tr>
    <th scope="row" abbr="OPO" class="spec">OPO</th>
    <td ><img border="0" src="images/green.gif" id="Status_1" onClick=updateStatus(id) /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_1" onClick=updateTrend(id) /></td>
    <td ><div class="styled-button-3" id="Comment_1" onClick=updateComment(id)>Comment 1 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="RADIATORS" class="spec">RADIATORS</th>
    <td ><img border="0" src="images/green.gif" id="Status_2" onClick=updateStatus(id) /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_2" onClick=updateTrend(id) /></td>
    <td ><div class="styled-button-3" id="Comment_2" onClick=updateComment(id)>Comment 2 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="TEST HOTEL" class="spec">TEST HOTEL</th>
    <td ><img border="0" src="images/green.gif" id="Status_3" onClick=updateStatus(id) /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_3" onClick=updateTrend(id) /></td>
    <td ><div class="styled-button-3" id="Comment_3" onClick=updateComment(id)>Comment 3 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="LINE" class="spec">LINE</th>
    <td ><img border="0" src="images/green.gif" id="Status_4" onClick=updateStatus(id) /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_4" onClick=updateTrend(id) /></td>
    <td ><div class="styled-button-3" id="Comment_4" onClick=updateComment(id)>Comment 4 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="TOOL/ENVIRONMENT" class="spec">TOOL/ENVIRONMENT</th>
    <td ><img border="0" src="images/green.gif" id="Status_5" onClick=updateStatus(id) /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_5" onClick=updateTrend(id) /></td>
    <td ><div class="styled-button-3" id="Comment_5" onClick=updateComment(id)>Comment 5 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="CI" class="spec">CI</th>
    <td ><img border="0" src="images/green.gif" id="Status_6" onClick=updateStatus(id) /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_6" onClick=updateTrend(id) /></td>
    <td ><div class="styled-button-3" id="Comment_6" onClick=updateComment(id)>Comment 6 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="3GSIM" class="spec">3GSIM</th>
    <td ><img border="0" src="images/green.gif" id="Status_7" onClick=updateStatus(id) /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_7" onClick=updateTrend(id) /></td>
    <td ><div class="styled-button-3" id="Comment_7" onClick=updateComment(id)>Comment 7 ... </div></td>
  </tr>
  <tr>
    <th scope="row" abbr="DEPENDENCIES" class="spec">DEPENDENCIES</th>
    <td ><img border="0" src="images/green.gif" id="Status_8" onClick=updateStatus(id) /></td>
    <td ><img border="0" src="images/flat.gif" id="Trend_8" onClick=updateTrend(id) /></td>
    <td ><div class="styled-button-3" id="Comment_8" onClick=updateComment(id)>Comment 8  ...</div></td>
  </tr>
</table>

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
