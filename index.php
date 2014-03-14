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
	public $id, $title, $description, $created;
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

$query = $hndlr->query('SELECT * FROM memo');
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

?>
		<ul>
			<li>
		<div class="entry">
			<div class="title">
				<h3>
					"title"
				</h3>
			</div>
			
			<article>
				memo 내용이 들어감	
			</article>
			
			<div class="created"><span>"만든날짜"</span></div>		
		</div>
			</li>
		</ul>
		<!-- entry end -->
	</div>
</body>
</html>
