$(document).ready(function () {

    /**
     * list functions to refactor
     */
    $("div.family:empty").remove();
    $("div.spouse:empty").addClass("none");

    $(".spouse:not(:empty)").prev().addClass("text-right");


    $(".heir").next().each(function () {
        if ($(this).hasClass("none")) {
            $(this).addClass("noline");
        }
    });
    /**
     *  end list
     */

    $(".typeahead").each(function () {
        var element = $(this);

        var url = baseUrl + "/api/search";
        var typeAheadList = new Bloodhound({
            prefetch: {
                url: url,
                filter: function (list) {
                    console.dir(list);
                    return $.map(list, function (data) {
                        return {name: data.name, id:data.id};
                    });
                }
            },
            datumTokenizer: function (d) {
                return Bloodhound.tokenizers.whitespace(d.name);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });
        typeAheadList.initialize();
        $(this).removeClass('typeahead').typeahead(null, {
            displayKey: 'name',
            source: typeAheadList.ttAdapter()
        }
        ).on("typeahead:selected", function(e, datum){
                var form = $(this).parents("form:first");
            
                    form.attr("action", baseUrl+"/ru/tree/person/" + datum.id);
                    form.submit();
                
            });
    }
    );


});
