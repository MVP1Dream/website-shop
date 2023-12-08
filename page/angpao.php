<div class="container-fluid p-4">
    <div class="container-sm  ps-4 pe-4">
        <div class="container-fluid bg-glass   p-4">
            <div class="col-lg-7 m-auto">
                <h1 class="text-strongest " data-aos="fade-right" data-aos-duration="500"><i class="fa-duotone fa-coins"></i> &nbsp;TOPUP (เติมเงิน)</h1>
                <div data-aos="fade-right" data-aos-duration="600" >
                    <hr class="mt-1 mb-2">
                    <h5 class="m-0"><i class="fa-regular fa-plus-circle"></i>&nbsp;ระบบเติมเงินด้วยซองของขวัญ</h5>
                </div>
                <center>
                    <div class="col-lg-4" data-aos="fade-down" data-aos="700">
                        <img src="assets/img/topup.png"  class="img-fluid">
                    </div>
                </center>
                <div data-aos="fade-left" data-aos-duration="750">
                    <input type="text" id="link" class="form-control text-center mt-1" style="border-radius: 20px;" placeholder="กรอกลิงค์ซองของขวัญที่นี่" >
                </div>

                <?php if ($config['fee'] == "on") { ?>
                    <div data-aos="fade-left" data-aos-duration="750">
                        <p class="m-0 text-center" style="color: red;"><b>ค่าธรรมเนียม 2.3 %</b></p>
                    </div>
                <?php } ?>
                <?php if ($config['fee'] == "off") { ?>
                    <div data-aos="fade-left" data-aos-duration="750">
                        <p class="m-0 text-center" style="color: green;"><b>ไม่มีค่าธรรมเนียม</b></p>
                    </div>
                <?php } ?>

                <button class="bg-main-gra btn mt-2  w-100"  id="topup_btn" style="border-radius: 20px;" data-aos="fade-up" data-aos-duration="800">ยืนยันการเติมเงิน</button>
            </div>
        </div>
        <!-- <div class="container-fluid ps-4 pe-4 bg-glass border border-2">
            <center class="m-0"><h2 class="text-main mb-2 mt-4"><i class="fa-regular fa-history"></i> ประวัติการเติมเงิน</h2></center>
            <hr class="mt-1">
            <div class="table-responsive">
            <table class="table table-striped text-center" id="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">จำนวนเงิน</th>
                    <th scope="col">วันที่</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $i = 1;
                    $f = dd_q("SELECT * FROM topup_his WHERE uid = ? ORDER BY date DESC", [$_SESSION['id']]);
                    while($row = $f->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <th scope="row"><?php echo $row['id'];?></th>
                    <td><?php echo $row['amount'];?></td>
                    <td><?php echo $row['date'];?></td>
                </tr>
                <?php $i++;} ?>
            </table>
            </div>
        </div> -->
    </div>
</div>

<script>
    $("#topup_btn").click(function(){
        var formData = new FormData();
        formData.append('link'  , $("#link").val());
        $.ajax({
            type: 'POST',
            url: 'system/topup.php',
            data:formData,
            contentType: false,
            processData: false,   
        }).done(function(res){
            result = res;
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: result.message
            }).then(function() {
                    window.location = "?page=<?php echo $_GET['page'];?>";
            });
        }).fail(function(jqXHR){
            console.log(jqXHR);
            res = jqXHR.responseJSON;
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            //console.clear();
        });
        // $("#save_btn").attr("data-id") <- id user
    });
</script>