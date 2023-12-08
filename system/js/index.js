// โค้ดปกติ
console.log("Calculate are circle [r = 7]");
var area = 22/7 * (7 * 7);
console.log(area);
console.log("Calculate are circle [r = 14]");
var area = 22/7 * (14 * 14);
console.log(area);





// โค้ดที่มี function ช่วยแล้ว
function circle_area(r){
    console.log("Calculate area circle [ r = ",r," ]");
    var area = 22/7 * (r * r);
    return area;
}
console.log(circle_area(7));
console.log(circle_area(14));

