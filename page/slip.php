<?php $bank = dd_q("SELECT * FROM bank WHERE 1")->fetch(PDO::FETCH_ASSOC); ?>
<div class="container-fluid p-4">
    <div class="container-sm  ps-4 pe-4">
        <div class="container-fluid bg-glass   p-4">
            <div class="col-lg-7 m-auto">
                <h1 class="text-strongest " data-aos="fade-right" data-aos-duration="500"><i class="fa-duotone fa-coins"></i> &nbsp;Slip Verification (เช็คสลิป)</h1>
                <div data-aos="fade-right" data-aos-duration="600">
                    <hr class="mt-1 mb-2">
                    <h5 class="m-0"><i class="fa-regular fa-plus-circle"></i>&nbsp;ระบบเติมเงินด้วยระบบเช็คสลิป</h5>
                </div>
                <center>
                    <div class="col-lg-4" data-aos="fade-down" data-aos="700">
                        <img src="https://cdn.discordapp.com/attachments/1097917702875660358/1102660427453825074/slipscanpay.png" class="img-fluid">
                    </div>
                </center>
                <div data-aos="fade-left" data-aos-duration="750">
                    <center>
                        <div class="col-12 col-lg-8 text-start">
                            <h5 class="text-storg">ชื่อบัญชี : <?= $bank["fname"] . " " . $bank["lname"] ?></h5>
                            <h5 class="text-storg">เลขบัญชี : <?= $bank["bnum"] ?></h5>
                            <label for="upload" class="form-label">แนบรูปภาพสลิป</label>
                            <input type="file" class="form-control" id="upload" aria-label="Upload">
                            <img id="imageScanner" style="display: none;" src="#" alt="qr-code-scanner-online">
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jsqr@1.1.0/dist/jsQR.js"></script>
<script>
    function File2Base64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = (error) => reject(error);
        });
    }
    async function imageDataFromSource(source) {
        const image = Object.assign(new Image(), {
            src: source
        });
        await new Promise((resolve) => image.addEventListener('load', () => resolve()));
        const context = Object.assign(document.createElement('canvas'), {
            width: image.width,
            height: image.height,
        }).getContext('2d');
        context.imageSmoothingEnabled = false;
        context.drawImage(image, 0, 0);
        return context.getImageData(0, 0, image.width, image.height);
    }

    $(function() {
        $('#upload').change(function() {
            Swal.fire({
                icon: 'warning',
                title: 'โปรดรอสักครู่',
                text: "ระบบกำลังดำเนินการ โปรดห้ามรีเฟรช",
                showConfirmButton: false,
            });
            const input = this;
            const url = $(this).val();
            const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext === "png" || ext === "jpeg" || ext === "jpg")) {
                const reader = new FileReader();
                reader.onload = async function(e) {
                    const URLBase64 = await File2Base64(input.files[0]);
                    const ImageData = await imageDataFromSource(URLBase64);
                    const code = jsQR(ImageData.data, ImageData.width, ImageData.height);
                    if (code && code.data) {
                        var qrcode = code.data;
                        console.log(qrcode);
                        var formData = new FormData();
                        formData.append('qrcode', qrcode);
                        $.ajax({
                            type: 'POST',
                            url: 'system/slip.php',
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
                                window.location = "?page=slip";
                            });
                        }).fail(function(jqXHR) {
                            console.log(jqXHR.responseText)
                            res = jqXHR.responseJSON;
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: res.message
                            }).then(function() {
                                window.location = "?page=slip";
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'สลิปไม่มี Qr Code',
                        }).then(function() {
                            window.location = "?page=slip";
                        });
                    }
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'อนุญาตเฉพาะนามสกุล PNG , JPEG และ JPG เท่านั้น โปรดเลือกใหม่',
                });
            }
        });
    });
</script>