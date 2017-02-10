<?php


$csv = str_getcsv(file_get_contents('dbip.csv'));

echo '<pre>';
print_r($csv);
echo '</pre>';



?>



