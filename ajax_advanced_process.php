<?php
	require("connection.php");

	if(isset($_POST['post']) AND !empty($_POST['post']))
	{
		post();
	}
	elseif(isset($_POST['edit_post']))
	{
		editpost();
	}
	elseif(isset($_POST['post_delete']) AND $_POST['post_delete']==True)
	{
		delete();
	}
	else
	{
		showpost();
	}
	


	function post()
	{
		$query="INSERT INTO notes (title, description, created_at, updated_at) VALUES ('".$_POST['title']."','".$_POST['post']."', NOW(), NOW())";
		mysql_query($query);

		showpost();
	}



	function editpost()
	{
		$query_update="UPDATE notes SET description='".$_POST['edit_post']."' WHERE id='".$_POST['id']."'";
		mysql_query($query_update);

		showpost();

	}

		function delete()
	{
			
		$query_delete="DELETE FROM notes WHERE id='".$_POST['id']."'";
		mysql_query($query_delete);

		showpost();
	}


	function showpost()
	{
		$query="SELECT id, title, description FROM notes ORDER BY created_at ASC";
		
		$posts=fetch_all($query);

		$ajax_post="";

		foreach($posts as $post)
		{

			 $ajax_post .=
			 "<div class= 'post_box'>
			 	<form class='deletebox' action='ajax_advanced_process.php' method='post'>
		 			<a href='#' class='del' id='delete'>delete</a>
		 			<input type='hidden' name='id' value= '".$post['id']."'>
		 			<input type='hidden' class='post_delete' name='post_delete' value='0'>
			 	</form>
			 	<div class='post_title'>
			 	
					".$post['title']."

			 	</div>
			 	<div>
			 		<form class='editbox' action='ajax_advanced_process.php' method='post'>
				 		<input type='hidden' name='id' value= '".$post['id']."'>
				 		<textarea class='post_content' name='edit_post'>

		 	 	     ".$post['description']."

				 		</textarea>
			 		</form>
			 	</div>
			 </div>";

			 
  		 }  
  		 echo json_encode($ajax_post);
		
	}





?>
