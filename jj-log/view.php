<meta http-equiv="refresh" content="15" > 

<?php


$banner = <<<'EOD'
<pre>+-----------+-----------+
|   <a href="view.php?clear=1">Clear</a>   |  <a href="view.php">Reload</a>   |
+-----------+-----------+</pre>
EOD;


echo $banner;


if (isset($_GET['clear'])) {
	unlink('access.log');
	header("Location: view.php");
	die();
}


// echo str_repeat("-", 40);



$myfile = fopen("access.log", "r") or die(" Not found log file ");
echo "<pre>" . fread($myfile,filesize("access.log")) . "</pre>";
fclose($myfile);



?>