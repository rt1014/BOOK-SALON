// $(function(){
//     $("nav label").click(function(){
//         var number = $("nav label").index(this);
//         window.location.replace( "../view/main_view.php" );
//         $("section ul").removeClass("show");
//         $("section ul").eq(number).addClass("show");
//     });
// });

$(function(){
    $("nav label").hover(function(){
        $(this).css('filter','brightness(110%)');
    },
    function(){
        $(this).css('filter','brightness(100%)');
    });
});

$(function(){
    $(".item").hover(function(){
        $(this).css('filter','brightness(108%)');
    },
    function(){
        $(this).css('filter','brightness(100%)');
    });
});


