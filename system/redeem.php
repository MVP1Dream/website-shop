<?php
require_once 'a_func.php';



function dd_return($status, $message) {
    $json = ['message' => $message];
    if ($status) {
        http_response_code(200);
        die(json_encode($json));
    }else{
        http_response_code(400);
        die(json_encode($json));
    }
}

// //////////////////////////////////////////////////////////////////////////

header('Content-Type: application/json; charset=utf-8;');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id'])) {
        $p = dd_q("SELECT * FROM users WHERE id = ? ", [$_SESSION['id']]);
        $plr = $p->fetch(PDO::FETCH_ASSOC);
        if($_POST['link'] != ""){
            $find = dd_q("SELECT * FROM redeem WHERE code = ? ", [$_POST['link']]);
            if($find->rowCount() >= 1){
                $code = $find->fetch(PDO::FETCH_ASSOC);
                if($code['count'] < $code['max_count']){
                    $re_his = dd_q("SELECT * FROM redeem_his WHERE code = ? AND uid = ?  ", [$_POST['link'], $_SESSION['id']]);
                    if($re_his->rowCount() < 1){
                        $upt = dd_q("UPDATE users SET point = point + ? WHERE id = ? ", [$code['prize'], $_SESSION['id']]);
                        $upt2 = dd_q("UPDATE redeem SET count = count + 1  WHERE id = ? ", [$code['id']]);
                        $insert = dd_q("INSERT INTO redeem_his (date,code,uid) VALUES (NOW() , ? , ? )", [$code['code'], $_SESSION['id']]);
                        if($insert AND $upt AND $upt2){
                            dd_return(true,   "รับรางวัลสำเร็จ");
                        }else{
                            dd_return(false,   "ERROR redeem API โปรดติดต่อเจ้าของเว็บนี้!");
                        }
                    }else{
                        dd_return(false,   "คุณกรอกโค้ดนี้ไปแล้ว");
                    }
                }else{
                    dd_return(false,   "โค้ดนี้มีการใช้งานครบแล้ว");
                }
            }else{
                dd_return(false,   "โค้ดนี้ไม่มีในระบบ");
            }
        }
    }else{
    dd_return(false,"เข้าสู่ระบบก่อนทำรายการ");
    }
}else{
dd_return(false,  "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
}









?>
