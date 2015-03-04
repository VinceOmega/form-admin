<?php

	$db = new mysqli('localhost', $username, $password, 'arifleet');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}
?>
<?php
$get_page_name = $db->query("SELECT admin_title FROM meta_page_home WHERE pageid = $_GET[id]");
	$row = mysqli_fetch_assoc($get_page_name); $pagename = $row['admin_title'];
	
?>
<div class="main">
		<span class="title">Edit Page: <?php echo $pagename ?></span>
		<div class="pad">
	
		
			<form method="post" action="insert.php?id=<?php echo $_GET['id']?>">
				<fieldset>
					<label for="subid">Parent</label>
				
					<select name="subid" id="subid">
						<option value="">No Change</option>
						<option value="top">Top Level</option>
						<option>---</option>
						
				<?php


	$result_dropdown = $db->query('SELECT pageid, subid, admin_title FROM meta_page_home');
	

				while($row = mysqli_fetch_assoc($result_dropdown)){
						foreach($row as $name => $value){
		 		//echo $name. "=>". $value."\r\n";
		 	
		 			if($name === 'pageid'){
		 				$pid = $value;
		 			}

		 			if($name === 'admin_title'){
					?>
					<option value="<?php echo $pid ?>"><?php echo $value ?></option>
<?php
				}
			}
		}

				?>	
						<!-- <option value="1" selected>Lorem ipsum</option>
						<option value="2">&nbsp;&nbsp; - Dolor</option>
						<option value="3">&nbsp;&nbsp; - Sit amet</option>
						<option value="4">&nbsp;&nbsp; - Consectetur</option>
						<option value="5">Adipisicing</option>
						<option value="6">&nbsp;&nbsp; - Do eiusmod</option>
						<option value="7">&nbsp;&nbsp; - Tempor</option>
						<option value="8">&nbsp;&nbsp; - Incididunt</option>
						<option value="9">Magna aliqua</option>
						<option value="10">&nbsp;&nbsp; - Minim ven</option>
						<option value="11">&nbsp;&nbsp; - Ut enim ad</option>
						<option value="12">&nbsp;&nbsp; - Nostrud</option>
					-->
					</select>
<?php
$result_stats = $db->query("SELECT * FROM meta_page_home WHERE pageid = ".$_GET['id']."");
			while($row_stats = mysqli_fetch_assoc($result_stats)){
				//print_r($row_stats);
			
	
?>
				</fieldset>
				<fieldset>
					<label for="title">Title</label>
					<input type="text" name="title" id="title" value="<?php echo $row_stats['title'];?>">
				</fieldset>
				<fieldset>
					<label for="url">URL</label>
					<input type="text" name="url" id="url" value="<?php echo $row_stats['url'];?>">
				</fieldset>
				<fieldset>
					<label for="h1">Heading 1</label>
					<input type="text" name="h1" id="h1" value="<?php echo $row_stats['h1'];?>">
				</fieldset>
				<fieldset>
					<label for="h2">Heading 2</label>
					<input type="text" name="h2" id="h2" value="<?php echo $row_stats['h2'];?>">
				</fieldset>
				<fieldset>
					<label for="h3">Heading 3</label>
					<input type="text" name="h3" id="h3" value="<?php echo $row_stats['h3'];?>">
				</fieldset>
				<fieldset>
					<label for="h4">Heading 4</label>
					<input type="text" name="h4" id="h4" value="<?php echo $row_stats['h4'];?>">
				</fieldset>
				<fieldset>
					<label for="h5">Heading 5</label>
					<input type="text" name="h5" id="h5" value="<?php echo $row_stats['h5'];?>">
				</fieldset>
				<fieldset>
					<label for="h6">Heading 6</label>
					<input type="text" name="h6" id="h6" value="<?php echo $row_stats['h6'];?>">
				</fieldset>
				<fieldset>
					<label for="alt_tag">Alt Tag</label>
					<input type="text" name="alt_tag" id="alt_tag" value="<?php echo $row_stats['alt_tag'];?>">
				</fieldset>
				<fieldset>
					<label for="keyword_count">Keyword Count</label>
					<input type="text" name="keyword_count" id="keyword_count" value="<?php echo $row_stats['keyword_count'];?>">
				</fieldset>
				<fieldset>
					<label for="content_count">Content Count</label>
					<input type="text" name="content_count" id="content_count" value="<?php echo $row_stats['content_count'];?>">
				</fieldset>
				<fieldset>
					<label for="robot_text_code">Robot Text Code</label>
					<input type="text" name="robot_text_code" id="robot_text_code" value="<?php echo $row_stats['robot_text_code'];?>">
				</fieldset>
				<fieldset>
					<label for="rich_snippet_code">Rich Snippet Code</label>
					<input type="text" name="rich_snippet_code" id="rich_snippet_code" value="<?php echo $row_stats['rich_snippet_code'];?>">
				</fieldset>
				<fieldset>
					<label for="cannonical_tags">Cannonical Tags</label>
					<input type="text" name="cannonical_tags" id="cannonical_tags" value="<?php echo $row_stats['cannonical_tags'];?>">
				</fieldset>
				<fieldset>
					<label for="author_tags">Author Tags</label>
					<input type="text" name="author_tags" id="author_tags" value="<?php echo $row_stats['author_tags'];?>">
				</fieldset>
				<fieldset>
					<label for="hCard">hCard</label>
					<input type="text" name="hCard" id="hCard" value="<?php echo $row_stats['hCard'];?>">
				</fieldset>
				<fieldset>
					<label for="meta">Meta</label>
					<textarea rows="25" cols="75" name="meta" id="meta">
							<?php echo $row_stats['meta'];?>
					</textarea>
				</fieldset>
				<fieldset>
					<input type="submit" value="Save"> &nbsp;
					<input type="reset" value="Cancel">
				</fieldset>
			</form>
		</div>
	</div>
	<?php 
}
$db->close();

?>