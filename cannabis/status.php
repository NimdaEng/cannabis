<?php
require 'dbconfig.php';

$data = json_decode(json_encode($_GET));
$sql        = 'SELECT screening,count(*) AS total FROM cannabis WHERE screening = "'.$data->screening.'"';
$query      = mysqli_query($conn_db, $sql);
$result     = mysqli_fetch_object($query);

exit(json_encode($result, TRUE));