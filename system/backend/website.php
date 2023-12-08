<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once '../a_func.php';

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

    //////////////////////////////////////////////////////////////////////////

    header('Content-Type: application/json; charset=utf-8;');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id'])) {

        if ($_POST['name'] != "" AND $_POST['logo'] != ""  AND $_POST['bg2'] != ""  AND $_POST['bg3'] != "" AND $_POST['discord'] != "" AND $_POST['widget_discord'] != "" AND $_POST['facebook'] != "" AND $_POST['main_color'] != "" AND $_POST['sec_color'] != "" AND $_POST['font_color'] != "" AND $_POST['des'] != "") {
            $q_1 = dd_q('SELECT * FROM users WHERE id = ? AND rank = 1 ', [$_SESSION['id']]);
            if ($q_1->rowCount() >= 1) {
                $des = preg_replace('~\R~u', "\n", $_POST['des']);
                $insert = dd_q("UPDATE setting SET 
                    name = ? , main_color  = ? , 
                    sec_color = ? , font_color = ? , widget_discord = ? , discord = ? , facebook = ? , des = ? , logo = ?, ann = ? , webhook_dc = ? , bg2 = ? , bg3 = ?
                ", [
                    $_POST['name'],
                    $_POST['main_color'],
                    $_POST['sec_color'],
                    $_POST['font_color'],
                    $_POST['widget_discord'],
                    $_POST['discord'],
                    $_POST['facebook'],
                    $des,
                    $_POST['logo'],
                    $_POST['ann'],
                    $_POST['webhook_dc'],
                    $_POST['bg2'],
                    $_POST['bg3']
                ]);
                if($insert){
                    dd_return(true, "บันทึกสำเร็จ");
                }else{
                    dd_return(false, "SQL ผิดพลาด");
                }
            }else{
                dd_return(false, "เซสชั่นผิดพลาด โปรดล็อกอินใหม่");
                session_destroy();
            }
        }else{
            dd_return(false, "กรุณากรอกข้อมูลให้ครบ");
        }
        }else{
        dd_return(false, "เข้าสู่ระบบก่อน");
        }
    }else{
        dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
    }
?>
