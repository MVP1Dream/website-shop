<div class="container-fluid p-0 ">
    <div class="container-sm  m-cent  p-0 pt-4 ">
        <div class="container-sm ">
            <div class="container-fluid">
                <div class="container-fluid">
                
                    <?php if (!isset($_GET['category'])) : ?>
                        <!-- <center class="mt-4 mb-4">
                            <span class="h4  "> <img src="assets/icon/shopping-cart.png" class="m-0 mb-2" style="height: 2.5rem;">&nbsp;<b>หมวดหมู่ทั้งหมด</b></span>
                        </center> -->

                        <center>
                                                    <div class="col-12 col-lg-12 bg-glass shadow p-2" style="border-radius: 1vh;">
                                <div class="d-flex justify-content-between">
                                    <div class="text-center text-lg-start">
                                        <h3 class=" m-0"><img src="assets/icon/application.png" class="m-0 mb-2" style="height: 2.5rem;">&nbsp;หมวดหมู่สินค้าทั้งหมด</h3>
                                    </div>
                                    <button class="btn-ys align-self-end pe-4 ps-4 pt-2 pb-2 d-none d-lg-block" onclick="window.history.back()" style="height: fit-content;"><b><i class="fa-solid fa-turn-down-left"></i> ย้อนกลับ</b></button>
                                </div>
                            </div>
                                            </center>

                    <?php else : ?>
                        <!-- <center class="mt-4 mb-4">
                            <span class="h4  "> <img src="assets/icon/shopping-cart.png" class="m-0 mb-2" style="height: 2.5rem;">&nbsp;<b>หมวดหมู่ : <?= htmlspecialchars($_GET['category']); ?></b></span>
                        </center> -->
                        <center>
                                                    <div class="col-12 col-lg-12 bg-glass shadow p-2" style="border-radius: 1vh;">
                                <div class="d-flex justify-content-between">
                                    <div class="text-center text-lg-start">
                                        
                                        <h4 class=" m-0"><img src="assets/icon/application.png" class="m-0 mb-2" style="height: 2.5rem;">&nbsp;หมวดหมู่ : <?= htmlspecialchars($_GET['category']); ?></h4>
                                    </div>
                                    <button class="btn-ys align-self-end pe-4 ps-4 pt-2 pb-2 d-none d-lg-block" onclick="window.history.back()" style="height: fit-content;"><b><i class="fa-solid fa-turn-down-left"></i> ย้อนกลับ</b></button>
                                </div>
                            </div>
                                            </center>
                    <?php endif ?>
                    <div class="row justify-content-center justify-content-lg-start">
                        <?php if (!isset($_GET['category'])) {
                            $cfind = dd_q("SELECT * FROM category ");
                            $check = $cfind->rowCount();
                            if ($check  == NULL) {
                                echo '<h6 class=" text-center">ไม่มีหมวดหมู่ในตอนนี้</h6>';
                            } elseif ($_GET['category'] == NULL) {
                                header('Location: ' . $_SERVER['HTTP_REFERER']);
                            }
                            while ($row = $cfind->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                <style>
                                    .img-anim {
                                        position: relative;
                                        width: 800px;
                                        max-width: 100%;
                                        height: auto;
                                        overflow: hidden;
                                    }

                                    .img-anim img {
                                        width: 100%;
                                        height: auto;
                                        margin-left: auto;
                                    }

                                    .img-anim>img {
                                        max-height: 100%;
                                        height: 100%;
                                        transition: all 0.5s ease;
                                    }

                                    .img-anim div {
                                        position: absolute;
                                        background-color: rgba(1, 1, 1, 0.55);
                                        color: #fff;
                                        width: 100%;
                                        height: 100%;
                                        opacity: 0;
                                        transition: all 0.3s ease;
                                        padding: 125px 0;
                                        text-align: center;
                                        font-size: 30px;
                                        z-index: 2;
                                    }

                                    .img-anim:hover>div {
                                        opacity: 1;
                                    }
                                    
                                </style>
                                <div class="col-lg-6 mb-4 ">
                                    <a href="?page=shop&category=<?= htmlspecialchars($row['c_name']) ?>" style="text-decoration: none;">
                                        <div class="big-hov rounded  border-4 ">
                                            <img src="<?= htmlspecialchars($row['img']) ?>" class="img-fluid ">
                                            <!-- <h4 class=" mb-0 p-2 pt-1  bg-main  text-white"><?= htmlspecialchars($row['des']) ?></h4> -->
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                            <?php
                        } else {
                            $find = dd_q("SELECT * FROM box_product WHERE c_type = ? ORDER BY id DESC", [$_GET['category']]);
                            while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                                $stock = dd_q("SELECT * FROM box_stock WHERE p_id = ? ", [$row["id"]]);
                                $count = $stock->rowCount();
                                if ($count  == NULL) {
                                    $count = 0;
                                }
                            ?>
                                <div class="col-lg-3 mb-4" data-aos="zoom-in">
                                    <div class="card-body border-ys border-2 shadow-sm  p-0 text-white card-body rounded  " style="overflow: hidden; height: fit-content;  ">
                                        <div class="container-fluid  p-0 ">
                                            <a href="?page=buy&id=<?= $row['id'] ?>">
                                                <div class="view overlay">
                                                    <center>
                                                        <img class="img-fluid " src="<?php echo htmlspecialchars($row["img"]); ?>">
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
                                                        <a href="?page=buy&id=<?= $row['id'] ?>" class="btn bg-main w-100 text-white mb-2" style="border-radius: 50px;"><i class="fa-regular fa-shopping-basket"></i>&nbsp;สั่งซื้อตอนนี้เลย</a>
                                                        <p class=" m-0" style="width: fit-content;">สินค้าคงเหลือ <?php echo $count; ?> ชิ้น</p>
                                                    </center>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        <?php             }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>