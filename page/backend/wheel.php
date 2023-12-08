<?php
if (isset($_GET['id'])) {
?>
    <div class="container-sm bg-glass border border-2 mt-5 shadow-sm p-4 mb-4" data-aos="fade-down">
        <center>
            <h1 class="">&nbsp;<i class="fa-duotone fa-shopping-basket"></i>&nbsp;จัดการรางวัล</h1>
        </center>
        <hr>
        <div class="d-flex justify-content-center">
            <button class="ms-2 me-2 mt-3 mb-0 btn btn-success col-12 col-lg-5 " id="open_insert"> เพิ่มรางวัลใหม่</button>
        </div>
        <div class="table-responsive mt-3 ">
            <table id="table" class="table mt-2">
                <thead class="table-dark bg-dark ">
                    <tr class="">
                        <th class="sorting sorting_asc">id</th>
                        <th> ภาพรางวัล</th>
                        <th> ชื่อรางวัล</th>
                        <th> โอกาสออก</th>
                        <th> จัดการสต็อก</th>
                        <th> แก้ไข</th>
                        <th> ลบ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_user = dd_q("SELECT * FROM wheel_item ORDER BY id DESC");
                    while ($row = $get_user->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td class=""><?php echo $row['id']; ?></td>
                            <td class=""><img src="<?php echo htmlspecialchars($row['img']); ?>" width="100px" alt=""></td>
                            <td class=""><?php echo htmlspecialchars($row['name']); ?></td>
                            <td class=""><?php echo number_format($row['percent']); ?></td>
                            <td><a class="btn btn-warning  w-100 col-4" style="width : 130px!important" href="?page=stock_wheel&id=<?php echo $row["id"]; ?>"><i class="fa-solid fa-box"></i>&nbsp;สต็อก</a></td>
                            <td><button class="btn btn-warning  w-100" style="width : 130px!important" onclick="get_detail(<?php echo $row['id']; ?>)"><i class="fa-solid fa-pencil"></i>&nbsp;แก้ไข</button></td>
                            <td><button class="btn btn-danger  w-100" style="width : 130px!important" onclick="del('<?php echo $row['id']; ?>','<?php echo htmlspecialchars($row['username']); ?>')"><i class="fa-solid fa-trash"></i> ลบ</button></td>
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
                    <h5 class="modal-title text-dark" id="exampleModalLabel"><i class="fa-duotone fa-pencil"></i>&nbsp;&nbsp;แก้ไขรางวัล</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-10 m-cent ">
                        <div class="mb-2">
                            <div class="mb-2">
                                <p class=" mb-1 text-dark">ชื่อรางวัล <span class="text-danger">*</span></p>
                                <input type="text" id="p_name" class="form-control" value="">
                            </div>
                            <div class="mb-2">
                                <p class=" mb-1 text-dark">ลิงค์รูปภาพ <span class="text-danger">*</span></p>
                                <input type="text" id="p_img" class="form-control" value="">
                            </div>
                            <div class="mb-2">
                                <p class=" mb-1 text-dark">โอกาสออก สูงสุด 100% <span class="text-danger">*</span></p>
                                <input type="number" id="p_per" class="form-control" value="" maxlength="3">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิดหน้านี้</button>
                    <button type="button" class="btn btn-primary ps-4 pe-4" id="insert_btn" data-id="<?php echo htmlspecialchars($_GET['id']); ?>">เพิ่มรางวัล</button>
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
                                <p class=" mb-1">ชื่อรางวัล <span class="text-danger">*</span></p>
                                <input type="text" id="name" class="form-control" value="">
                            </div>
                            <div class="mb-2">
                                <p class=" mb-1">ลิงค์รูปภาพ <span class="text-danger">*</span></p>
                                <input type="text" id="img" class="form-control" value="">
                            </div>
                            <div class="mb-2">
                                <p class=" mb-1">โอกาสออก สูงสุด 100% <span class="text-danger">*</span></p>
                                <input type="number" id="per" class="form-control" value="" maxlength="3">
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
        $(document).ready(function() {
            $('#table').DataTable();
        });
        $("#open_insert").click(function() {
            const myModal = new bootstrap.Modal('#product_insert', {
                keyboard: false
            })
            myModal.show();
        });
        $("#save_btn").click(function() {
            var formData = new FormData();
            formData.append('id', $("#save_btn").attr("data-id"));
            formData.append('img', $("#img").val());
            formData.append('name', $("#name").val());
            formData.append('per', $("#per").val());
            $.ajax({
                type: 'POST',
                url: 'system/backend/item_update.php',
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
                    window.location.reload();
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
        $("#insert_btn").click(function() {
            var formData = new FormData();
            formData.append('img', $("#p_img").val());
            formData.append('name', $("#p_name").val());
            formData.append('per', $("#p_per").val());
            formData.append('w_id', '<?= htmlspecialchars($_GET['id']); ?>');
            $.ajax({
                type: 'POST',
                url: 'system/backend/item_insert.php',
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
                    window.location.reload();
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
                url: 'system/backend/call/item_detail.php',
                data: formData,
                contentType: false,
                processData: false,
            }).done(function(res) {
                console.log(res);
                $("#name").val(res.name);
                $("#img").val(res.img);
                $("#per").val(res.percent);
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
                        url: 'system/backend/item_del.php',
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
                            window.location.reload();
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

<?php
}
?>