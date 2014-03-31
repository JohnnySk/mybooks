$(document).ready(function(){
    $('.up').bind('click', function(){
        $('div.element').animate({top:'-=50'}, 1200);
        $(this).animate({top:'-=50'}, 1200);
        $('div.left').animate({top:'-=50'}, 1200);
        $('div.right').animate({top:'-=50'}, 1200);
        $('div.down').animate({top:'-=50'}, 1200);
    });

    $('.right').bind('click', function(){
        $('div.element').animate({left:'+=50'}, 1200);
        $(this).animate({left:'+=50'}, 1200);
        $('div.up').animate({left:'+=50'}, 1200);
        $('div.left').animate({left:'+=50'}, 1200);
        $('div.down').animate({left:'+=50'}, 1200);
    });

    $('.down').bind('click', function(){
        $('div.element').animate({top:'+=50'}, 1200);
        $(this).animate({top:'+=50'}, 1200);
        $('div.up').animate({top:'+=50'}, 1200);
        $('div.left').animate({top:'+=50'}, 1200);
        $('div.right').animate({top:'+=50'}, 1200);
    });

    $('.left').bind('click', function() {
        $('div.element').animate({left:'-=50'}, 1200);
        $(this).animate({left:'-=50'}, 1200);
        $('div.up').animate({left:'-=50'}, 1200);
        $('div.right').animate({left:'-=50'}, 1200);
        $('div.down').animate({left:'-=50'}, 1200);
    });
});
