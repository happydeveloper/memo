<!--
                               
  _____   ____   _____   ____  
 /     \_/ __ \ /     \ /  _ \ 
|  Y Y  \  ___/|  Y Y  (  <_> )
|__|_|  /\___  >__|_|  /\____/ 
      \/     \/      \/        

-->
<?php
// data transfer object
class memoEntry {
	public $id, $title, $memo, $created;
	public function __Construct() {
		
	}
}
?>

<?php
// persistence layer
try {
	$hndlr = new PDO('mysql:host=127.0.0.1;dbname=memo','root','1111', array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
	$hndlr->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo $e->getMessage();
	die('sorry, database problems');
}

$query = $hndlr->query('SELECT * FROM memo order by created desc');
$query->setFetchMode(PDO::FETCH_CLASS, 'memoEntry');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=0.70">
	<meta name="description" content="my memo history">
	<meta name="author" content="duru">
	
	<title>memo</title>
</head>
<body>
	<div class="content">
		<h2>memo history</h2>
		<!-- entry -->
<?php
	//service layer, present layer
while($r=$query->fetch()){
	echo '<li><div class="enrty memo">';
	echo '<div class="id">',$r->id ,'</div>';
	echo '<div class="title"><h3>', $r->title , '</h3></div>';
	echo '<div class="memo">', $r->memo ,'</div>';
	echo '<div class="created">', $r->created ,'</div>';
	echo' </div></li>';
}

?>
		<!-- entry end -->
	</div>
</body>
</html>
