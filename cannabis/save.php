<?php
require 'dbconfig.php';

$data = json_decode(json_encode($_POST));


$sql        = 'SELECT count(*) AS total FROM cannabis WHERE screening = "'.$data->screening.'"';
$query      = mysqli_query($conn_db, $sql);
$result     = mysqli_fetch_object($query);
//echo $result->total;
if($result->total > 20){
    http_response_code(400);
    exit(json_encode(['message'=>'วันที่ประสงค์เข้าคัดกรอง เต็ม 200 คนแล้ว กรุณาเลือกวันใหม่']));
}

$query  = 'INSERT INTO cannabis(firstname,lastname,cid,birthday_en,disease,screening) VALUES(?,?,?,?,?,?)';

$stmt   = mysqli_prepare($conn_db, $query);   
    $birthday = ($data->year - 543)."-".$data->month."-".$data->day;
    mysqli_stmt_bind_param($stmt, 'ssssss',
        $data->firstname,
        $data->lastname,
        $data->cid,
        $birthday,
        $data->disease,
        $data->screening
    );
    mysqli_stmt_execute($stmt);

    $error_message = mysqli_error($conn_db);
    if($error_message){
        http_response_code(400);
        exit(json_encode(['message' => $error_message]));
    }

    exit(json_encode(['message'=>'successful.']));

    