<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'a_func.php';

function dd_return($status, $message)
{
    if ($status) {
        $json = ['status' => 'success', 'message' => $message];
        http_response_code(200);
        die(json_encode($json));
    } else {
        $json = ['status' => 'fail', 'message' => $message];
        http_response_code(200);
        die(json_encode($json));
    }
}

//////////////////////////////////////////////////////////////////////////

header('Content-Type: application/json; charset=utf-8;');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['id'])) {
        $user_login = $_POST['user'];
        $pwd_login = $_POST['pass'];
        $pwd2_login = $_POST['pass2'];
        $secret = $conf['secretkey'];
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://challenges.cloudflare.com/turnstile/v0/siteverify',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'secret=0x4AAAAAAAHloBAZjibQo8AI3rxvs976Pg4&response='.$_POST["captcha"],
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));
    
        $response = curl_exec($curl);
    
        curl_close($curl);
        $captcha_success = json_decode($response);
        if ($captcha_success->success == false) {
            dd_return(false, "กรุณายืนยันตัวตน");
        } else if ($captcha_success->success == true) {
            //================================================================
            if ($user_login != "" && $pwd_login != "" && $pwd2_login != "") {
                if ($pwd_login == $pwd2_login) {
                    $q = dd_q("SELECT * FROM users WHERE username = ? ", [$_POST['user']]);
                    if ($q->rowCount() == 1) {
                        dd_return(false, "ชื่อนี้ผู้ใช้แล้ว");
                    } else {
                        $in = dd_q("INSERT INTO users (username,password,date,point,total) VALUES ( ? , ? , NOW() , 0 , 0 )", [
                            $user_login,
                            md5($pwd_login)
                        ]);
                        if ($in == true) {
                            $q = dd_q("SELECT * FROM users WHERE username = ? AND password = ? ", [
                                $user_login,
                                md5($pwd_login)
                            ]);
                            $dt = $q->fetch(PDO::FETCH_ASSOC);
                            $_SESSION['id'] = $dt['id'];
                            dd_return(true, "สมัครสมาชิกสำเร็จ");
                        } else {
                            dd_return(false, "ผิดพลาด");
                        }
                    }
                } else {
                    dd_return(false, "โปรดป้อนรหัสผ่านทั้งสองให้ตรงกัน");
                }
            } else {
                dd_return(false, "กรุณากรอกข้อมูลให้ครบ");
            }
            //================================================================
        } else {
            dd_return(false, "ไม่สามารถใช้งานได้");
        }
    } else {
        dd_return(false, "ออกจากระบบก่อน");
    }
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
