<?php


require 'dbconfig.php';

$data = json_decode(json_encode($_POST));
//print_r($_REQUEST);
//$data = json_decode($_REQUEST);

$sql        = 'SELECT count(*) AS total FROM cannabis WHERE screening = "'.$data->screening.'"';
$query      = mysqli_query($conn_db, $sql);
$result     = mysqli_fetch_object($query);
//echo $result->total;
if($result->total > 200){
    http_response_code(400);
    exit(json_encode(['message'=>'วันที่ประสงค์เข้าคัดกรอง เต็ม 200 คนแล้ว กรุณาเลือกวันใหม่']));
}elseif(!checkCID($data->cid)){
    http_response_code(400);
    exit(json_encode(["message"=> "รหัสบัตรประชาชนไม่ถูกต้องตรวจสอบอีกครั้ง"]));
}elseif(empty($data->firstname)){
    http_response_code(400);
    exit(json_encode(["message"=> "ชื่อ- สกุล ต้องไม่ว่างเปล่า"]));
}

$query  = 'INSERT INTO cannabis(firstname,lastname,cid,birthday_en,disease,screening,mobile) VALUES(?,?,?,?,?,?,?)';

$stmt   = mysqli_prepare($conn_db, $query);   
    $birthday = ($data->year - 543)."-".$data->month."-".$data->day;
    mysqli_stmt_bind_param($stmt, 'sssssss',
        $data->firstname,
        $data->lastname,
        $data->cid,
        $birthday,
        $data->disease,
        $data->screening,
        $data->mobile
    );
    mysqli_stmt_execute($stmt);

    $error_message = mysqli_error($conn_db);
    if($error_message){
        http_response_code(400);
        exit(json_encode(['message' => $error_message]));
    }
   
    exit(json_encode(['message'=>'successful.','screening'=>$data->screening, 'cid'=>$data->cid]));


    function checkCID($pid) {
        if(strlen($pid) != 13) return false;
           for($i=0, $sum=0; $i<12;$i++)
           $sum += (int)($pid{$i})*(13-$i);
           if((11-($sum%11))%10 == (int)($pid{12}))
           return true; //true
        return false; //false
     }