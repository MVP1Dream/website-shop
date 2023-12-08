<?php
require_once 'a_func.php';


function dd_return($status, $message , $award = null)
{
    if ($status) {
        $json = ['message' => $message , 'selector' => "id" ,"winner" => strval($award), 'nonce' => $_REQUEST['nonce']];
        http_response_code(200);
        die(json_encode($json));
    } else {
        $json = ['message' => $message];
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
        if ($_POST['wheel'] != "") {
            $q_1 = dd_q('SELECT * FROM users WHERE id = ?', [$_SESSION['id']]);
            $find_wheel = dd_q("SELECT * FROM wheel WHERE id = ? ", [$_POST['wheel']]);
            $wheel = $find_wheel->fetch(PDO::FETCH_ASSOC);
            $user_point = (int) $plr['point'];
            $price = (int) $wheel['price'];
            if($user_point >= $price){
                $find_item = dd_q("SELECT * FROM wheel_item WHERE w_id = ? ORDER BY percent DESC", [$wheel['id']]);
                $sold = false;
                while($item = $find_item->fetch(PDO::FETCH_ASSOC)){
                    $find_stock = dd_q("SELECT * FROM stock_wheel WHERE p_id = ? ", [$item['id']]);
                    if($find_stock->rowCount() >= 1){
                        continue;
                    }else{
                        $sold = true;
                    } 
                }
                if(!$sold){
                    $found = false;
                    while(!$found){
                        $find_item = dd_q("SELECT * FROM wheel_item WHERE w_id = ? ORDER BY percent DESC", [$wheel['id']]);
                        while ($item = $find_item->fetch(PDO::FETCH_ASSOC)) {
                            $luck =  rand(1, 1000); //random rate
                            $percent = $item['percent'] * 10; //max rate of random
                            $find_stock = dd_q("SELECT * FROM stock_wheel WHERE p_id = ? ", [$item['id']]); // check stock
                            if($find_stock->rowCount() > 0){
                                if ($luck <= $percent ) {
                                    $upt = dd_q("UPDATE users SET point = point - ?  WHERE id = ? ", [$price, $_SESSION['id']]);
                                    $find_stock = dd_q("SELECT * FROM stock_wheel WHERE p_id = ?  LIMIT 1", [$item['id']]);
                                    $stock = $find_stock->fetch(PDO::FETCH_ASSOC);
                                    $insert = dd_q("INSERT INTO boxlog (date , username , category , price , prize_name , uid)
                                        VALUES ( NOW() , ? , ? , ? , ? , ?  ) 
                                    ", [
                                        $plr["username"],
                                        $item["name"],
                                        $wheel["price"],
                                        $stock["username"],
                                        $_SESSION['id']
                                    ]);
                                    $found = true;
                                    $del = dd_q("DELETE FROM stock_wheel WHERE id = ? ", [$stock['id']]);

                                    dd_return(true, "ยินดีด้วยคุณได้รับ ".$item['name'] , $item['id']);
                                } else {
                                    continue;
                                }
                                
                            }else{
                                $found = true;
                                dd_return(false, "มีของรางวัลบางส่วนหมด โปรดลองอีกครั้งในภายหลัง");
                            }
                        }
                    }
                }else{
                    dd_return(false, "มีของรางวัลบางส่วนหมด โปรดลองอีกครั้งในภายหลัง");
                }
            }else{
                dd_return(false, "คุณมีเงินไม่เพียงพอต่อการสั่งซื้อ");
            }
            // random code


        } else {
            dd_return(false,  "โปรดกรอกข้อมูลให้ครบถ้วน");
        }
    } else {
        dd_return(false,  "เข้าสู่ระบบก่อนทำรายการ");
    }
} else {
    dd_return(false,  "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
}
