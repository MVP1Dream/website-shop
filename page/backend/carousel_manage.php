<div class="container-sm bg-glass   mt-5 shadow-sm p-4 mb-4" data-aos="fade-down">
    <center>
        <h1 class="">&nbsp;<i class="fa-duotone fa-image"></i>&nbsp;จัดการภาพสไลด์</h1>
    </center>
    <hr>
    <div class="d-flex justify-content-center">
        <button class="ms-2 me-2 mt-3 mb-0 btn btn-success col-12 col-lg-5 " id="open_insert"> เพิ่มภาพใหม่</button>
    </div>
    <div class="table-responsive mt-3 ">
        <table id="table" class="table mt-2">
            <thead class="table-dark bg-dark ">
                <tr class="">
                    <th class="sorting sorting_asc">id</th>
                    <th > ลิงค์รูปภาพ</th>
                    <th > แก้ไข</th>
                    <th > ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $get_user = dd_q("SELECT * FROM carousel ORDER BY id DESC");
                    while($row = $get_user->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <tr >
                        <td class=""><?php echo $row['id'];?></td>
                        <td class="" ><img src="<?php echo htmlspecialchars($row['link']);?>" width="100px" srcset=""></td>
                        <td ><button class="btn btn-warning  w-100" style="width : 130px!important" onclick="get_detail(<?php echo $row['id'];?>)"><i class="fa-solid fa-pencil"></i>&nbsp;แก้ไข</button></td>
                        <td><button class="btn btn-danger  w-100"  style="width : 130px!important" onclick="del('<?php echo $row['id'];?>','<?php echo htmlspecialchars($row['username']);?>')"><i class="fa-solid fa-trash" ></i> ลบ</button></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="product_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel"><i class="fa-duotone fa-pencil"></i>&nbsp;&nbsp;แก้ไขรูปภาพสไลด์</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-10 m-cent ">
                    <div class="mb-2">
                        <div class="mb-2">
                            <p class=" mb-1 text-dark">ลิงค์รูปภาพ <span class="text-danger">*</span></p>
                            <input type="text" id="link" class="form-control" value="">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้านี้</button>
                <button type="button" class="btn btn-primary ps-4 pe-4" id="insert_btn" data-id="">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="product_detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel"><i class="fa-duotone fa-pencil"></i>&nbsp;&nbsp;แก้ไขรูปภาพสไลด์</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-10 m-cent ">
                    <div class="mb-2">
                        <div class="mb-2">
                            <p class=" mb-1">ลิ้งค์รูปภาพสไลด์<span class="text-danger">*</span></p>
                            <input type="text" id="upt_link" class="form-control" value="">
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
            $("#open_insert").click(function(){
                const myModal = new bootstrap.Modal('#product_insert', {
                    keyboard: false
                })
                myModal.show();
            });
            $("#save_btn").click(function(){
                var formData = new FormData();
                formData.append('id'  , $("#save_btn").attr("data-id") );
                formData.append('link'  , $("#upt_link").val());
                $.ajax({
                    type: 'POST',
                    url: 'system/backend/carousel_update.php',
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
            $("#insert_btn").click(function(){
                var formData = new FormData();
                formData.append('link'  , $("#link").val());
                $.ajax({
                    type: 'POST',
                    url: 'system/backend/carousel_insert.php',
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
            function get_detail(id){
                var formData = new FormData();
                formData.append('id'  , id);
                
                $.ajax({
                    type: 'POST',
                    url: 'system/backend/call/carousel_detail.php',
                    data:formData,
                    contentType: false,
                    processData: false,   
                }).done(function(res){
                    console.log(res);
                    $("#upt_link").val(res.link);
                    $("#save_btn").attr("data-id" , id);
                    const myModal = new bootstrap.Modal('#product_detail', {
                        keyboard: false
                    })
                    myModal.show();
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
                
            }
            function del(id , username){
                Swal.fire({
                    title: 'ยืนยันที่จะลบ?',
                    text: "คุณแน่ใจหรอที่จะลบ   "+username,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ลบเลย'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formData = new FormData();
                        formData.append('id'  , id);
                        $.ajax({
                            type: 'POST',
                            url: 'system/backend/carousel_del.php',
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
                    }
                })
                
                
            }
        </script>
        
<script type="text/javascript">
    $(document).ready(function () {
        $('#table').DataTable();
    });
        $("#btn_regis").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('name'  , $("#site_name").val() );
            // formData.append('bg'  , $("#site_bg").val() );
            formData.append('phone'  , $("#site_phone").val() );
            formData.append('main_color'  , $("#site_main_color").val() );
            formData.append('logo'  , $("#site_logo").val() );
            formData.append('sec_color'  , $("#site_sec_color").val() );
            formData.append('font_color', $("#site_font_color").val());
            formData.append('widget_discord'  , $("#site_widget_discord").val() );
            formData.append('discord'  , $("#site_contact_discord").val() );
            formData.append('facebook'  , $("#site_contact_facebook").val() );
            formData.append('des'  , $("#site_des").val() );
            $('#btn_regis').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: 'system/backend/website.php',
                data:formData,
                contentType: false,
                processData: false,   
            }).done(function(res){
                result = res;
                console.log(result);
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
                $('#btn_regis').removeAttr('disabled');
            });
        });
</script>