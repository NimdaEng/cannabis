
<?php
$host       = '127.0.0.1';
$user       = 'root';
$password   = '';
$dbname     = 'test';

$conn_db = mysqli_connect($host, $user, $password, $dbname);
// Change character set to utf8
mysqli_set_charset($conn_db,"utf8");
if(!$conn_db)
{
    http_response_code(500);
    echo json_encode([
        'message'   => 'database connect error.',
        'error'     => mysqli_connect_error()
    ]);
    exit;
}