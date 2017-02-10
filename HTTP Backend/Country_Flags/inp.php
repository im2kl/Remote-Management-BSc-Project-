
<?php
$fin = fopen('project.csv','r') or die('cant open file');
$link = @mysql_connect('localhost', 'root', '');
If (!$link) {
    die ('Could not connect: ' . mysql_error());
}
@mysql_select_db('cybortech') or die ('Unable to select database');
echo "Connection succeeded <br />\n";
while (($data=fgetcsv($fin,1000,","))!==FALSE) {
    //$query = "UPDATE catalog_product_entity SET sku='$data[1]' WHERE entity_id='$data[0]'";
	$sql = "INSERT INTO `country` (`sip`, `eip`, `c_code`) VALUES ('$data[0]','$data[1]','$data[2]')";
    mysql_query($sql);
    echo "Record updated: $data[0],$data[1],$data[2]<br /> \n";
    }
fclose($fin);
mysql_close();
?>


