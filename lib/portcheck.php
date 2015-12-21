<?php
$output=array();
if(!isset($_POST['query']))
{
	
	return json_encode($output);
}
$host=$_POST['query'];
$ports = array(21,22,23,25,53,80,110,111,139,135,143,8080,443,3306,1433,1337);
foreach ($ports as $port)
{
	$connection = fsockopen($host, $port, $errno, $errstr, 0.7);
	if (is_resource($connection))
	{
		$output[$port]=array('is_open'=>true,'name'=> getservbyport($port, 'tcp'));
	}
	else
	{
		$output[$port]=array('is_open'=>false,'name'=> getservbyport($port, 'tcp'));
	}
	fclose($connection);
}
echo json_encode($output);
?>

