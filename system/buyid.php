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
     if (preg_match('/^[0-9]+$/', (int)$_POST['id'])) {
          $q_1 = dd_q('SELECT * FROM users WHERE id = ?', [$_SESSION['id']]);
          if ($q_1->rowCount() >= 1) {
                $row_1 = $q_1->fetch(PDO::FETCH_ASSOC);
                $p = dd_q("SELECT * FROM id_product WHERE id = ? AND o_id = 0 ",[$_POST['id']]);
                if($p->rowCount() >= 1){
                    $pd = $p->fetch(PDO::FETCH_ASSOC);
                    $point = (int) $row_1['point'];
                    $price = (int) $pd['price'];
                    if($point >= $price){
                        $s = dd_q("SELECT * FROM id_product WHERE id = ? AND o_id = 0 ", [$pd['id']]);
                        if($s->rowCount() >= 1){
                            $log = dd_q("INSERT INTO id_log (u_id,p_id,date) VALUES (? , ? , NOW() )",[$_SESSION['id'], $pd['id']]);
                            $upt = dd_q("UPDATE users SET point = point  - ? WHERE id = ? ",[$price , $_SESSION['id']]);
                            $upt = dd_q("UPDATE id_product SET o_id = ? WHERE id = ? LIMIT 1",[$_SESSION['id'], $pd['id']]);
                            dd_return(true, "ซื้อสินค้าสำเร็จ กรุณาเช็คกล่องจดหมาย");
                        }else{
                            dd_return(false, "สินค้าหมดแล้วครับ");
                        }
                    }else{
                        dd_return(false, "คุณมียอดเงินไม่เพียงพอ");
                    }
                }else{
                    dd_return(false, "ไม่พบสินค้า");
                }
          }else{
            dd_return(false, "ไม่พบชื่อผู้ใช้งาน");
          }
      }else{
      dd_return(false, "กรุณากรอก ตัวเลข เท่านั้น");
      }
    }else{
    dd_return(false, "เข้าสู่ระบบก่อนทำรายการ");
    }
}else{
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
}









?>
