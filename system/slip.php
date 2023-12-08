<?php
error_reporting(0);

require_once './a_func.php';
require_once './yosiket.class.php';

$ys = new yosiket();

function dd_return($status, $message)
{
    if ($status) {
        $json = ['status' => 'success', 'message' => $message];
        http_response_code(200);
        die(json_encode($json));
    } else {
        $json = ['status' => 'fail', 'message' => $message];
        http_response_code(400);
        die(json_encode($json));
    }
}

$config_bank = dd_q("SELECT * FROM bank")->fetch(PDO::FETCH_ASSOC);

//////////////////////////////////////////////////////////////////////////

header('Content-Type: application/json; charset=utf-8;');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id'])) {
        $plr = dd_q("SELECT * FROM users WHERE id = ?", [$_SESSION['id']])->fetch(PDO::FETCH_ASSOC);
        if ($_POST['qrcode'] != '') {
            $sc = json_decode($ys->slip_check($_POST['qrcode']));
            if ($sc->status == false) {
                $full_name = $config_bank['fname'];
                $recv_name = explode(" ", $sc->data->receiver->displayName);
                if ($full_name == $recv_name[1]) {
                    $info = $sc->data;
                    $amount = $info->amount;
                    $ref =  $info->transRef;
                    $q1 = dd_q("SELECT * FROM kbank_trans WHERE ref = ?", [$ref]);
                    if ($q1->rowCount() < 1) {
                        $ha = dd_q(
                            "INSERT INTO `topup_his` (`id`, `link`, `amount`, `date`, `uid`, `uname`) VALUES (NULL, ? ,  ? , NOW() , ? , ? )",
                            [
                                "สลิปบัญชีชื่อ : " . $info->sender->displayName,
                                $amount,
                                $_SESSION['id'],
                                $plr['username']
                            ]
                        );
                        $insert_ref = dd_q("INSERT INTO `kbank_trans`(`ref`, `sender`) VALUES(?,?)", [$ref, $info->sender->displayName]);
                        $update_user = dd_q("UPDATE users SET point = ? WHERE id = ?", [$plr['point'] + $amount, $_SESSION['id']]);
                        if ($ha and $insert_ref and $update_user) {
                            dd_return(true, "คุณเติมเงินสำเร็จจำนวน " . $amount . " บาท");
                        } else {
                            dd_return(false, "SQL ผิดพลาด");
                        }
                    } else {
                        dd_return(false, "สลิปนี้ใช้แล้ว");
                    }
                } else {
                    dd_return(false, "หมายเลขบัญชีหรือธนาคารไม่ตรงกลับทางร้าน");
                }
            } else {
                dd_return(false, "Qr code ไม่ถูกต้อง");
            }
        } else {
            dd_return(false, "กรุณาส่งข้อมูลให้ครบ");
        }
    } else {
        dd_return(false, "เข้าสู่ระบบก่อนดำเนินการ");
    }
} else {
    dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
}
