<nav class="navbar navbar-expand-lg navbar-dark mt-0 shadow-sm mb-0" style="z-index: 55;">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
                <a class="nav-link" href="?page=backend" style="color: var(--font)">แดชบอร์ด</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=website" style="color: var(--font)">จัดการเว็บไซต์</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=payment_manage" style="color: var(--font)">จัดการเติมเงิน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=carousel_manage" style="color: var(--font)">จัดการรูปภาพสไลด์</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=user_edit" style="color: var(--font)">จัดการผู้ใช้</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=shop_manage" style="color: var(--font)">จัดการร้านค้า</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=c_recom_manage" style="color: var(--font)">จัดการแนะนำ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=history_log" style="color: var(--font)">ประวัติทั้งหมด</a>
            </li>
        </ul>
    </div>
    </div>
</nav>
</div>
<div class="col-lg-12">
    <?php
    if (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend") {
        require_once('page/backend/dashboard.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "user_edit") {
        require_once('page/backend/user_edit.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "topup_manage") {
        require_once('page/backend/topup_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "category_manage") {
        require_once('page/backend/category.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "slip_manage") {
        require_once('page/backend/slip_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel_cate") {
        require_once('page/backend/wheel_cate.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel") {
        require_once('page/backend/wheel.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "product_manage") {
        require_once('page/backend/product.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "stock_manage" && $_GET['id'] != "") {
        require_once('page/backend/stock.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel_manage") {
        require_once('page/backend/wheel.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "stock_wheel" && $_GET['id'] != "") {
        require_once('page/backend/stock_wheel.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "code_manage") {
        require_once('page/backend/code_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend_buy_history") {
        require_once('page/backend/buy_history.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend_topup_history") {
        require_once('page/backend/topup_history.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "website") {
        require_once('page/backend/website.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "carousel_manage") {
        require_once('page/backend/carousel_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "recom_manage") {
        require_once('page/backend/recom_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "crecom_manage") {
        require_once('page/backend/crecom_manage.php');
    }
    ?>
</div>
</div>
</div>
</div>