<style>
    .form-control {
        /* border: none;
        border-bottom: 3px solid var(--main); */
        border-radius: 1vh;
    }
</style>
<div class="container-fluid p-4">
    <div class="container-sm m-cent ps-4 pe-4">
        <center>
            <div class="col-lg-6 m-auto bg-glass rounded  p-0 pb-3">
                <div class="col-10 col-lg-12 m-cent pt-4" style="margin-bottom: 4em!important; ">
                    <center>
                        <h1 class="text-strongest mt-3" style="font-size: 48px; text-transform: uppercase;"><?php echo $config['name']; ?></h1>
                        <h3 class="text-strongest mb-3">สร้างบัญชี</h3>
                    </center>
                    <div class="container-fluid ps-0 pe-0" style="margin-top: 1em;">

                        <div class="col-lg-8 m-cent mt-2">
                            
                            <div class="mb-1 text-start">
                                <label class="ms-1"> ชื่อผู้ใช้</label>
                                <input type="text" id="user" class="form-control" placeholder="Username" aria-describedby="basic-addon1" style="border-radius: 0.5vh;">
                            </div>
                            <div class="mb-1 text-start">
                                <label class="ms-1"> รหัสผ่าน</label>
                                <input type="password" id="pass" class="form-control" placeholder="Password" aria-describedby="basic-addon1" style="border-radius: 0.5vh;">
                            </div>
                            <div class="mb-3 text-start">
                                <label class="ms-1"> รหัสผ่านอีกครั้ง</label>
                                <input type="password" id="pass2" class="form-control" placeholder="Confirm password" aria-describedby="basic-addon1" style="border-radius: 0.5vh;">
                            </div>
                            <div class="mt-3">
                                <div id="captcha" class="cf-turnstile" data-sitekey="0x4AAAAAAAHloNCBDFBETKy5" data-theme="light" data-callback="onloadTurnstileCallback"></div>
                            </div>
                            <br>
                            <button class="btn bg-main   text-white  ps-4 pe-4  pt-2 pb-2 w-100 d-inline" id="btn_regis">&nbsp;สมัครสมาชิก</button>
                            <br>
                            <div class="pt-3 text-main">
                                <span>มีบัญชีแล้ว? <a class="ms-1" href="?page=login">&nbsp;เข้าสู่ระบบตอนนี้</a></span>
                            </div>
                    </div>
                </div>
        </center>
    </div>
</div>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit"></script>
<script type="text/javascript">
    var captcha;
    turnstile.ready(() => {
        turnstile.render('#captcha', {
            sitekey: '0x4AAAAAAAHloNCBDFBETKy5',
            callback: (token) => {
                captcha = token;
            },
        });
    });
    $("#btn_regis").click(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('user', $("#user").val());
        formData.append('pass', $("#pass").val());
        formData.append('pass2', $("#pass2").val());
        formData.append('captcha', captcha);
        $('#btn_regis').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: 'system/register.php',
            data: formData,
            contentType: false,
            processData: false,
        }).done(function(res) {

            result = res;
            console.log(result);
            turnstile.reset();
            if (res.status == "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: result.message
                }).then(function() {
                    window.location = "?page=home";
                });
            }
            if (res.status == "fail") {
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
                    text: result.message
                });
                $('#btn_regis').removeAttr('disabled');
            }
        }).fail(function(jqXHR) {
            console.log(jqXHR);
            //   res = jqXHR.responseJSON;
            turnstile.reset();
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            //console.clear();
            $('#btn_regis').removeAttr('disabled');
        });
    });
    $(function() {
        function rescaleCaptcha() {
            var width = $('.cf-turnstile').parent().width();
            var scale;
            if (width < 302) {
                scale = width / 302;
            } else {
                scale = 1.0;
            }

            $('.cf-turnstile').css('transform', 'scale(' + scale + ')');
            $('.cf-turnstile').css('-webkit-transform', 'scale(' + scale + ')');
            $('.cf-turnstile').css('transform-origin', '0 0');
            $('.cf-turnstile').css('-webkit-transform-origin', '0 0');
        }

        rescaleCaptcha();
        $(window).resize(function() {
            rescaleCaptcha();
        });

    });
</script>