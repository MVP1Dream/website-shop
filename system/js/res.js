var s_size = $(window).width;
if ($(window).width() < 700){
    $('#col-col-10').each(function(){
        $('[id="col-col-10"]').removeClass( "col" ).addClass( "col-10" );
    });
    $('#typing').each(function(){
        $('[id="typing"]').css("font-size", "16px");
    });
    $('#describe-title').each(function(){
        $('[id="describe-title"]').css("font-size", "20px");
    });

    $('.float-ani').each(function(){
        $('[class="float-ani"]').css("width", "150px");
    });
    $('#col8-col10').each(function(){
        $('[id="col8-col10"]').removeClass( "col-8" ).addClass( "col-10" );
    });

}