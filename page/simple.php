<style>
    .shops {
        padding: 20px;
        border-radius: 1vh;
    }

    .shops-body {
        position: relative;
        color: #fff;
        font-weight: 600;
        height: 100%;
    }

    .shops-body>.shops-img {
        width: 100%;
        height: 100%;
        border-radius: 1vh;
        transition: all .5s ease;
    }

    .shops-body>.shops-img:hover {
        transform: scale(1.035);
    }

    .shops-body>.shops-text-center {
        position: absolute;
        top: 80%;
        left: 20%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: all .5s ease;
    }

    .shops-body:hover>.shops-text-center {
        left: 50%;
        opacity: 1;
        font-size: 30px;
        padding: 0 20px;
        border-radius: 2vh;
        background-color: var(--main);
    }
</style>

<div class="container-fluid  mt-4 p-0 " data-aos="fade-left">
        <div class="container p-4 pt-0 pb-0 m-cent">
            <div id="carouselExampleControls" class="carousel slide border-spe" data-bs-ride="carousel" style="border-radius: 1vh;">
                <div class="carousel-inner" style="border-radius: 1vh;">
                    <?php
                    $active = false;
                    $find = dd_q("SELECT * FROM carousel");
                    while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="carousel-item <?php if (!$active) {
                                                        echo "active";
                                                        $active = true;
                                                    } ?>">
                            <img src="<?php echo $row['link'] ?>" class="d-block w-100" alt="..." style="border-radius: 1vh;">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
<div class="container mt-4 p-0 " data-aos="fade-left">
    <div class="container-sm ps-4 pe-4">
        <div class="w-100 bg-glass shadow-sw  ps-3 pe-4 align-contant-center" style="border-radius: 1vh;">
            <div class="row">
                <div class="col-12 ps-5 pe-5 ps-lg-0 pe-lg-0 col-lg-2 p-2 ">
                    <div class="p-2" style="background-color: var(--main); border-radius: 1vh; font-weight: 600; font-size: 20px;">
                        <p class="text-center m-0"><img src="https://cdn-icons-png.flaticon.com/512/8306/8306906.png" width="25"> &nbsp;ประกาศ</p>
                    </div>
                </div>
                <div class="col p-2 mt-lg-2">
                    <marquee><?= $config['ann'] ?></marquee>
                </div>
            </div>
        </div>
    </div>

    <!-- หมวดหมู่แนะนำ -->
    <div class="container-sm p-4" data-aos="fade-left">
        <!-- <div class="row justiy-content-center  justify-content-lg-between">
            <div class="col-lg-12"> -->
            <center>
            <div class="col-12 col-lg-12 bg-glass p-2 mb-2" style="border-radius: 1vh;">
                <div class="d-flex justify-content-between">
                    <div class="text-center text-lg-start">
                        <h3 class=" m-0"><img src="assets/icon/application.png" class="m-0 mb-2" style="height: 2.5rem;">&nbsp; หมวดหมู่แนะนำ</h3>
                    </div>
                    <a class="btn-ys pe-4 ps-4 pt-2 pb-2 d-none d-lg-block" href="?page=shop" style="height: fit-content;"><b>เพื่มเติม</b></a>
                </div>
            </div>
        </center>
            
            <style>
                .cc {
                    width: 100%;
                    max-width: 250px;
                }

                @media only screen and (max-width: 1000px) {
                    .cc {
                        width: 100%;
                        max-width: 100vh;
                    }
                }
            </style>
            <div class="row justify-content-center justify-content-lg-start">
                <?php
                // $check = dd_q("SELECT * FROM crecom WHERE recom_1 != 0 AND recom_2 != 0 AND recom_3 != 0 AND recom_4 != 0"); #44444
                $check = dd_q("SELECT * FROM crecom WHERE recom_1 != 0 AND recom_2 != 0");
                if ($check->rowCount() == 1) {
                    $data = $check->fetch(PDO::FETCH_ASSOC);
                    for ($i = 1; $i <= 2; $i++) {
                        $recom = "recom_" . $i;
                        $find = dd_q("SELECT * FROM category WHERE c_id = ? ", [$data[$recom]]);
                        $row = $find->fetch(PDO::FETCH_ASSOC);
                ?>

                        <div class="col-12 col-lg-6 mb-3">
                            <a href="?page=shop&category=<?= $row['c_name'] ?>">
                                <div class="shops-body w-100">
                                    <img class="shops-img" src="<?= htmlspecialchars($row['img']) ?>">
                                    <!-- <div class="shops-text-center">
                                        <?= htmlspecialchars($row['des']) ?>
                                    </div> -->
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <?php
                    $find = dd_q("SELECT * FROM category ORDER BY RAND() LIMIT 4");
                    while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="col-12 col-lg-6 mb-3">
                            <a href="?page=shop&category=<?= $row['c_name'] ?>">
                                <div class="shops-body w-100">
                                    <img class="shops-img" src="<?= htmlspecialchars($row['img']) ?>">
                                    <!-- <div class="shops-text-center">
                                        <?= htmlspecialchars($row['des']) ?>
                                    </div> -->
                                </div>
                            </a>
                        </div>
                <?php }
                } ?>
            </div>
            <a href="?page=shop" class="btn mb-2 bg-main-gra align-self-center ps-4 pe-4 pt-2 pb-2 d-block d-lg-none" style="text-decoration: none;">
                <h4 class=" m-0">เลือกซื้อเพิ่มเติม</h4>
            </a>
        </div>
    </div>

    <div class="container-sm p-4" data-aos="fade-left">
        <center>
            <div class="col-12 col-lg-12 bg-glass p-2 mb-2" style="border-radius: 1vh;">
                <div class="d-flex justify-content-between">
                    <div class="text-center text-lg-start">
                    <h3 class=" m-0"><img src="assets/icon/store.png" class="m-0 mb-2" style="height: 2.5rem;">&nbsp; สินค้าแนะนำ</h3>
                    </div>
                    <a class="btn-ys pe-4 ps-4 pt-2 pb-2 d-none d-lg-block" href="?page=shop" style="height: fit-content;"><b>เพื่มเติม</b></a>
                </div>
            </div>
        </center>
    
        

            <style>
                .cc {
                    width: 100%;
                    max-width: 250px;
                }

                @media only screen and (max-width: 1000px) {
                    .cc {
                        width: 100%;
                        max-width: 100vh;
                    }
                }
            </style>
            <div class="row justify-content-center justify-content-lg-start">
                <?php
                $check = dd_q("SELECT * FROM recom WHERE recom_1 != 0 AND recom_2 != 0 AND recom_3 != 0 AND recom_4 != 0 AND recom_5 != 0 AND recom_6 != 0 AND recom_7 != 0 AND recom_8 != 0 AND recom_9 != 0 AND recom_10 != 0");
                if ($check->rowCount() == 1) {
                    $data = $check->fetch(PDO::FETCH_ASSOC);
                    for ($i = 1; $i <= 10; $i++) {
                        $recom = "recom_" . $i;
                        $find = dd_q("SELECT * FROM box_product WHERE id = ? ", [$data[$recom]]);
                        $row = $find->fetch(PDO::FETCH_ASSOC);
                        $stock = dd_q("SELECT * FROM box_stock WHERE p_id = ? ", [$row["id"]]);
                        $count = $stock->rowCount();
                        if ($count  == NULL) {
                            $count = 0;
                        }
                ?>
                        <div class="col-12 col-lg-3 mb-4 cc" data-aos="zoom-in">
                        <div class="card-anim-main bg-glass border-ys shadow p-1" style="border-radius: 1vh; height: fit-content;">
                                <div class="container-fluid p-0 ">
                                    <a href="?page=buy&id=<?= $row['id'] ?>">
                                        <div class="view overlay">
                                            <center>
                                                <img class="img-fluid " src="<?php echo htmlspecialchars($row["img"]); ?>" style="border-radius: 1vh; width: 100%; max-width: 100vh;">
                                            </center>
                                            <a href="#!">
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>
                                        <div class="card-body p-3 pt-3 pb-1">
                                            <h5 class="  text-strongest mb-1" style="word-wrap: break-word;"><?php echo htmlspecialchars($row["name"]); ?></h5>
                                            <div class="d-flex justify-content-between">
                                                <p class="text-main  align-self-center m-0 "><strong>ราคา : <?php echo number_format($row['price']); ?> บาท</strong></p>
                                            </div>
                                            <center>
                                                <a href="?page=buy&id=<?= $row['id'] ?>" class="btn bg-main w-100  mb-2" style="border-radius: 50px;"><i class="fa-regular fa-shopping-basket"></i>&nbsp;สั่งซื้อตอนนี้เลย</a>
                                                <p class=" m-0" style="width: fit-content;">สินค้าคงเหลือ <?php echo $count; ?> ชิ้น</p>
                                            </center>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <?php
                    $find = dd_q("SELECT * FROM box_product ORDER BY id DESC LIMIT 10");
                    while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                        $stock = dd_q("SELECT * FROM box_stock WHERE p_id = ? ", [$row["id"]]);
                        $count = $stock->rowCount();
                        if ($count  == NULL) {
                            $count = 0;
                        }
                    ?>
                        <div class="col-12 col-lg-3 mb-4 cc" data-aos="zoom-in">
                        <div class="card-anim-main bg-glass border-ys shadow p-1" style="border-radius: 1vh; height: fit-content;">
                                <div class="p-1">
                                    <a href="?page=buy&id=<?= $row['id'] ?>">
                                        <div class="view overlay">
                                            <center>
                                                <img class="img-fluid " src="<?php echo htmlspecialchars($row["img"]); ?>" style="border-radius: 1vh; width: 100%; max-width: 100vh;">
                                            </center>
                                            <a href="#!">
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>

                                        <div class="card-body p-3 pt-3 pb-1">
                                            <h5 class="  text-strongest mb-1" style="word-wrap: break-word;"><?php echo htmlspecialchars($row["name"]); ?></h5>
                                            <div class="d-flex justify-content-between">
                                                <p class="text-main  align-self-center m-0 "><strong>ราคา : <?php echo number_format($row['price']); ?> บาท</strong></p>
                                            </div>
                                            <center>
                                                <a href="?page=buy&id=<?= $row['id'] ?>" class="btn bg-main w-100  mb-2" style="border-radius: 50px;"><i class="fa-regular fa-shopping-basket"></i>&nbsp;ซื้อตอนนี้เลย</a>
                                                <p class=" m-0" style="width: fit-content;">สินค้าคงเหลือ <?php echo $count; ?> ชิ้น</p>
                                            </center>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php
                }
                ?>
            </div>
            <a href="?page=shop" class="btn mb-2 bg-main-gra align-self-center ps-4 pe-4 pt-2 pb-2 d-block d-lg-none" style="text-decoration: none;">
                <h4 class=" m-0">เลือกซื้อเพิ่มเติม</h4>
            </a>
        </div>
    </div>
    <!-- </div>
</div> -->
    <div class="container m-cent p-4 pt-2 pb-2 " style="border-radius: 1vh;" data-aos="fade-left">

        <?php
        $boxlog = dd_q("SELECT * FROM users");
        $m_count = $boxlog->rowCount() + $static['m_count'];

        $boxlog = dd_q("SELECT * FROM category");
        $c_count = $boxlog->rowCount() + $static['c_count'];

        $boxlog = dd_q("SELECT * FROM box_stock");
        $s_count = $boxlog->rowCount() + $static['s_count'];

        $boxlog = dd_q("SELECT * FROM boxlog");
        $b_count = $boxlog->rowCount() + $static['b_count'];
        
        ?>

        <div class="mb-4 w-100">
            <div class="row">
                <div class="col-12 col-lg-3 pe-3 mb-2">
                <div class="mb-2 bg-glass border-ys container-sm count-only mb-lg-0 p-3 pe-0 ps-0 shadow" style="border-radius:1vh">
                        <center>
                            <img src="assets/icon/user.png" alt="" style="height: 68px;"><br>
                            <span class="text-main" id="count" style="font-size: 36px;" data-target="<?php echo $m_count; ?>"></span>
                            <span style="font-size: 36px;" class="text-font">&nbsp;คน</span>
                            <h5 class="">สมาชิกทั้งหมด</h5>
                        </center>
                    </div>
                </div>
                <div class="col-12 col-lg-3 pe-3 mb-2">
                <div class="mb-2 bg-glass border-ys container-sm count-only mb-lg-0 p-3 pe-0 ps-0 shadow" style="border-radius:1vh">
                        <center>
                            <img src="assets/icon/application.png" alt="" style="height: 68px;"><br>
                            <span class="text-main" id="count" style="font-size: 36px;" data-target="<?php echo $c_count; ?>"></span>
                            <span style="font-size: 36px;" class="text-font">&nbsp;หมวดหมู่</span>
                            <h5 class="">หมวดหมู่ทั้งหมด</h5>
                        </center>
                    </div>
                </div>
                <div class="col-12 col-lg-3 pe-3 mb-2">
                <div class="mb-2 bg-glass border-ys container-sm count-only mb-lg-0 p-3 pe-0 ps-0 shadow" style="border-radius:1vh">
                        <center>
                            <img src="assets/icon/in-stock.png" alt="" style="height: 68px;"> <br>
                            <span class="text-main" id="count" style="font-size: 36px;" data-target="<?php echo $s_count; ?>"></span>
                            <span style="font-size: 36px;" class="text-font">&nbsp;ชิ้น</span>
                            <h5 class="">พร้อมจำหน่าย</h5>
                        </center>
                    </div>
                </div>
                <div class="col-12 col-lg-3 pe-3 mb-2">
                <div class="mb-2 bg-glass border-ys container-sm count-only mb-lg-0 p-3 pe-0 ps-0 shadow" style="border-radius:1vh">
                        <center>
                            <img src="assets/icon/out-of-stock.png" alt="" style="height: 68px;"><br>
                            <span class="text-main" id="count" style="font-size: 36px;" data-target="<?php echo $b_count; ?>"></span>
                            <span style="font-size: 36px;" class="text-font">&nbsp;ครั้ง</span>
                            <h5 class="">จำหน่ายไปแล้ว</h5>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="system/js/countup.js"></script>
</div>
</div>
</div>
</div>