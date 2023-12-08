<div class="container-fluid ">
    <div class="container-sm m-auto ">
        <div class="container-fluid shadow-sm" data-aos="zoom-in">
            <div class="d-flex ">
                <img src="assets/icon/dollar.png" class="align-self-center" style="max-height: 78px;">
                <div class="align-self-center">
                    <h2 class="text-main ms-1 mb-0"> จัดการระบบเติมเงิน</h2>
                    <h5 class="text-main ms-1"> ระบบเติมเงินต่างๆ</h5>
                </div>
            </div>
            <div class="container-fluid mt-2 mb-5 p-4">
                <div class="container-sm p-0">
                    <div class="row justify-content-center">
                        <div class="col-lg-3">
                            <div class="container-fluid bg-glass p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=angpao_manage" style="text-decoration: none;">
                                    <center>
                                        <img src="https://media.discordapp.net/attachments/1118132016437809212/1125744772733227039/logo-truemoneywallet-300x300-1-removebg-preview.png" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class="text-main mb-0">จัดการวอเลท</span></h2>
                                        <small class="text-main">สามารถจัดการเติมเงินวอเลทได้ที่นี่</span></small>
                                    </center>
                                </a>
                            </div>
                        </div>
                        <!-- <div class="col-lg-3">
                            <div class="container-fluid bg-glass p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=bank_manage" style="text-decoration: none;">
                                    <center>
                                        <img src="assets/icon/dollar.png" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class="text-main mb-0">จัดการธนาคาร</span></h2>
                                        <small class="text-main">สามารถจัดการเติมเงินธนาคารได้ที่นี่</span></small>
                                    </center>
                                </a>
                            </div>
                        </div> -->
                        <div class="col-lg-3">
                            <div class="container-fluid bg-glass p-4 pt-5 rounded shadow-sm border-ys count-only" style="border-radius: 1vh;">
                                <a href="?page=code_manage" style="text-decoration: none;">
                                    <center>
                                        <img src="assets/icon/gift-card.png" class="img-fluid mb-3" style="height: 100px;">
                                        <h2 class="text-main mb-0">จัดการโค้ด</h2>
                                        <small class="text-main">สามารถจัจัดการโค้ดได้ที่นี่</small>
                                    </center>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>        <div class="modal fade" id="buy_count" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title"><i class="fa-duotone fa-cart-shopping-fast"></i>&nbsp;&nbsp;สั่งซื้อสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3 pb-2">
                        <div class="row mt-2">
                            <div class="col">
                                <hr>
                            </div>
                            <div class="col-auto">จำนวนสินค้าที่จะซื้อ</div>
                            <div class="col">
                                <hr>
                            </div>
                            <div class="mb-2">
                                <input type="number" id="b_count" class="form-control text-center" value="1">
                            </div>
                            <div class="d-flex justify-content-between pe-3 ps-3 mt-2">
                                <span class="m-0 align-self-center">สินค้าคงเหลือ  ชิ้น</span>
                                <span class="m-0 align-self-center" style="color: white; padding: 3.5px 5px; border-radius: 1vh; background-color: var(--main);">ยอดเงินคงเหลือ 520</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="shop-btn" class="btn w-100" style="background-color: var(--main); color: #fff;" onclick="if (!window.__cfRLUnblockHandlers) return false; if (!window.__cfRLUnblockHandlers) return false; buybox()" data-id="" data-name="" data-price="" data-cf-modified-e7215627a8a503e3ee761773-="" data-cf-modified-cd8dca9f70881c80d85ea5f0-=""><i class="text-black fa-duotone fa-cart-shopping-fast"></i>&nbsp;&nbsp;สั่งซื้้อเลย</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>