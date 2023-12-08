<div class="container-sm bg-glass  mt-5  shadow-sm p-4 mb-4 rounded" data-aos="fade-down">
    <center>
        <h1 class="">&nbsp;<i class="fa-duotone fa-browser"></i>&nbsp;จัดการเติมเงิน</h1>
    </center>
    <hr>
    <div class="col-lg-6 m-auto">
        <div class="mb-2 ">
            <p class="m-0  ">เบอร์รับเงิน (TrueWallet) <span class="text-danger">*</span></p>
            <input type="text" id="site_wallet" class="form-control" value="<?php echo $config['wallet']; ?>">
        </div>
        <div class="mb-2">
            <p class="m-0  ">เก็บ 2.3% ไม่เกิน 10 บาท<span class="text-danger">*</span></p>
            <select class="form-control"  id="pc">
                <option value="on" <?php if ($config['fee'] == "on") {echo "selected";} ?> style="color: #000">เปิดใช้งาน / on</option>
                <option value="off" <?php if ($config['fee'] == "off") {echo "selected";} ?> style="color: #000">ปิดใช้งาน / off</option>
            </select>
        </div>
        <div class="mb-2">
            <button class="btn  bg-main w-100" id="btn_regis">บันทึกข้อมูล</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#btn_regis").click(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('wallet', $("#site_wallet").val());
        formData.append('fee', $("#pc").val());
        $('#btn_regis').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: 'system/backend/topup_manage.php',
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
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>