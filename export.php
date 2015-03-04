<?php

// ini_set('display_errors',1); 
//  error_reporting(E_ALL);
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
 				$formname = 'Case Studies';
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
	job_position FROM 
	vs_careers
	GROUP BY careers_id
	LIMIT $_GET[id], 10
	");

	$get_careers_all = $db->query("SELECT distinct first_name, last_name, email, position, reason, job_position FROM vs_careers ");

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

	
	$careers = array(
						0 => array(
									'first_name' => '',
									'last_name' => '',
									'email' => '',
									'position' => '',
									'reason' => '',
									'job_position' => ''

							)
		);

		$casestudies = array(
						0 => array(
									'first_name' => '',
									'last_name' => '',
									'email' => '',
									'phone' => '',
									'company' => ''
									
							)
		);

			$contact = array(
						0 => array(
									'recipient' => '',
									'first_name' => '',
									'last_name' => '',
									'email' => '',
									'phone' => '',
									'message' => ''
									
							)
		);


				$events = array(
						0 => array(
									'first_name' => '',
									'last_name' => '',
									'email' => '',
									'phone' => '',
									'address' => '',
									'city' => '',
									'state' => '',
									'zip' => '',
									'guest_first_name' => '',
									'guest_last_name' => '',
									'guest_email' => '',
									'guest_phone' => ''
									
							)
		);

$i = 0;






	if($_GET['form'] === '1'){
				while( $rows_careers = $get_careers_all->fetch_assoc() ){
						
						$careers[$i]['first_name'] = $rows_careers['first_name'];
						$careers[$i]['last_name'] = $rows_careers['last_name'];
						$careers[$i]['email'] = $rows_careers['email'];
						$careers[$i]['position'] = $rows_careers['position'];
						$careers[$i]['job_position'] = $rows_careers['job_position'];

						$i++;
				}
	

				$db->close();

		

				$fn = 'career.csv';
				$file = fopen($fn, 'w+');
				foreach($careers as $key){



						$record = array(
							$key['first_name'], 
							$key['last_name'], 
							$key['email'], 
							$key['position'], 
							$key['job_position']
							);
						if($file){
							fputcsv($file, $record);
						}
				}

				fclose($file);
	
	}

	if($_GET['form'] === '2'){
				while( $rows_casestudy = $get_casestudies_all->fetch_assoc() ){

					$casestudies[$i]['first_name'] = $rows_casestudy['firstname'];
					$casestudies[$i]['last_name'] = $rows_casestudy['lastname'];
					$casestudies[$i]['email'] = $rows_casestudy['email'];
					$casestudies[$i]['phone'] = $rows_casestudy['phone'];
					$casestudies[$i]['company'] = $rows_casestudy['company'];

					$i++;
				}

				$db->close();
				$fn = 'casestudy.csv';
				$file = fopen($fn, 'w+');
				foreach($casestudies as $key){

						$record = array(
							$key['first_name'], 
							$key['last_name'], 
							$key['email'], 
							$key['phone'], 
							$key['company']
							);
						if($file){
							fputcsv($file, $record);
						}
				}

				fclose($file);
	
	}

	if($_GET['form'] === '3'){
			while( $rows_contact = $get_contact_all->fetch_assoc() ){

					$contact[$i]['recipient'] = $rows_contact['recipient'];
					$contact[$i]['first_name'] = $rows_contact['firstname'];
					$contact[$i]['last_name'] = $rows_contact['lastname'];
					$contact[$i]['email'] = $rows_contact['email'];
					$contact[$i]['phone'] = $rows_contact['phoneone']."-".$rows_contact['phonetwo']."-".$rows_contact['phonethree'];
					$contact[$i]['message'] = $rows_contact['message'];

					$i++;
			}
			$db->close();
			$fn = 'contact.csv';
			$file = fopen($fn, 'w+');
				foreach($contact as $key){


					//var_dump($key);

						$record = array(
							$key['recipient'],
							$key['first_name'], 
							$key['last_name'], 
							$key['email'], 
							$key['phone'], 
							$key['message']
							);
						if($file){
							fputcsv($file, $record);
						}
				}

				fclose($file);
		}

	if($_GET['form'] === '4'){
			while( $rows_events = $get_events_all->fetch_assoc() ){

					$events[$i]['first_name'] = $rows_events['firstname'];
					$events[$i]['last_name'] = $rows_events['lastname'];
					$events[$i]['email'] = $rows_events['email'];
					$events[$i]['phone'] = $rows_events['phone'];
					$events[$i]['address'] = $rows_events['address'];
					$events[$i]['city'] = $rows_events['city'];
					$events[$i]['state'] = $rows_events['state'];
					$events[$i]['zip'] = $rows_events['zip'];
					$events[$i]['guest_first_name'] = $rows_events['firstname2'];
					$events[$i]['guest_last_name'] = $rows_events['lastname2'];
					$events[$i]['guest_email'] = $rows_events['email2'];
					$events[$i]['guest_phone'] = $rows_events['phone2'];

					$i++;
			}

			$db->close();
					$fn = 'events.csv';
					$file = fopen($fn, 'w+');
				foreach($events as $key){

						$record = array(

							$key['first_name'], 
							$key['last_name'], 
							$key['email'], 
							$key['phone'], 
							$key['address'],
							$key['city'],
							$key['state'],
							$key['zip'],
							$key['guest_first_name'],
							$key['guess_last_name'],
							$key['guest_email'],
							$key['guest_phone']
							);
						if($file){
							fputcsv($file, $record);
						}
				}

				fclose($file);


		}
	
?>
<html>
<head>
<title>Download File</title>
</head>
<body>
<iframe src="/677b0138ef0087abb7a1cba1dd5b2978/dl.php?file=<?php echo $fn ; ?>" width="0" height="0">

</iframe>
	<script type="text/javascript">
			function plzRedirect(){		
			window.location.href = "/677b0138ef0087abb7a1cba1dd5b2978/?form=<?php echo $_GET[form] ; ?>&id=<?php echo $_GET[id] ; ?>";
			}

			window.setTimeout(plzRedirect, 1000);
	</script>
</body>

</html>
	
