
$(document).ready(function () {
    
    $('#safariz').mouseover(function (){
        $(this).css("transform", "scale(1.5) rotate(-6deg)");
    });

    $('#safariz').mouseout(function (){
        $(this).css("transform", "scale(1) rotate(-6deg)");
    });
    
    $('#gagner').mouseover(function (){
        $(this).css("transform", "scale(1.5) rotate(4deg)");
    });

    $('#gagner').mouseout(function (){
        $(this).css("transform", "scale(1) rotate(4deg)");
    });

    $('#camargue').mouseover(function (){
        $(this).css("transform", "scale(1.5) rotate(4deg)");
    });

    $('#camargue').mouseout(function (){
        $(this).css("transform", "scale(1) rotate(4deg)");
    });
});