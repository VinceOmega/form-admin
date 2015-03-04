<?php


/* 
Form Legend:

1 = Careers
2 = Case Studies
3 = Contact
4 = Events

*/



 include 'config.php';

 $formname = '';


 	

 if(isset($_GET['form']) && $_GET['form'] != ""){
 			switch($_GET['form']){

 				case '1':
 				$formname = 'Careers';
 				break;

 				case '2':
 				$formname = 'Case Studies & White Papers';
 				break;

 				case '3':
 				$formname = 'Contact';
 				break;

 				case '4':
 				$formname = 'Events';
 				break;

 			}
 }



	$db = new mysqli($config['server']['host'], $config['server']['user'], $config['server']['pass'], $config['server']['data']);
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}



?>
<?php
	if($_GET['form'] === '1'){
$get_careers = $db->query(" SELECT distinct 
	first_name, 
	last_name, 
	email, 
	position, 
	reason, 
	pdf_location FROM 
	vs_careers
	GROUP BY careers_id
	LIMIT $_GET[id], 10
	");
//$row_careers = $get_careers->fetch_assoc();
// foreach($row_careers as $key => $value){
// 		echo $row_careers['first_name'];
// 		echo $row_careers['last_name'];
// 		echo $row_careers['email'];
// 		echo $row_careers['position'];
// 		echo $row_careers['reason'];
// 		echo $row_careers['job_position'];
// 	}

// while($row_careers = $get_careers->fetch_assoc()){
// 		echo $row_careers['first_name'];
// 		echo $row_careers['last_name'];
// 		echo $row_careers['email'];
// 		echo $row_careers['position'];
// 		echo $row_careers['reason'];
// 		echo $row_careers['job_position'];
// }

// // print_r($row_careers);

// die();

$get_careers_all = $db->query("SELECT distinct first_name, last_name, email, position, reason, pdf_location FROM vs_careers ");

}
	if($_GET['form'] === '2'){
$get_casestudies = $db->query("SELECT distinct * FROM vs_casestudies GROUP BY ID LIMIT $_GET[id],10");
$get_casestudies_all = $db->query("SELECT distinct * FROM vs_casestudies");

}
	if($_GET['form'] === '3'){
$get_contact = $db->query("SELECT distinct * FROM vs_contact GROUP BY contact_id LIMIT $_GET[id],10");
$get_contact_all = $db->query("SELECT distinct * FROM vs_contact");

}

	if($_GET['form'] === '4'){
$get_events = $db->query("SELECT distinct * FROM vs_events GROUP BY ID LIMIT $_GET[id],10");
$get_events_all = $db->query("SELECT distinct * FROM vs_events");

}
	
	

	
	
?>
<div class="main">
		<span class="title">Edit Forum: <?php echo $formname; ?></span>
		<div class="pad">
		<ul>
		<?php
			if($_GET['form'] === '1'){
				while($row_careers = $get_careers->fetch_assoc()){
		?>
		<span>----------------------------------------</span><br/>
		<span class="label">First Name :</span>
			<li>
				<?php echo $row_careers['first_name']; ?>
			</li>
		<span class="label">Last Name :</span>
			<li>
				<?php echo $row_careers['last_name']; ?>
			</li>
		<span class="label">Email :</span>
			<li>
				<?php echo $row_careers['email']; ?>
			</li>
		<span class="label">Position :</span>
			<li>
				<span> <?php echo $row_careers['position']; ?> <span>
			</li>
		<span class="label">Reason :</span>
			<li>
				<span> <?php echo $row_careers['reason']; ?> <span>
			</li>
		<span class="label">Resume :</span>
			<li>
				<span> <?php echo $row_careers['pdf_location']; ?> <span>
			</li>
		<span>----------------------------------------</span><br/>
		<?php
	}}
	?>
		<?php
			if($_GET['form'] === '2'){
				while($row_casestudies = $get_casestudies->fetch_assoc()){
		?>
		<span>----------------------------------------</span><br/>
		<span class="label">First Name :</span>
			<li>
				<?php echo $row_casestudies['firstname']; ?>
			</li>
		<span class="label">Last Name :</span>
			<li>
				<?php echo $row_casestudies['lastname']; ?>
			</li>
		<span class="label">Email :</span>
			<li>
				<?php echo $row_casestudies['email']; ?>
			</li>
		<span class="label">Phone :</span>
			<li>
				<span> <?php echo $row_casestudies['phone']; ?> <span>
			</li>

		<span class="label">Company: </span>
			<li>
				<span> <?php echo $row_casestudies['company']; ?></span>
			</li>
		<span class="label">Type: </span>
			<li>
				<span> <?php echo $row_casestudies['type']; ?></span>
			</li>
		<span>----------------------------------------</span><br/>
		<?php
	}}
	?>
		<?php
			if($_GET['form'] === '3'){
				while($row_contact = $get_contact->fetch_assoc()){
		?>
		<span>----------------------------------------</span><br/>
		<span class="label">Recipient :</span>
			<li>
				<?php echo $row_contact['recipient']; ?>
			</li>
		<span class="label">First Name :</span>
			<li>
				<?php echo $row_contact['firstname']; ?>
			</li>
		<span class="label">Last Name :</span>
			<li>
				<?php echo $row_contact['lastname']; ?>
			</li>
		<span class="label">Email :</span>
			<li>
				<?php echo $row_contact['email']; ?>
			</li>
		<span class="label">Phone :</span>
			<li>
				<span> <?php echo $row_contact['phoneone']; ?> - <span><span> <?php echo $row_contact['phonetwo']; ?> - <span><span> <?php echo $row_contact['phonethree']; ?> <span>
			</li>
		
		<span class="label">Message :</span>
			<li>
				<?php echo $row_contact['message']; ?>
			</li>
		<span>----------------------------------------</span><br/>
		<?php
	}}
	?>
		<?php
			if($_GET['form'] === '4'){
				while($row_events = $get_events->fetch_assoc()){
		?>
		<span>----------------------------------------</span><br/>
		<span class="label">Event :</span>
			<li>
				<?php echo $row_events['event']; ?>
			</li>
		<span class="label">First Name :</span>
			<li>
				<?php echo $row_events['firstname']; ?>
			</li>
		<span class="label">Last Name :</span>
			<li>
				<?php echo $row_events['lastname']; ?>
			</li>
		<span class="label">Email :</span>
			<li>
				<span> <?php echo $row_events['email']; ?> <span>
			</li>
			<span class="label">Phone :</span>
			<li>
				<?php echo $row_events['phone']; ?>
			</li>
		<span class="label">Address :</span>
			<li>
				<?php echo $row_events['address']; ?>
			</li>
		<span class="label">City :</span>
			<li>
				<?php echo $row_events['city']; ?>
			</li>
		<span class="label">State :</span>
			<li>
				<span> <?php echo $row_events['state']; ?> <span>
			</li>
			<span class="label">Zip :</span>
			<li>
				<?php echo $row_events['zip']; ?>
			</li>
		<span class="label">First Name 2 :</span>
			<li>
				<?php echo $row_events['firstname2']; ?>
			</li>
		<span class="label">Last Name 2 :</span>
			<li>
				<?php echo $row_events['lastname2']; ?>
			</li>
		<span class="label">Email 2 :</span>
			<li>
				<span> <?php echo $row_events['email2']; ?> <span>
			</li>
		<span class="label">Phone 2 :</span>
			<li>
				<span> <?php echo $row_events['phone2']; ?> <span>
			</li>
		<span>----------------------------------------</span><br/>
		<?php
	}}
	?>

		</ul>
		<?php
			$prev = "";
			$next = "";
			$rowlength = "";
			
			switch($_GET['form']){

					case '1':
					$rowlength = $get_careers_all->num_rows;
					break;

					case '2':
					$rowlength = $get_casestudies_all->num_rows;
					break;

					case '3':
					$rowlength = $get_contact_all->num_rows;
					break;

					case '4':
					$rowlength = $get_events_all->num_rows;
					break;
			}

			// var_dump($rowlength);
			// die();

			$prev = (int)$_GET['id'] - 10; if($prev < 0) $prev = 1;
			$next = (int)$_GET['id'] + 10; if($next > $rowlength) $next = $rowlength - 1 ;



		?>

		</div>
		<div class="pagination">
<?php
//	if($prev != 1){
?>		
		<a href="?form=<?php echo $_GET[form]; ?>&id=<?php echo $prev ;?>">PREV</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php	//} ?>
<?php //if($next != ($rowlength - 1) ){ ?>

		<a href="?form=<?php echo $_GET[form]; ?>&id=<?php echo $next ; ?>">NEXT</a></div>
<?php //} ?>
		<a href="/677b0138ef0087abb7a1cba1dd5b2978/export.php?form=<?php echo $_GET[form] ; ?>&id=<?php echo $_GET[id] ; ?>" alt="get csv">Get CSV</a>
	</div>
	<?php 

$db->close();

?>