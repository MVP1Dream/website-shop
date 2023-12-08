<div class="container-sm  bg-glass mt-5  shadow-sm p-4 mb-4" data-aos="fade-down">
    <center>
        <h1 class="">&nbsp;<i class="fa-duotone fa-users"></i>&nbsp;จัดการผู้ใช้</h1>
    </center>
    <hr>
    <div class="table-responsive ">
        <table id="table" class="text-center mt-4">
            <thead class="table-dark bg-dark">
                <tr class="text-center">
                    <th class="sorting sorting_asc">id</th>
                    <th> ชื่อผู้ใช้</th>
                    <th> เงินคงเหลือ</th>
                    <th> ยอดการเติม</th>
                    <th> แก้ไข</th>
                    <th> ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $get_user = dd_q("SELECT * FROM users ORDER BY id DESC");
                while ($row = $get_user->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td class=" "><?php echo $row['id']; ?></td>
                        <td class=""><?php echo htmlspecialchars($row['username']); ?></td>
                        <td class=""><?php echo number_format($row['point']); ?></td>
                        <td class=""><?php echo htmlspecialchars($row['total']); ?></td>
                        <td class=""><button class="btn btn-warning  w-50" onclick="get_detail(<?php echo $row['id']; ?>)"><i class="fa-solid fa-pencil"></i>&nbsp;แก้ไข</button></td>
                        <td class=""><button class="btn btn-danger  w-50" onclick="del('<?php echo $row['id']; ?>','<?php echo htmlspecialchars($row['username']); ?>')"><i class="fa-solid fa-trash"></i> ลบ</button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- <div class="d-flex justify-content-between">
        <div>
            <a class="btn btn-primary <?php if(!isset($_GET['item']) || $_GET['item'] == 1){echo"disabled";}?>" href="?page=backend&type=<?php echo $_GET['type'];?>&item=<?php if(!isset($_GET['item']) || $_GET['item'] == 1){echo"1";}else{echo $_GET['item'] - 1;}?>" >หน้าที่แล้ว</a>
            <a class="text-primary ms-2" href="?page=backend&type=<?php echo $_GET['type'];?>&item=1" >หน้าแรก</a>
            
        </div>
        <p class="text-primary align-self-center mb-0"><?php echo htmlspecialchars($current_page);?></p>
        <div>
            <a class="text-primary me-2" href="?page=backend&type=<?php echo $_GET['type'];?>&item=<?php echo $total_pages?>" >หน้าสุดท้าย</a>
            <a class="btn btn-primary <?php if(($current_page + 1) > $total_pages){echo"disabled";}?>" href="?page=backend&type=<?php echo $_GET['type'];?>&item=<?php echo $current_page + 1;?>">หน้าต่อไป</a>
        </div>
    </div> -->
</div>
<div class="modal fade" id="product_detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel"><i class="fa-duotone fa-pencil"></i>&nbsp;&nbsp;แก้ไขผู้ใช้</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-10 m-cent ">
                    <div class="mb-2">
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">ชื่อผู้ใช้งาน <span class="text-danger">*</span></p>
                            <input type="text" id="username" class="form-control" disabled="disabled" value="username">
                        </div>
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">รหัสผ่าน <span class="text-danger">*</span></p>
                            <input type="text" id="password" class="form-control" value="" placeholder="ปล่อยว่างหากไม่ต้องการแก้ไข">
                        </div>
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">เงินคงเหลือ <span class="text-danger">*</span></p>
                            <input type="text" id="points" class="form-control" value="0">
                        </div>
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">ยอดการเติม <span class="text-danger">*</span></p>
                            <input type="text" id="total" class="form-control" value="0">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" id="save_btn" data-id="">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#save_btn").click(function() {
        var formData = new FormData();
        formData.append('id', $("#save_btn").attr("data-id"));
        formData.append('password', $("#password").val());
        formData.append('total', $("#total").val());
        formData.append('point', $("#points").val());
        $.ajax({
            type: 'POST',
            url: 'system/backend/user_setting.php',
            data: formData,
            contentType: false,
            processData: false,
        }).done(function(res) {
            result = res;
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
        });
        // $("#save_btn").attr("data-id") <- id user
    });

    function get_detail(id) {
        var formData = new FormData();
        formData.append('id', id);

        $.ajax({
            type: 'POST',
            url: 'system/backend/call/user_detail.php',
            data: formData,
            contentType: false,
            processData: false,
        }).done(function(res) {
            $("#username").val(res.username);
            $("#points").val(res.points);
            $("#total").val(res.total);
            $("#save_btn").attr("data-id", id);
            const myModal = new bootstrap.Modal('#product_detail', {
                keyboard: false
            })
            myModal.show();
        }).fail(function(jqXHR) {
            console.log(jqXHR);
            res = jqXHR.responseJSON;
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            //console.clear();
        });

    }

    function del(id, username) {
        Swal.fire({
            title: 'ยืนยันที่จะลบ?',
            text: "คุณแน่ใจหรอที่จะลบผู้ใช้  " + username,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ลบเลย'
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData();
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    url: 'system/backend/user_del.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                }).done(function(res) {
                    result = res;
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
                });
            }
        })


    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable();
    });

    $("#btn_regis").click(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('name', $("#site_name").val());
        // formData.append('bg', $("#site_bg").val());
        formData.append('phone', $("#site_phone").val());
        formData.append('main_color', $("#site_main_color").val());
        formData.append('logo', $("#site_logo").val());
        formData.append('sec_color', $("#site_sec_color").val());
        formData.append('font_color', $("#site_font_color").val());
        formData.append('widget_discord'  , $("#site_widget_discord").val() );
        formData.append('discord'  , $("#site_contact_discord").val() );
        formData.append('facebook'  , $("#site_contact_facebook").val() );
        formData.append('des', $("#site_des").val());
        $('#btn_regis').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: 'system/backend/website.php',
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