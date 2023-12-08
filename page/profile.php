<div class="container-fluid ">
    <div class="container-sm m-auto ">
        <div class="container-fluid shadow-sm" data-aos="zoom-in">
            <div class="d-flex ">
                <img src="assets/icon/user-ed.png" class="align-self-center" style="max-height: 78px;">
                <div class="align-self-center">
                    <h2 class=" ms-1 mb-0">เปลี่ยนรหัสผ่าน</h2>
                    <h5 class=" ms-1">เปลี่ยนรหัสผ่านได้ที่นี่</h5>
                </div>
            </div>
            
                    <?php 
                    if(isset($_GET['subpage']) && $_GET['subpage'] == "cpass"){
                        require_once('page/cpass.php'); 
                    }elseif(isset($_GET['subpage']) && $_GET['subpage'] == "topuphis"){
                        require_once('page/topuphis.php');
                    }elseif(isset($_GET['subpage']) && $_GET['subpage'] == "buyhis" ){
                        require_once('page/buyhis.php');
                    }else{
                        require_once('page/cpass.php');
                    }
                    ?>
            </div>
    </div>
</div>