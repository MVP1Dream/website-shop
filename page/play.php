<?php
if (isset($_GET['wheel'])) {
    $find = dd_q("SELECT * FROM wheel WHERE id = ? ", [$_GET['wheel']]);
    if ($find->rowCount() == 1) {
        $wheel = $find->fetch(PDO::FETCH_ASSOC);
?>
        <script src="/assets/easywheel/easywheel.js"></script>
        <link rel="stylesheet" href="/assets/easywheel/easywheel.css">
        <style>
            img.asdas {
                width: 110px;
                transform: rotate(-260deg) translate(-16px, -20%);
                max-width: 190px !important;
                margin-top: 23px;
                height: auto !important;
            }

            /* :root {
            --main-color: <?= $config["main_color"]; ?>;
            --sub-color: <?= $config["sec_color"]; ?>;
            --font-color: <?= $config["font_color"]; ?>;
            }

            .btn-main {
            font-size: 15px;
            padding: 10px 25px;
            border-radius: 1vh;
            text-decoration: none;
            color: var(--main-color);
            font-family: 'Prompt', sans-serif;
            border: 2.5px dotted var(--main-color);
            filter: drop-shadow(0 0 90px var(--main-color));
            transition: all .5s ease;
            }

            .btn-main:hover {
                color: white;
                background-color: var(--main-color);
                border: 2.5px solid var(--main-color);
            } */

            @media screen and (max-width: 767px) {
                img.asdas {
                    width: 120px;
                    /* width: 140px; */
                    transform: rotate(-272deg) translate(3px, -43%);
                }
            }

            @media screen and (max-width: 577px) {
                img.asdas {
                    width: 140px;
                    /* width: 160px; */
                }
            }

            @media screen and (max-width: 460px) {
                img.asdas {
                    width: 125px;
                    /* width: 145px; */

                    margin: 15px;
                }
            }

            @media screen and (max-width: 430px) {
                img.asdas {
                    width: 120px;
                    /* width: 140px; */
                    transform: rotate(-272deg) translate(3px, -49%);
                    padding: 10px;
                    margin: 15px;
                }
            }

            @media screen and (max-width: 400px) {
                img.asdas {
                    width: 105px;
                    /* width: 125px; */
                    margin: 15px;
                    padding: 10px;
                }
            }

            @media screen and (max-width: 370px) {
                img.asdas {
                    width: 95px;
                    /* width: 115px; */
                    transform: rotate(-272deg) translate(3px, -51%);
                    margin: 15px;
                    padding: 10px;
                }
            }

            @media screen and (max-width: 350px) {
                img.asdas {
                    width: 80px;
                    margin: 15px;
                    padding: 10px;
                    /* width: 80px; */
                }
            }

        </style>
        <div class="container-fluid p-0">
            <div class="container-sm m-auto p-4 pt-0">
                <div class="container-fluid p-4  bg-glass shadow-sm ">
                    <div class="d-flex mb-2">
                        <img src="assets/icon/wheel.png" class="align-self-center" style="max-height: 78px;">
                        <div class="align-self-center">
                            <h2 class=" ms-1 mb-0"><?= $wheel['name'] ?></h2>
                            <h5 class=" ms-1">เล่นวงล้อนำโชค </h5>
                        </div>
                    </div>
                    <div class="spinner"></div>
                    <div class="col-lg-8 m-auto">
                        <div class="row">
                            * สุ่มรางวัลครั้งละ <?php echo number_format($wheel["price"], 2)?> เครดิต *
                        * เมื่อกดสุ่มแล้วไม่สามารถขอคืนพ้อยต์ได้ในทุกกรณี *
                            <center>
                                <a class="btn bg-main w-100 text-white mb-2" id="random" style="border-radius: 50px;">เริ่มสุ่มรางวัล</a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            jQuery(document).ready(function() {
                var tick = new Audio('/assets/easywheel/tick.mp3');
                $('.spinner').easyWheel({
                    items: [
                        <?php 
                            $find = dd_q("SELECT * FROM wheel_item WHERE w_id = ? ", [$wheel['id']]);
                            while($item = $find->fetch(PDO::FETCH_ASSOC)){
                        ?>
                            {
                                id: '<?= $item['id'] ?>',
                                name: "<img src='<?= htmlspecialchars($item['img'])?>' class='asdas'></img>",
                                message: '<?= htmlspecialchars($item['name'])?>',
                                color: '#FFCC00',
                            },

                        <?php
                            }    
                        ?>


                    ],
                    centerBackground: '#fff',
                    button: '.btn',
                    type: 'spin',
                    frame: 1,
                    outerLineColor: '#000',
                    centerLineColor: '#000',
                    selectedSliceColor: '#000',
                    sliceLineColor: '#000',
                    centerImage: '<?= htmlspecialchars($config['logo'])?>',
                    markerAnimation: true,
                    centerClass: 0,
                    width: 600,
                    textOffset: 10,
                    textLine: "v",
                    textArc: false,
                    sliceLineWidth: 1,
                    shadowOpacity: 0,
                    fontSize: 18,
                    centerWidth: 35,
                    centerImageWidth: 30,
                    outerLineWidth: 4,
                    ajax: {
                        url: '/system/spin.php', 
                        type: 'POST',
                        data: {'wheel': '<?= $wheel['id'] ?>'},
                        nonce: true,
                        success: function(msg) {
                        },
                        error: function(msg) {
                            msg = msg.responseJSON;
                            Swal.fire({
                                icon: 'error',
                                title: 'ขออภัย',
                                text: msg.message,
                            }).then(function() {
                                window.location.reload();
                            })

                        }
                    },
                    onStart: function(results, spinCount, now) {


                    },
                    onStep: function(results, slicePercent, circlePercent) {
                        if (typeof tick.currentTime !== 'undefined')
                            tick.currentTime = 0;
                        tick.play();
                    },
                    onProgress: function(results, spinCount, now) {
                        $(".spin-button").attr("disabled", true);
                        $(".spin-button").html("รอสักครู่...");
                    },

                    onComplete: function(results, count, now) {
                        console.log(results)
                        Swal.fire({
                            icon: 'success',
                            title: 'ยินดีด้วยคุณได้รับ',
                            text: results.message,
                        }).then(function() {
                            window.location.reload();
                        })

                    }
                });
            });
        </script>
<?php
    }
}
?>