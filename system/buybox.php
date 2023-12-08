<?php
require_once 'a_func.php';


function dd_return($status, $prize, $message)
{
    if ($status) {
        if ($prize) {
            $salt = "prize";
        }

        $json = ["salt" => $salt, 'message' => $message];
        http_response_code(200);
        die(json_encode($json));
    } else {
        if ($prize == "error") {
            $salt = "error";
        } else {
            $salt  = "salt";
        }
        $json = ["salt" => $salt, 'message' => $message];
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
        if ($_POST['count'] != "" && intval($_POST['count']) == $_POST['count'] && $_POST['count'] > 0 && $_POST['id'] != "") {
            $count = intval($_POST['count']);
            $q_1 = dd_q('SELECT * FROM users WHERE id = ?', [$_SESSION['id']]);
            if ($count <= 1000) {
                if ($q_1->rowCount() >= 1) {
                    $row_1 = $q_1->fetch(PDO::FETCH_ASSOC);
                    $p = dd_q("SELECT * FROM box_product WHERE id = ? ", [$_POST['id']]);
                    if ($p->rowCount() >= 1) {
                        $pd = $p->fetch(PDO::FETCH_ASSOC);
                        $point = (int) $row_1['point'];
                        $price = (int) $pd['price'];
                        $all_price = $price * $count;
                        if ($point >= $all_price) {
                            $find_stock = dd_q("SELECT * FROM box_stock WHERE p_id = ? ", [$pd['id']]);
                            $json_data = json_encode([
                                "username" => $config['name'],
                                "tts" => false,
                                "embeds" => [
                                    [
                                        "title" => "มีการสั่งซื้อสินค้ามาใหม่",
                                        "type" => "rich",
                                        "timestamp" => date("c", strtotime("now")),
                                        "color" => hexdec("3366ff"),
                                        "thumbnail" => [
                                            "url" => $config['logo']
                                        ],
                                        "fields" => [
                                            [
                                                "name" => "ชื่อผู้ใช้",
                                                "value" => $row_1['username'],
                                                "inline" => false
                                            ],
                                            [
                                                "name" => "ชื่อสินค้า",
                                                "value" => $pd['name'],
                                                "inline" => false
                                            ],
                                            [
                                                "name" => "จำนวน",
                                                "value" => $count . " ชิ้น",
                                                "inline" => false
                                            ],
                                            [
                                                "name" => "ราคา",
                                                "value" => $all_price . " บาท",
                                                "inline" => false
                                            ]
                                            // [
                                            //     "name" => "ข้อมูลสินค้า",
                                            //     "value" => $stock["username"],
                                            //     "inline" => false
                                            // ]
                                        ]
                                    ]
                                ]

                            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


                            $ch = curl_init($config['webhook_dc']);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            curl_setopt($ch, CURLOPT_HEADER, 0);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                            $response = curl_exec($ch);
                            curl_close($ch);
                            if ($pd['type'] == "1" and $find_stock->rowCount() >= $count) {
                                for ($i = 1; $i <= $count; $i++) {
                                    $find_stock = dd_q("SELECT * FROM box_stock WHERE p_id = ? LIMIT 1", [$pd['id']]);
                                    if ($find_stock->rowCount() == 1) {
                                        $stock = $find_stock->fetch(PDO::FETCH_ASSOC);
                                        $del = dd_q("DELETE FROM box_stock WHERE id = ? ", [$stock['id']]);
                                        $upt = dd_q("UPDATE users SET point = point - ?  WHERE id = ? ", [$price, $_SESSION['id']]);
                                        $insert = dd_q("INSERT INTO boxlog (date , username , category , price , prize_name , uid)
                                        VALUES ( NOW() , ? , ? , ? , ? , ?  ) 
                                        ", [
                                            $row_1["username"],
                                            $pd["name"],
                                            $pd["price"],
                                            $stock["username"],
                                            $_SESSION['id']
                                        ]);
                                    } else {
                                        dd_return(false, "ได้รับสินค้าแค่บางส่วน");
                                        break;
                                    }
                                }
                                if ($insert  and $del) {
                                    dd_return(true, true, "ซื้อสินค้าสำเร็จ !");
                                } else {
                                    dd_return(false, "error", "[ERROR API BUY] โปรดติดต่อเจ้าของเว็บ!");
                                }
                            } elseif ($pd['type'] == "0" && $find_stock->rowCount() > 0) {
                                if ($find_stock->rowCount() > 0) {
                                    for ($i = 1; $i <= $count; $i++) {
                                        $luck =  rand(1, 1000);
                                        $percent = $pd['percent'] * 10;
                                        $find_stock = dd_q("SELECT * FROM box_stock WHERE p_id = ? ", [$pd['id']]);
                                        $upt = dd_q("UPDATE users SET point = point - ?  WHERE id = ? ", [$price, $_SESSION['id']]);

                                        if ($luck > $percent and $find_stock->rowCount() > 0) {
                                            $find_stock = dd_q("SELECT * FROM box_stock WHERE p_id = ?  LIMIT 1", [$pd['id']]);
                                            $stock = $find_stock->fetch(PDO::FETCH_ASSOC);
                                            $insert = dd_q("INSERT INTO boxlog (date , username , category , price , prize_name , uid)
                                                VALUES ( NOW() , ? , ? , ? , ? , ?  ) 
                                            ", [
                                                $row_1["username"],
                                                $pd["name"],
                                                $pd["price"],
                                                $stock["username"],
                                                $_SESSION['id']
                                            ]);
                                            $del = dd_q("DELETE FROM box_stock WHERE id = ? ", [$stock['id']]);
                                        } else {
                                            $insert = dd_q("INSERT INTO boxlog (date , username , category , price , prize_name , uid)
                                                VALUES ( NOW() , ? , ? , ? , ? , ?  ) 
                                            ", [
                                                $row_1["username"],
                                                $pd["name"],
                                                $pd["price"],
                                                $pd["salt_prize"],
                                                $_SESSION['id']
                                            ]);
                                        }
                                    }
                                    if ($insert) {
                                        dd_return(true, true, "ซื้อสินค้าสำเร็จ !");
                                    } else {
                                        dd_return(false, "error", "[ERROR API BUY] โปรดติดต่อเจ้าของเว็บ!");
                                    }
                                } else {
                                    for ($i = 1; $i >= $count; $i++) {
                                        $upt = dd_q("UPDATE users SET point = point - ?  WHERE id = ? ", [$price, $_SESSION['id']]);
                                        $insert = dd_q("INSERT INTO boxlog (date , username , category , price , prize_name , uid)
                                            VALUES ( NOW() , ? , ? , ? , ? , ?  ) 
                                        ", [
                                            $row_1["username"],
                                            $pd["name"],
                                            $pd["price"],
                                            $pd["salt_prize"],
                                            $_SESSION['id']
                                        ]);
                                    }
                                    if ($insert) {
                                        dd_return(true, true, "ซื้อสินค้าสำเร็จ !");
                                    } else {
                                        dd_return(false, "error", "[ERROR API BUY] โปรดติดต่อเจ้าของเว็บ!");
                                    }
                                }
                            } {
                                dd_return(false,  "error", "สินค้าในสต็อกไม่เพียงพอต่อการสั่งซื้อ");
                            }
                        } else {
                            dd_return(false,  "error", "เงินไม่เพียงพอ");
                        }
                    } else {
                        dd_return(false,  "error", "ไม่พบสินค้า");
                    }
                } else {
                    dd_return(false, "error",  "ไม่พบชื่อผู้ใช้งาน");
                }
            } else {
                dd_return(false, "error",  "สามารถซื้อสูงสุดได้ 1000 ครั้งต่อรอบเท่านั้น");
            }
        } else {
            dd_return(false, "error",  "สามารถซื้อสูงสุดได้ 1000 ครั้งเท่านั้น");
        }
    } else {
        dd_return(false, "error",  "เข้าสู่ระบบก่อนทำรายการ");
    }
} else {
    dd_return(false, "error",  "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
}
