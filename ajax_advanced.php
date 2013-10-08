<?php
	require("connection.php");



?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ajax Basic Assignment</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Ajax_advanced.css">
	<script type="text/javascript">
		$(document).ready(function(){

		$("#note_form").submit(function(){
				var form=$(this);
					$.post(form.attr('action')
					,form.serialize()
					,function(data)
					{
						$("#myposts").html(data), $(".post").val("");
					},"json");
				return false;
				});

		$("#note_form").submit();


		 		$(document).on('blur', ".post_content", function()
				{	
					$($(this).parent()).submit(function()
					{
						var edit=$(this);
						$.post(edit.attr('action')
							, edit.serialize()
							, function(data)
							{
								$("#myposts").html(data);
							}, "json");
						return false;
					});
					$($(this).parent()).submit();
				});
		
			 		

			 	$(document).on('click',".del",function()
				{
					$(".post_delete").attr('value', 'True');
					$($(this).parent()).submit(function()
					{
						var del=$(this);
						$.post(del.attr('action')
							, del.serialize()
							, function(data)
							{
								$("#myposts").html(data);
							}, "json");
						return false;
					});
					$($(this).parent()).submit();
				});
			
		});

	</script>
</head>
<body>
	<div class="container">
		<h3 id="head_title">My Posts:</h3>
		<div id="myposts">
			<!--post goes here-->
		</div>
		<div id="note">
			<h4> Add a Note:</h4>
			<form id="note_form" action="Ajax_advanced_process.php" method="post">
				<textarea type="text" class="post" name="post" placeholder="Enter description here"></textarea>
				<br>
				<hr>
				<input type="text" class="post" name="title" placeholder="Insert note title here">
				<br>
				<button type="submit" class="btn-default">Post It!</button>
			</form>
		</div>

	</div>
</body>
</html>

<?php

session_destroy();
?>