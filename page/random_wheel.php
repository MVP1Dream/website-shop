<div class="container-fluid p-4">
    <div class="container-sm m-auto p-4 pt-0">
    <div class="container-fluid shadow-sm" data-aos="zoom-in">
            <div class="d-flex mb-2">
                <img src="assets/icon/wheel.png" class="align-self-center" style="max-height: 78px;">
                <div class="align-self-center">
                    <h2 class=" ms-1 mb-0">สุ่มวงล้อ</h2>
                    <h5 class="ms-1">สุ่มวงล้อนำโชคมากมายได้จากเรา </h5>
                </div>
            </div>
            <div class="row justify-content-center justify-content-lg-start">

            <?php 
                $find = dd_q("SELECT * FROM wheel ");
                while($row =  $find->fetch(PDO::FETCH_ASSOC)){
            ?>
                <div class="col-lg-6 mb-4 ">
                    <a href="?page=play&wheel=<?= $row['id']; ?>" style="text-decoration: none;">
                        <div class="big-hov rounded  border-4 border-ys">
                            <img src="<?= htmlspecialchars($row['img']) ?>" class="img-fluid ">
                            <!-- <h4 class=" mb-0 p-2 pt-1  bg-main  text-white"><?= htmlspecialchars($row['des']) ?></h4> -->
                        </div>
                    </a>
                </div>
            <?php
                }
            ?>
            
            </div>
        </div>
    </div>
</div>