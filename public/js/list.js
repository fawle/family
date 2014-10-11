$(document).ready(function () {


    $("div.family:empty").remove();
    $("div.spouse:empty").addClass("none");

    $(".spouse:not(:empty)").prev().addClass("text-right");


    $(".heir").next().each(function () {
        if ($(this).hasClass("none")) {
            $(this).addClass("noline");
        }
    });


    $(window).bind("load",function () {
        sizing();
    });



    $(".married").on("click", function() {
        console.dir("y");
    });

/**
 * @todo: from bottom to top instead?
 */
    function sizing()
    {
        console.dir("sizing...");
        /** sizings */
        $("ul:not(.root)>li:only-child>.family>.heir").each(function () {
            var heir = this;
            //console.dir($(this).html());
            if (!$(heir).next().hasClass("spouse")) {
                var padding = (parseInt($(heir).closest("ul").css("width")) - parseInt($(heir).css("width"))) / 2;
                $(heir).css("margin-left", padding + "px");
            } 
        });

        $(".heir").next().each(function () {
            if ($(this).hasClass("spouse")) {
                var width = $(this).prev().outerWidth() > $(this).outerWidth() ? $(this).prev().outerWidth() : $(this).outerWidth();
                $(this).closest(".family").css("min-width", parseInt(width) * 2);
            }
        });

        $("li").each(function () {
                var minWidth = 0;
                var that = this;
                $(this).children(".family").each(function (e){
                    minWidth+=parseInt($(this).outerWidth());
                })
                $(that).css("min-width", minWidth+"px");
       });

        $("ul").each(function () {
            var minWidth = 0;
            var that = this;
            $(this).children("li").each(function (e){
                minWidth+=parseInt($(this).outerWidth());
            })
            $(that).css("min-width", minWidth+10+"px");
        });
    }

});
