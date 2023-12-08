<div class="container-sm p-4" data-aos="fade-left">
<center>
            <div class="col-12 col-lg-12 bg-glass p-2 mb-2" style="border-radius: 1vh;">
                <div class="d-flex justify-content-between">
                    <div class="text-center text-lg-start">
                    <h3 class=" m-0"><img src="assets/icon/profile.png" class="m-0 mb-2" style="height: 2.5rem;">&nbsp; ข้อมูลส่วนตัว</h3>
                    </div>
                    <button class="btn-ys align-self-end pe-4 ps-4 pt-2 pb-2 d-none d-lg-block" onclick="window.history.back()" style="height: fit-content;"><b><i class="fa-solid fa-turn-down-left"></i> ย้อนกลับ</b></button>
                </div>
            </div>
        </center>
            <div class="container-fluid mt-2 mb-5 p-4">
                <div class="container-sm p-0">
                    <div class="row justify-content-center">
                        <div class="col-lg-3">
                            <div class="container-fluid bg-glass p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <center>
                                    <img src="assets/icon/profile.png" class="img-fluid mb-3" style="height: 100px;">
                                    <h2 class=" ms-1 mb-0">ชื่อผู้ใช้ : <span class="ms-1"><?php echo htmlspecialchars(($user['username'])); ?></span></h2>
                                    <small class="ms-1">ผู้ใช้นี้ถูกสร้างเมื่อวันที่ : <span class="ms-1"><?php echo htmlspecialchars(($user['date'])); ?></span></small>
                                </center>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="container-fluid bg-glass p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <center>
                                    <img src="assets/icon/dollar.png" class="img-fluid mb-3" style="height: 100px;">
                                    <h2 class=" ms-1 mb-0">POINT : <span class="ms-1"><?php echo number_format($user["point"]); ?></span></h2>
                                    <small class="ms-1">ยอดการเติมทั้งหมด : <span class="ms-1"><?php echo number_format($user["total"]); ?></span></small>
                                </center>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="container-fluid bg-glass p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=profile&subpage=cpass" style="text-decoration: none;">
                                    <center>
                                        <img src="assets/icon/user-ed.png" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class=" ms-1 mb-0">เปลี่ยนรหัสผ่าน</h2>
                                        <small class="ms-1">สามารถเปลี่ยนรหัสผ่านได้ที่นี่</small>
                                    </center>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="container-fluid bg-glass p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=history" style="text-decoration: none;">
                                    <center>
                                        <img src="assets/icon/history.png" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class=" ms-1 mb-0">ประวัติทั้งหมด</h2>
                                        <small class="ms-1">ดูได้ที่นี่</small>
                                    </center>
                                </a>
                            </div>
                        </div>


                                                <div class="col-lg-3 mt-3">
                            <div class="container-fluid bg-glass p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=logout" style="text-decoration: none;">
                                    <center>
                                        <img src="assets/icon/enter.png" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class=" ms-1 mb-0">ออกจากระบบ</h2>
                                        <small class="ms-1">Good Bye</small>
                                    </center>
                                </a>
                            </div>
                        </div>
                        <?php
                                    if ($user["rank"] == "1") {
                                    ?>
                                                <div class="col-lg-3 mt-3">
                            <div class="container-fluid bg-glass p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=backend" style="text-decoration: none;">
                                    <center>
                                        <img src="assets/icon/manager.png" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class=" ms-1 mb-0">จัดการหลังร้าน</h2>
                                        <small class="ms-1">สามารถเข้าไปจัดการหลังบ้านได้ที่นี่</small>
                                </a>
                            </div>
                        </div>
                        <?php
                                    }
                                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>