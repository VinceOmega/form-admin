<?php
include 'config.php';
$db = new mysqli('localhost', $username, $password, 'arifleet');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}
	//$ulitems = array(array());
	$result_top = $db->query('SELECT pageid, subid, admin_title FROM meta_page_home WHERE subid = 0');
	
		
		// while($row = mysqli_fetch_assoc($result_top)){
		// 	foreach($row as $name => $value){
		// 		echo $name. "=>". $value."\r\n";
		// 	}
		// }

		// echo "====================="."\r\n\r\n";

		// while($row = mysqli_fetch_assoc($result_sub)){
		// 	foreach($row as $name => $value){
		// 		echo $name. "=>". $value."\r\n";
		// 	}
		// }
		// foreach($result->num_rows as $rows => $value){
		// 	$ulitems[$rows] = $value;
		// }
?>
<nav class="pad">
	<ul>
		<?php
		$cnt = 0;
		$dup = "";
		while($row = mysqli_fetch_assoc($result_top)){
			
			?>
			<li <?php if($_GET['id'] === $row['pageid']){
					echo "class = current";
			}?>><a href="?id=<?php echo $row['pageid'] ?>"><?php echo $row['admin_title'] ?></a></li>
				<?php  
$result_sub = $db->query("SELECT pageid, subid, admin_title FROM meta_page_home WHERE subid = ".$row['pageid']);
				?>
			<ul>
<?php
		while($rows = mysqli_fetch_assoc($result_sub)){
			
				

			?>
<?php  if($dup != $rows['pageid']){ ?>
			<li <?php if($_GET['id'] === $rows['pageid']){
					$dup = $rows['pageid'];
					echo "class = current";
			}?>><a href="?id=<?php echo $rows['pageid'] ?>"><?php echo $rows['admin_title']?></a></li>
<ul>
<?php		
		$result_sublet = $db->query("SELECT pageid, subid, admin_title FROM meta_page_home WHERE subid = ".$rows['pageid']);
			while($rs = mysqli_fetch_assoc($result_sublet)){
			?>			<li <?php if($_GET['id'] === $rs['pageid']){
					$dup = $rs['pageid'];
					echo "class = current";
			}?>><a href="?id=<?php echo $rs['pageid'] ?>"><?php echo $rs['admin_title']?></a></li>

			

		<?php			
			}
			
		} ?>
	</ul>
<?php		
	}

		?>
			</ul>
			<?php }  ?>
			
		<!-- <li><a href="edit.php?id=">Lorem ipsum</a>
			<ul>
				<li><a href="edit.php?id=">Dolor</a></li>
				<li><a href="edit.php?id=">Sit amet</a></li>
				<li><a href="edit.php?id=" 
					<?php if( isset($_GET['id']) && $_GET['id']){
						echo " class='current'";
					} ?>
					>Consectetur</a></li> 
			</ul>
		</li> -->
	</ul>
</nav><?php 
$db->close();

?>