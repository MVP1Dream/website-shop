
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../a_func.php';

function dd_return($status, $message)
{
    $json = ['message' => $message];
    if ($status) {
        http_response_code(200);
        die(json_encode($json));
    } else {
        http_response_code(400);
        die(json_encode($json));
    }
}

//////////////////////////////////////////////////////////////////////////

header('Content-Type: application/json; charset=utf-8;');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id'])) {

        if (
            $_POST['pop_1'] != "" and $_POST['pop_2'] != "" and $_POST['pop_3'] != "" and $_POST['pop_4'] != ""
        ) {
            $q_1 = dd_q('SELECT * FROM users WHERE id = ? AND rank = 1 ', [$_SESSION['id']]);
            if ($q_1->rowCount() >= 1) {
                $insert = dd_q("UPDATE recom SET recom_1 = ? , recom_2 = ? , recom_3 = ? , recom_4 = ? , recom_5 = ? , recom_6 = ? ,recom_7 = ? , recom_8 = ? , recom_9 = ? , recom_10 = ? WHERE 1", [
                    $_POST['pop_1'],
                    $_POST['pop_2'],
                    $_POST['pop_3'],
                    $_POST['pop_4'],
                    $_POST['pop_5'],
                    $_POST['pop_6'],
                    $_POST['pop_7'],
                    $_POST['pop_8'],
                    $_POST['pop_9'],
                    $_POST['pop_10'],
                ]);
                if ($insert) {
                    dd_return(true, "บันทึกสำเร็จ");
                } else {
                    dd_return(false, "SQL ผิดพลาด");
                }
            } else {
                dd_return(false, "เซสชั่นผิดพลาด โปรดล็อกอินใหม่");
                session_destroy();
            }
        } else {
            dd_return(false, "กรุณากรอกข้อมูลให้ครบ");
        }
    } else {
        dd_return(false, "เข้าสู่ระบบก่อน");
    }
} else {
    dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
}
?>
