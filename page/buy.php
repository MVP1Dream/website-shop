<?php
if ($_GET['id'] != '') {
    $pdshop = dd_q("SELECT * FROM box_product WHERE id = ? LIMIT 1", [$_GET['id']]);
    if ($pdshop->rowCount() != 0) {
        $row_1 = $pdshop->fetch(PDO::FETCH_ASSOC);
        $count = dd_q("SELECT * FROM box_stock WHERE p_id = ?", [$row_1['id']])->rowCount();
?>
        <div class="container mt-3 mb-3">
            <div class="container-sm">
                <div class="bg-glass shadow p-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb d-flex justify-content-center mt-3">
                            <li class="breadcrumb-item"><a href="?page=shop" style="text-decoration: none; color: #6C757D;"> สินค้าทั้งหมด</a></li>
                            <li class="breadcrumb-item"><a href="?page=shop&category=<?= htmlspecialchars($row_1['c_type']) ?>" style="text-decoration: none; color: #6C757D;"> <?= htmlspecialchars($row_1['c_type']) ?></a></li>
                            <li class="breadcrumb-item" aria-current="page" style="color: var(--font)"><?= htmlspecialchars($row_1['name']) ?></li>

                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-12 col-lg-6 p-3">
                            <div class="d-flex justify-content-center">
                                <img src="<?= htmlspecialchars($row_1['img']) ?>" style="width: 60%;" class="rounded">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-3">
                            <div class="bg-glass shadow p-3 rounded">
                                <h3 style="text-decoration: none; color: #000000;">สินค้า : <b><?= htmlspecialchars($row_1['name']) ?><b></h3>
                                <!-- <h4 class="text-main">ราคา : <?= $row_1['price'] ?> บาท / ชิ้น</h4> -->


                                <div class="row mt-2">
                                    <div class="col">
                                        <hr>
                                    </div>
                                    <div class="col-auto">รายละเอียดสินค้า</div>
                                    <div class="col">
                                        <hr>
                                    </div>
                                    <h5 class="" style="word-wrap: break-word; white-space:pre-wrap;"><?= htmlspecialchars($row_1['des']) ?></h5>

                                    <div class="col">
                                        <hr>
                                    </div>
                                    <div class="col-auto">จำนวนสินค้าที่จะซื้อ</div>
                                    <div class="col">
                                        <hr>
                                    </div>

                                    <div class="d-grid mt-2">
                                        <div class="input-group">
                                            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                class="minus input-group-text rounded-start rounded-0">-</button>

                                            <input class="form-control text-center quantity" id="b_count" min="0"

                                                name="quantity" value="1" type="number">
                                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                class="plus input-group-text rounded-end rounded-0">+</button>
                                        </div>
                                    </div>

                                    <!-- <div class="mb-2">
                                        <input type="number" id="b_count" class="form-control text-center" value="1">
                                    </div> -->

                                    <div class="d-flex justify-content-between pe-3 ps-3 mt-2">
                                        <span class="m-0 align-self-center">สินค้าคงเหลือ <?= $count ?> ชิ้น</span>
                                        <span class="m-0 align-self-center">ราคาสินค้า <?= $row_1['price'] ?> บาท / ชิ้น</span>
                                    </div>
                                </div>
                                <button class="btn w-100 mt-2 text-white" id="shop-btn" onclick="buybox()" data-id="<?= $row_1['id'] ?>" data-name="<?= $row_1['name'] ?>" data-price="<?= $row_1['price'] ?>" style="background-color: var(--main);">สั่งซื้อ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "<script>window.location.href = '?page=shop';</script>";
    }
} else {
    echo "<script>window.location.href = '?page=shop';</script>";
}
?>