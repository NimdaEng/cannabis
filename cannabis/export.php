<?php
/* ส่งออกรายงาน */



require_once 'mpdf/mpdf.php';
$mpdf = new mPDF('th'); //แนวนอน A4-L

if(empty($_GET['cid'])){
    http_response_code(400);
    exit(0);
}elseif(!checkCID($_GET['cid'])){
    exit("<h1>รหัสบัตรประชาชนไม่ถูกต้องตรวจสอบอีกครั้ง <a href='/index.php'>กรอกใหม่</a></h1>");
}

function checkCID($pid) {
    if(strlen($pid) != 13) return false;
       for($i=0, $sum=0; $i<12;$i++)
       $sum += (int)($pid{$i})*(13-$i);
       if((11-($sum%11))%10 == (int)($pid{12}))
       return true; //true
    return false; //false
 }

try {
    $link = new PDO('mysql:host=127.0.0.1;dbname=test', 'root', 'jhaturaphat', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo $ex;
}

$link->query("SET @row_number = 0");
$link->query("SET @screening = ''");

$stmt = $link->prepare("SELECT (@screening:=screening) FROM cannabis WHERE cid =:cid");
$stmt->bindValue(':cid', $_GET['cid'],PDO::PARAM_STR);
$stmt->execute();

$stmt = $link->prepare(" 
SELECT 
q.queue,
pt.*
FROM cannabis AS pt
INNER JOIN(
SELECT (@row_number:=@row_number + 1) AS queue, cannabis.id FROM cannabis WHERE screening = @screening ORDER BY create_at) AS q 
ON q.id = pt.id
WHERE pt.cid =:cid
");
$stmt->bindValue(':cid', $_GET['cid'],PDO::PARAM_STR);
$stmt->execute();

$mpdf->AddPageByArray(array(

    'orientation' => '',
    'condition' => 'NEXT-ODD',
    'resetpagenum' => '',
    'pagenumstyle' => '',  
    'mode' => 'utf-8',  
    'format'=> [190, 236] ,
    'suppress' => '',
    'mgl' => '',
    'mgr' => '',
    'mgt' =>2,
    'mgb' => '',
    'mgh' => '',
    'mgf' => '',
    'ohname' => 'myHeader',
    'ehname' => '',
    'ofname' => '',
    'efname' => '',
    'ohvalue' => 1,
    'ehvalue' => 1,
    'ofvalue' => 0,
    'efvalue' => 0,
    'pagesel' => '',
    'newformat' => '',
    ));

while($row = $stmt->fetch(PDO::FETCH_OBJ)){  
    $mpdf->WriteHTML('<DIV style="text-align: right; font-size:1em; margin-top: 0px;">โครงการวิจัยน้ำมันกัญชา เฟสที่ 1 อ.เดชา ศิริภัทร</DIV>');    
    $mpdf->WriteHTML('
    <DIV style="text-align: center; font-size:3em;margin-top: 25px;">ได้คิวที่</DIV>
    <DIV style="text-align: center; font-size:8em; margin-top: -30px;">'. $row->queue.'</DIV>    
    '); 
    $mpdf->WriteHTML('<DIV style="text-align: center; font-size:1.5em; margin-top: 0px;">วันที่ '. show_tdate($row->screening).'</DIV>');
    $mpdf->WriteHTML('<DIV style="text-align: center; font-size:1.8em; margin-top: 2px;">ชื่อ-สกุล '. $row->firstname.'  '.$row->lastname.'</DIV>');   
    $mpdf->WriteHTML('<DIV style="text-align: center; font-size:2em; margin-top: 5px;">***หมายเหตุ ต้องมาร่วมก่อน 09.00 น. ตรงเวลา***</DIV>');  
}

$mpdf->Output(date('Y-m-d').'.pdf', 'I');


function  show_tdate($date_in) // กำหนดชื่อของฟังชั่น show_tdate และสร้างตัวแปล $date_in ในการรับค่าที่ส่งมา
{
    $month_arr = array("มกราคม" , "กุมภาพันธ์" , "มีนาคม" , "เมษายน" , "พฤษภาคม" , "มิถุนายน" , "กรกฏาคม" , "สิงหาคม" , "กันยายน" , "ตุลาคม" ,"พฤศจิกายน" , "ธันวาคม" ) ; //กำหนด อาร์เรย์ $month_arr  เพื่อเก็บ ชื่อเดือน ของไทย

    // ใช้ฟังชั่น strtok เพื่อแยก ปี เดือน วัน
    // โดยเริ่มจาก ปีก่อน
    $tok = strtok($date_in, "-"); //สร้างตัวแปล $tok เพื่อเก็บค่าแยกของปี ออกมา
    $year = $tok ; //กำหนดค่าให้ ตัวแปล $year มีค่าเท่ากับ ปีที่ ถูกแยกออกมาจาก ตัวแปล $tok

    //ต่อไปคือส่วนของ เดือน
    $tok  = strtok("-");// ส่วนนี้เราจะมีไว้เพื่อทำการแยกเดือน
    $month = $tok ;//สร้างตัวแปล$monthเพื่อเก็บค่าแยกของเดือน ออกมา
    //

    //ต่อไปส่วนสุดท้ายคือ ส่วนของวันที่
    $tok = strtok("-");//ส่วนนี้เราจะมีไว้เพื่อทำการแยกเดือน
    $day = $tok ;//สร้างตัวแปล $$dayเพื่อเก็บค่าแยกของเดือน ออกมา

    //เมื่อได้ส่วนแยกของ วัน เดือน ปี มาแล้วว แต่ ปี ยังเป็นรูปแบบของ ค.ศ. ดังนั้นเราต้องแปล เป็น พ.ศ.  ก่อนด้ววิธีกรนนี้

    $year_out = $year + 543 ;// สร้างตัวแแปลขึ้นมาเพื่อเก็บค่าที่ได้จากการนำปี ค.ศ. มาบวกกับ 543  ก็จะได้ปีที่เป็น  พ.ศ. ออกมา

    $cnt = $month-1 ;// เราตัองสร้างตัวแปล มาเพื่อเก็บค่าเดือน โดยจะต้องเอาเดือนที่ได้มา ลบ 1 เพราะว่า เราจะต้องใช้ในการเทียบกับ ค่าที่อยู่ได้อาร์เรย์ เนื่องจาก อาร์เรย์จะมีค่า เริ่มจาก 0
    $month_out = $month_arr[$cnt] ;// ทำการเทียบค่าเดือนที่ได้กับเดือนที่เก็บไว้ในอาร์เรย์ แล้วเก็บลงใน ตัวแปล


    $t_date = $day." ".$month_out." ".$year_out ; //สร้างตัวแปลเก็บค่า วัน เดือน ปี ที่แปลเป็นไทยแล้ว

    return $t_date ;// ส่งค่ากลับไปยังส่วนที่ส่งมา
}



