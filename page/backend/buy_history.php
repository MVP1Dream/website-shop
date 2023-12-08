<div class="container-sm bg-glass  mt-5 shadow-sm p-4 mb-4" data-aos="fade-down">
    <center>
        <h1 class="">&nbsp;<i class="fa-duotone fa-history"></i>&nbsp;ประวัติการสั่งซื้อ</h1>
    </center>
    <hr>
    <div class="table-responsive mt-3 ">
        <table id="table" class=" table mt-2">
            <thead class="table-dark  bg-dark ">
                <tr class="">
                    <th class="sorting sorting_desc">id</th>
                    <th > ชื่อผู้ใช้</th>
                    <th > ของที่ได้รับ</th>
                    <th > ชื่อสินค้า</th>
                    <th > วันที่</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $get_user = dd_q("SELECT * FROM boxlog ORDER BY date DESC");
                    while($row = $get_user->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <tr >
                        <td><?php echo $row['id'];?></td>
                        <td ><?php echo htmlspecialchars($row['username']);?></td>
                        <td><?php echo htmlspecialchars($row['prize_name']);?></td>
                        <td><?php echo htmlspecialchars($row['category']);?></td>
                        <td><?php echo htmlspecialchars($row['date']);?></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>