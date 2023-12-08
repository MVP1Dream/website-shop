<?php 
    if(isset($_GET["id"])){
        $find = dd_q("SELECT * FROM wheel_item WHERE id = ? ", [$_GET['id']]);
        $pd =$find->fetch(PDO::FETCH_ASSOC);
        if($find->rowCount() >= 1){
     
?>
<div class="container-sm bg-glass  mt-5 border-2 shadow-sm p-4 mb-4" data-aos="fade-down">
    <center>
        <h1 class="">&nbsp;<i class="fa-duotone fa-shopping-basket"></i>&nbsp;จัดการสต็อก</h1>
    </center>
    <hr>
    <div class="d-flex row justify-content-center">
        <button class="d-none ms-2 me-2 mt-3 mb-0 btn btn-primary col-12 col-lg-3 " id="open_salt"> ตั้งค่าโอกาสเกลือ</button>
        <button class="ms-2 me-2 mt-3 mb-0 btn btn-success col-12 col-lg-3 " id="open_insert"> เพิ่มสต็อกใหม่</button>
    </div>
    <div class="table-responsive mt-3 ">
        <table id="table" class="table mt-2">
            <thead class="table-dark bg-dark ">
                <tr class="">
                    <th class="sorting sorting_asc">id</th>
                    <th > ของรางวัล</th>
                    <th > แก้ไข</th>
                    <th > ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $get_user = dd_q("SELECT * FROM stock_wheel WHERE p_id = ?  ORDER BY id DESC",[$_GET['id']]);
                    while($row = $get_user->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <tr >
                        <td class=""><?php echo $row['id'];?></td>
                        <td class="" > <?php echo htmlspecialchars($row['username']);?></td>
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
                <h5 class="modal-title text-dark" id="exampleModalLabel"><i class="fa-duotone fa-circle-plus"></i>&nbsp;&nbsp;เพิ่มสต็อก</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-10 m-cent ">
                    <div class="mb-2">
                        <div class="mb-2">
                            <p class=" mb-0 text-dark">ใส่รางวัล <span class="text-danger">*</span></p>
                            <small class="mb-1 mt-0 text-dark">การขึ้นบรรทัดใหม่จะนับเป็นรางวัลใหม่ทันที </small>
                            <textarea  id="stock_data" cols="30" rows="10" class="form-control" onkeyup="count_stock()"></textarea>
                            <p class="mb-0 mt-2 text-dark">ตอนนี้นับได้ : <span class="text-danger" id="count_stock">0</span> ชิ้น </p>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้านี้</button>
                <button type="button" class="btn btn-primary ps-4 pe-4" id="insert_btn" data-id="<?php echo $pd["id"]?>">เพิ่มสินค้า</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="product_salt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa-duotone fa-pencil"></i>&nbsp;&nbsp;แก้ไขโอกาสเกลือ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-10 m-cent ">
                    <div class="mb-2">
                        <div class="mb-2">
                            <p class=" mb-1">โอกาสเกลือ (สูงสุด 100 %) <span class="text-danger">*</span></p>
                            <input type="text" id="p_salt" class="form-control" value="<?php echo $pd['percent'];?>">
                        </div>
                        <div class="mb-2">
                            <p class=" mb-1">ของรางวัลหากได้เกลือ <span class="text-danger">*</span></p>
                            <input type="text" id="p_salt_prize" class="form-control" value="<?php echo $pd['salt_prize'];?>" placeholder="เช่น ไม่ได้รับรางวัล">
                        </div>
                    </div> 
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้านี้</button>
                <button type="button" class="btn btn-primary ps-4 pe-4" id="salt_btn" data-id="<?php echo $pd["id"];?>">เพิ่มสินค้า</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="product_detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa-duotone fa-pencil"></i>&nbsp;&nbsp;แก้ไขรางวัล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-10 m-cent ">
                    <div class="mb-2">
                        <div class="mb-2">
                            <p class=" mb-0">แก้ไขรางวัล <span class="text-danger">*</span></p>
                            <input  id="upt_stock_data" type="text" class="form-control" >
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
            function count_stock() {
                var array = $("#stock_data").val().split("\n");
                $("#count_stock").html(array.length);
            }
            $("#open_insert").click(function(){
                const myModal = new bootstrap.Modal('#product_insert', {
                    keyboard: false
                })
                myModal.show();
            });
            $("#open_salt").click(function(){
                const myModal = new bootstrap.Modal('#product_salt', {
                    keyboard: false
                })
                myModal.show();
            });
            $("#salt_btn").click(function(){
                var formData = new FormData();
                formData.append('id'  , $("#salt_btn").attr("data-id") );
                formData.append('salt'  , $("#p_salt").val() );
                formData.append('salt_prize'  , $("#p_salt_prize").val());
                $.ajax({
                    type: 'POST',
                    url: 'system/backend/product_salt_update.php',
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
                            window.location = "?page=<?php echo $_GET['page'];?>&id=<?php echo $_GET['id'];?>";
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
            $("#save_btn").click(function(){
                var formData = new FormData();
                formData.append('id'  , $("#save_btn").attr("data-id") );
                formData.append('data'  , $("#upt_stock_data").val());
                $.ajax({
                    type: 'POST',
                    url: 'system/backend/stock_wheel_update.php',
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
                            window.location = "?page=<?php echo $_GET['page'];?>&id=<?php echo $_GET['id'];?>";
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
                formData.append('id'  , $("#insert_btn").attr("data-id") );
                formData.append('data'  , $("#stock_data").val());
                $.ajax({
                    type: 'POST',
                    url: 'system/backend/stock_wheel_insert.php',
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
                            window.location = "?page=<?php echo $_GET['page'];?>&id=<?php echo $_GET['id'];?>";
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
                    url: 'system/backend/call/stock_wheel_detail.php',
                    data:formData,
                    contentType: false,
                    processData: false,   
                }).done(function(res){
                    console.log(res);
                    $("#upt_stock_data").val(res.username);
                    $("#save_btn").attr('data-id', id);
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
                    text: "คุณแน่ใจหรอที่จะลบผู้ใช้  "+username,
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
                            url: 'system/backend/stock_wheel_del.php',
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
                                    window.location = "?page=<?php echo $_GET['page'];?>&id=<?php echo $_GET['id'];?>";
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
        let salt = <?php if($pd["type"] == "0"){echo "true";}else{echo "false";}?>;
        if(salt){
            $("#open_salt").removeClass("d-none");
        }
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
<?php 
       }
    }
?>