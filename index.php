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
if(PHP_SAPI === 'cli')
{
	echo 'command line \r\n';

	while($r=$query->fetch()){
		echo $r->id." > ".$r->created." > ".$r->title."\r\n";
		echo $r->id." > ".$r->memo."\r\n";
		print "\r\n";
	}
}
else
{
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<!--	<meta name="viewport" content="initial-scale=0.70, minimal-ui">
-->	<meta name="description" content="my memo history">
	<meta name="author" content="duru">

	<link rel="stylesheet" type="text/css" href="timeline.css">
	
	<title>memo</title>
</head>
<body>
		<h2>memo history</h2>

<ul id='timeline'>		<!-- entry -->


  <li class='work'>
    <input class='radio' id='work0' name='works' type='radio' checked>
    <div class="relative">
      <label for='work0'>momo history</label>
      <span class='date'></span>
      <span class='circle'></span>
    </div>
    <div class='content'>
      <p>
	git memo
      </p>
    </div>
   </li>
<?php
 
while($r=$query->fetch()){
echo " <li class='work'>";
echo "   <input class='radio' id='work".$r->id."' name='works' type='radio'>";
echo "   <div class='relative'>";
echo "     <label for='work".$r->id."'>".$r->title."</label>";
echo "     <span class='date'>".substr($r->created,0,10)."</span>";
echo "     <span class='circle'></span>";
echo "   </div>";
echo "   <div class='content'>";
echo "      <p>";
echo $r->memo;
echo "     </p>";
echo " </div>";
echo " </li>";
}
?>

</ul>
		<!-- entry end -->
</body>
</html>
<?php
}
?>
