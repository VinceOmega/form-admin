<?php

include 'config.php';

$db = new mysqli('localhost', $username, $password, 'arifleet');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}

if(isset($_POST['subid']) &&
	isset($_POST['title']) &&
	isset($_POST['url']) &&
	isset($_POST['h1']) &&
	isset($_POST['h2']) &&
	isset($_POST['h3']) &&
	isset($_POST['h4']) &&
	isset($_POST['h5']) &&
	isset($_POST['h6']) &&
	isset($_POST['alt_tag']) &&
	isset($_POST['keyword_count']) &&
	isset($_POST['content_count']) &&
	isset($_POST['robot_text_code']) &&
	isset($_POST['rich_snippet_code']) &&
	isset($_POST['cannonical_tags']) &&
	isset($_POST['author_tags']) &&
	isset($_POST['hCard']) &&
	isset($_POST['meta']) &&
	$_POST['title'] != "" 
	

){

	if(empty($_POST['subid'] )){

			$getsubid  = $db->query('SELECT subid FROM meta_page_home WHERE pageid = ' .$_GET['id']);
			$row = mysqli_fetch_assoc($getsubid);
			$_POST['subid'] = $row['subid'];
		

	} else if(isset($_POST['subid']) && $_POST['subid'] === 'top' ){
			$_POST['subid'] = 0;
		

	}

	// var_dump($_POST['subid']);
	// die();

	$subid = htmlspecialchars(strip_tags($_POST['subid']));
	$title = htmlspecialchars(strip_tags($_POST['title']));
	$url = htmlspecialchars(strip_tags($_POST['url']));
	$hone = htmlspecialchars(strip_tags($_POST['h1']));
	$htwo = htmlspecialchars(strip_tags($_POST['h2']));
	$hthree = htmlspecialchars(strip_tags($_POST['h3']));
	$hfour = htmlspecialchars(strip_tags($_POST['h4']));
	$hfive = htmlspecialchars(strip_tags($_POST['h5']));
	$hsix = htmlspecialchars(strip_tags($_POST['h6']));
	$alt_tag = htmlspecialchars(strip_tags($_POST['alt_tag']));
	$keyword_count = htmlspecialchars(strip_tags($_POST['keyword_count']));
	$content_count = htmlspecialchars(strip_tags($_POST['content_count']));
	$robot_text_code = htmlspecialchars(strip_tags($_POST['robot_text_code']));
	$rich_snippet_code = htmlspecialchars(strip_tags($_POST['rich_snippet_code']));
	$cannonical_tags = htmlspecialchars(strip_tags($_POST['cannonical_tags']));
	$author_tags = htmlspecialchars(strip_tags($_POST['author_tags']));
	$hCard = htmlspecialchars(strip_tags($_POST['hCard']));
	$meta = $_POST['meta'];

	

$stmt = $db->prepare(
	"UPDATE meta_page_home   
	 SET

	 	subid = TRIM(?),
	 	title = TRIM(?),
	 	url = TRIM(?),
	 	h1 = TRIM(?),
	 	h2 = TRIM(?),
	 	h3 = TRIM(?),
	 	h4 = TRIM(?),
	 	h5 = TRIM(?),
	 	h6 = TRIM(?),
	 	alt_tag = TRIM(?),
	 	keyword_count = TRIM(?),
	 	content_count = TRIM(?),
	 	robot_text_code = TRIM(?),
	 	rich_snippet_code = TRIM(?),
	 	cannonical_tags = TRIM(?),
	 	author_tags = TRIM(?),
	 	hCard = TRIM(?),
	 	meta = TRIM(?)
	 	
	 WHERE pageid = TRIM(?)"
	);

//var_dump($stmt);
if($stmt === false){
	printf(mysqli_error($db));
 }
// echo 'subid ';
// var_dump($subid);
// echo 'title ';
// var_dump($title);
// echo 'url ';
// var_dump($url);
// echo 'h1 ';
// var_dump($hone);
// echo 'h2 ';
// var_dump($htwo);
// echo 'h3 ';
// var_dump($hthree);
// echo 'h4 ';
// var_dump($hfour);
// echo 'h5 ';
// var_dump($hfive);
// echo 'h6 ';
// var_dump($hsix);
// echo 'alternative tag ';
// var_dump($alt_tag);
// echo 'keyword count ';
// var_dump($keyword_count);
// echo 'content count ';
// var_dump($content_count);
// echo 'robot text code ';
// var_dump($robot_text_code);
// echo 'rich snippet code ';
// var_dump($rich_snippet_code);
// echo 'cannonical tags ';
// var_dump($cannonical_tags);
// echo 'author tags ';
// var_dump($author_tags);
// echo 'h Card ';
// var_dump($hCard);
// echo 'meta ';
// var_dump($meta);
// echo 'pageid ';
// var_dump($_GET['id']);
//die();

$stmt->bind_param('issssssssssssssssss',
	$subid, 
	$title, 
	$url, 
	$hone, 
	$htwo, 
	$hthree, 
	$hfour, 
	$hfive,
	$hsix,
	$alt_tag,
	$keyword_count,
	$content_count,
	$robot_text_code,
	$rich_snippet_code,
	$cannonical_tags,
	$author_tags,
	$hCard,
	$meta,
	$_GET['id']
	);

 $stmt->execute();
 $stmt->close();
 $db->close();
 header("Location: /madmin/?id=$_GET[id]&changed=1");
}	
	


?>