<div class="container-sm  bg-glass    mt-5  shadow-sm p-4 mb-4 rounded" data-aos="fade-down">
    <center>
        <h1 class="">&nbsp;<i class="fa-duotone fa-fire"></i>&nbsp;ตั้งค่าสินค้าแนะนำ</h1>
    </center>
    <hr>
    <div class="col-lg-6 m-auto">
        <div class="mb-2 mt-4">
            <p class="m-0 ">สินค้าแนะนำ #1 <span class="text-danger">*</span></p>
            <select class="form-select" id="pop_1" aria-label="Default select example">
                <?php
                $find = dd_q("SELECT * FROM recom ");
                $data =  $find->fetch(PDO::FETCH_ASSOC);
                if ($data['recom_1'] != "0") {
                    $get_pd = dd_q("SELECT * FROM box_product WHERE id = ? ", [$data['recom_1']]);
                    $data_pd = $get_pd->fetch(PDO::FETCH_ASSOC);
                ?>
                    <option value="<?php echo $data['recom_1'] ?>" style="color: #000"><?php echo $data_pd['name']; ?></option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['id'] == $data['recom_1']) {
                            continue;
                        }
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="0">โปรดทำการเลือกสินค้าแนะนำ</option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-2 mt-4">
            <p class="m-0 ">สินค้าแนะนำ #2 <span class="text-danger">*</span></p>
            <select class="form-select" id="pop_2" aria-label="Default select example">
                <?php
                $find = dd_q("SELECT * FROM recom ");
                $data =  $find->fetch(PDO::FETCH_ASSOC);
                if ($data['recom_2'] != "0") {
                    $get_pd = dd_q("SELECT * FROM box_product WHERE id = ? ", [$data['recom_2']]);
                    $data_pd = $get_pd->fetch(PDO::FETCH_ASSOC);
                ?>
                    <option value="<?php echo $data['recom_2'] ?>" style="color: #000"><?php echo $data_pd['name']; ?></option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['id'] == $data['recom_2']) {
                            continue;
                        }
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="0">โปรดทำการเลือกสินค้าแนะนำ</option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-2 mt-4">
            <p class="m-0 ">สินค้าแนะนำ #3 <span class="text-danger">*</span></p>
            <select class="form-select" id="pop_3" aria-label="Default select example">
                <?php
                $find = dd_q("SELECT * FROM recom ");
                $data =  $find->fetch(PDO::FETCH_ASSOC);
                if ($data['recom_3'] != "0") {
                    $get_pd = dd_q("SELECT * FROM box_product WHERE id = ? ", [$data['recom_3']]);
                    $data_pd = $get_pd->fetch(PDO::FETCH_ASSOC);
                ?>
                    <option value="<?php echo $data['recom_3'] ?>" style="color: #000"><?php echo $data_pd['name']; ?></option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['id'] == $data['recom_3']) {
                            continue;
                        }
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="0">โปรดทำการเลือกสินค้าแนะนำ</option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-2 mt-4">
            <p class="m-0 ">สินค้าแนะนำ #4 <span class="text-danger">*</span></p>
            <select class="form-select" id="pop_4" aria-label="Default select example">
                <?php
                $find = dd_q("SELECT * FROM recom ");
                $data =  $find->fetch(PDO::FETCH_ASSOC);
                if ($data['recom_4'] != "0") {
                    $get_pd = dd_q("SELECT * FROM box_product WHERE id = ? ", [$data['recom_4']]);
                    $data_pd = $get_pd->fetch(PDO::FETCH_ASSOC);
                ?>
                    <option value="<?php echo $data['recom_4'] ?>" style="color: #000"><?php echo $data_pd['name']; ?></option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['id'] == $data['recom_4']) {
                            continue;
                        }
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="0">โปรดทำการเลือกสินค้าแนะนำ</option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-2 mt-4">
            <p class="m-0 ">สินค้าแนะนำ #5 <span class="text-danger">*</span></p>
            <select class="form-select" id="pop_5" aria-label="Default select example">
                <?php
                $find = dd_q("SELECT * FROM recom ");
                $data =  $find->fetch(PDO::FETCH_ASSOC);
                if ($data['recom_5'] != "0") {
                    $get_pd = dd_q("SELECT * FROM box_product WHERE id = ? ", [$data['recom_5']]);
                    $data_pd = $get_pd->fetch(PDO::FETCH_ASSOC);
                ?>
                    <option value="<?php echo $data['recom_5'] ?>" style="color: #000"><?php echo $data_pd['name']; ?></option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['id'] == $data['recom_5']) {
                            continue;
                        }
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="0">โปรดทำการเลือกสินค้าแนะนำ</option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-2 mt-4">
            <p class="m-0 ">สินค้าแนะนำ #6 <span class="text-danger">*</span></p>
            <select class="form-select" id="pop_6" aria-label="Default select example">
                <?php
                $find = dd_q("SELECT * FROM recom ");
                $data =  $find->fetch(PDO::FETCH_ASSOC);
                if ($data['recom_6'] != "0") {
                    $get_pd = dd_q("SELECT * FROM box_product WHERE id = ? ", [$data['recom_6']]);
                    $data_pd = $get_pd->fetch(PDO::FETCH_ASSOC);
                ?>
                    <option value="<?php echo $data['recom_6'] ?>" style="color: #000"><?php echo $data_pd['name']; ?></option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['id'] == $data['recom_6']) {
                            continue;
                        }
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="0">โปรดทำการเลือกสินค้าแนะนำ</option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-2 mt-4">
            <p class="m-0 ">สินค้าแนะนำ #7 <span class="text-danger">*</span></p>
            <select class="form-select" id="pop_7" aria-label="Default select example">
                <?php
                $find = dd_q("SELECT * FROM recom ");
                $data =  $find->fetch(PDO::FETCH_ASSOC);
                if ($data['recom_7'] != "0") {
                    $get_pd = dd_q("SELECT * FROM box_product WHERE id = ? ", [$data['recom_7']]);
                    $data_pd = $get_pd->fetch(PDO::FETCH_ASSOC);
                ?>
                    <option value="<?php echo $data['recom_7'] ?>" style="color: #000"><?php echo $data_pd['name']; ?></option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['id'] == $data['recom_7']) {
                            continue;
                        }
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="0">โปรดทำการเลือกสินค้าแนะนำ</option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-2 mt-4">
            <p class="m-0 ">สินค้าแนะนำ #8 <span class="text-danger">*</span></p>
            <select class="form-select" id="pop_8" aria-label="Default select example">
                <?php
                $find = dd_q("SELECT * FROM recom ");
                $data =  $find->fetch(PDO::FETCH_ASSOC);
                if ($data['recom_8'] != "0") {
                    $get_pd = dd_q("SELECT * FROM box_product WHERE id = ? ", [$data['recom_8']]);
                    $data_pd = $get_pd->fetch(PDO::FETCH_ASSOC);
                ?>
                    <option value="<?php echo $data['recom_8'] ?>" style="color: #000"><?php echo $data_pd['name']; ?></option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['id'] == $data['recom_8']) {
                            continue;
                        }
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="0">โปรดทำการเลือกสินค้าแนะนำ</option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-2 mt-4">
            <p class="m-0 ">สินค้าแนะนำ #9 <span class="text-danger">*</span></p>
            <select class="form-select" id="pop_9" aria-label="Default select example">
                <?php
                $find = dd_q("SELECT * FROM recom ");
                $data =  $find->fetch(PDO::FETCH_ASSOC);
                if ($data['recom_9'] != "0") {
                    $get_pd = dd_q("SELECT * FROM box_product WHERE id = ? ", [$data['recom_9']]);
                    $data_pd = $get_pd->fetch(PDO::FETCH_ASSOC);
                ?>
                    <option value="<?php echo $data['recom_9'] ?>" style="color: #000"><?php echo $data_pd['name']; ?></option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['id'] == $data['recom_9']) {
                            continue;
                        }
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="0">โปรดทำการเลือกสินค้าแนะนำ</option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-2 mt-4">
            <p class="m-0 ">สินค้าแนะนำ #10 <span class="text-danger">*</span></p>
            <select class="form-select" id="pop_10" aria-label="Default select example">
                <?php
                $find = dd_q("SELECT * FROM recom ");
                $data =  $find->fetch(PDO::FETCH_ASSOC);
                if ($data['recom_10'] != "0") {
                    $get_pd = dd_q("SELECT * FROM box_product WHERE id = ? ", [$data['recom_10']]);
                    $data_pd = $get_pd->fetch(PDO::FETCH_ASSOC);
                ?>
                    <option value="<?php echo $data['recom_10'] ?>" style="color: #000"><?php echo $data_pd['name']; ?></option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['id'] == $data['recom_10']) {
                            continue;
                        }
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                    <?php
                    }
                } else {
                    ?>
                    <option value="0">โปรดทำการเลือกสินค้าแนะนำ</option>
                    <?php
                    $all_p = dd_q("SELECT id,name FROM box_product ORDER BY id DESC");
                    while ($row = $all_p->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <option value="<?php echo $row['id']; ?>" style="color: #000"><?php echo $row['name']; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-2">
            <button class="btn btn-success w-100" id="btn_regis">บันทึกข้อมูล</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#btn_regis").click(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('pop_1', $("#pop_1").val());
        formData.append('pop_2', $("#pop_2").val());
        formData.append('pop_3', $("#pop_3").val());
        formData.append('pop_4', $("#pop_4").val());
        formData.append('pop_5', $("#pop_5").val());
        formData.append('pop_6', $("#pop_6").val());
        formData.append('pop_7', $("#pop_7").val());
        formData.append('pop_8', $("#pop_8").val());
        formData.append('pop_9', $("#pop_9").val());
        formData.append('pop_10', $("#pop_10").val());
        $('#btn_regis').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: 'system/backend/recom_update.php',
            data: formData,
            contentType: false,
            processData: false,
        }).done(function(res) {
            result = res;
            console.log(result);
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: result.message
            }).then(function() {
                window.location = "?page=<?php echo $_GET['page']; ?>";
            });
        }).fail(function(jqXHR) {
            console.log(jqXHR);
            res = jqXHR.responseJSON;
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            //console.clear();
            $('#btn_regis').removeAttr('disabled');
        });
    });
</script>