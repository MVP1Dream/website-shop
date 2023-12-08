<?php 
    //topup by day
    date_default_timezone_set("Asia/Bangkok");
    $midnight = strtotime("today 00:00");
    $date_day =  date('Y-m-d H:i:s', $midnight);
    $q_1 = dd_q("SELECT sum(amount) AS total FROM topup_his WHERE date > ?",[$date_day]);
    $day = $q_1->fetch(PDO::FETCH_ASSOC);
    if($day["total"] == null){
        $day["total"] = "0.00";
    }
    // topup by month
    date_default_timezone_set("Asia/Bangkok");
    $midnight = strtotime("today 00:00");
    $date_month =  date('Y-m-01 H:i:s', $midnight);
    $q_2 = dd_q("SELECT sum(amount) AS total FROM topup_his WHERE date > ?",[$date_month]);
    $month = $q_2->fetch(PDO::FETCH_ASSOC);
    if($month["total"] == null){
        $month["total"] = "0.00";
    }
    // topup all
    $q_3 = dd_q("SELECT sum(amount) AS total FROM topup_his ");
    $topup = $q_3->fetch(PDO::FETCH_ASSOC);
    if($topup["total"] == null){
        $topup["total"] = "0.00";
    }
    //shop by day
    $q_4 = dd_q("SELECT id FROM boxlog WHERE date > ?",[$date_day]);
    $box_day = $q_4->rowCount();
    // shop by month
    $q_5 = dd_q("SELECT id FROM boxlog WHERE date > ?",[$date_month]);
    $box_month = $q_5->rowCount();
    // shop by all
    $q_6 = dd_q("SELECT id FROM boxlog");
    $box_all = $q_6->rowCount();

?>
<div class="container-sm bg-glass  mt-5 shadow-sm p-4 mb-4" data-aos="fade-down">
    <center>
        <h1 class=""><i class="fa-duotone fa-chart-simple"></i>&nbsp;หน้าแดชบอร์ด</h1>
    </center>
    <hr>
    <div class="row jusify-content-between mt-4">
        <div class="col-lg-4 mb-2">
            <div class="container-fluid  p-4 shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <center>
                    <h1 class=""><?php echo $month["total"];?>฿</h1>
                    <h5 class="">ยอดการเติมในเดือนนี้</h5>
                </center>
            </div>
        </div>
        <div class="col-lg-4 mb-2">
            <div class="container-fluid  p-4 shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <center>
                    <h1 class=""><?php echo $day["total"];?>฿</h1>
                    <h5 class="">ยอดการเติมในวันนี้</h5>
                </center>
            </div>
        </div>
        <div class="col-lg-4 mb-2">
            <div class="container-fluid  p-4 shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <center>
                    <h1 class=""><?php echo $topup["total"];?>฿</h1>
                    <h5 class="">ยอดการเติมทั้งหมด</h5>
                </center>
            </div>
        </div>
        <div class="col-lg-4 mb-2">
            <div class="container-fluid  p-4 shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <center>
                    <h1 class=""><?php echo $box_month;?></h1>
                    <h5 class="">ยอดกาารซื้อสินค้าเดือนนี้</h5>
                </center>
            </div>
        </div>
        <div class="col-lg-4 mb-2">
            <div class="container-fluid  p-4 shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <center>
                    <h1 class=""><?php echo $box_day;?></h1>
                    <h5 class="">ยอดกาารซื้อสินค้าวันนี้</h5>
                </center>
            </div>
        </div>
        <div class="col-lg-4 mb-2">
            <div class="container-fluid  p-4 shadow" style="border-bottom: 4px solid var(--main)!important;  border-radius: 10px;">
                <center>
                    <h1 class=""><?php echo $box_all;?></h1>
                    <h5 class="">ยอดกาารซื้อสินค้าทั้งหมด</h5>
                </center>
            </div>
        </div>
    </div>
</div>