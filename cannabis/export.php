<?php
/* ส่งออกรายงาน */



require_once 'mpdf/mpdf.php';
$mpdf = new mPDF('th', array(190,236), 12, ''); //แนวนอน A4-L

if(empty($_GET['cid'])){
    exit(0);
}elseif(!checkCID($_GET['cid'])){
    exit("<h1>รหัสบัตรประชาชนไม่ถูกต้องตรวจสอบอีกครั้ง</h1>");
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

while($row = $stmt->fetch(PDO::FETCH_OBJ)){  
    $mpdf->WriteHTML('
    <DIV style="text-align: center; font-size:8em">คิวที่</DIV>
    <DIV style="text-align: center; font-size:15em; margin-top: -50px;">'. $row->queue.'</DIV>
    <DIV style="text-align: center; font-size:2em; margin-top: 0px;">'. $row->firstname.'  '.$row->lastname.'</DIV>
    ');    
}

$mpdf->Output(date('Y-m-d').'.pdf', 'I');

