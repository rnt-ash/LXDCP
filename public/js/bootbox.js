$( document ).ready(function() {
    $(".confirmDialog").click(function(){
        var link = $(this).attr("link"); 
        var text = $(this).attr("text"); 
        bootbox.confirm({
            message: text,
            size: 'small',
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> No',
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Yes',
                    className: 'btn-primary loadingScreen'
                },
            },
            callback: function (result) {
                loadingScreen();
                if(result) window.location = link;
            } 
        });
    });
});

function loadingScreen() {
    $('body').append(
        "<div class='loaderBackground'>"+
            "<div class='spinnerWrapper'>"+
                "<div class='spinner'>"+
                    "<i class='fa fa-spinner fa-pulse fa-5x fa-fw'></i>"+
                    "<div class='loaderText'>Loading ...</div><br /><br />"+
                "</div>"+
            "</div>"+
        "</div>"
    );
    $('body').css("overflow","hidden");
}