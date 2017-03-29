$( document ).ready(
    activateGadgets()
);

function activateGadgets() {
    activateConfirmButton(),
    activateToolTips(),
    activatePending()
}

function activateConfirmButton() {
    $(".confirm-button").click(function(){
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
                },
            },
            callback: function (result) {
                if(result){
                    window.location = link;
                    loadingScreen();
                }
            } 
        });
    });
}

function activateToolTips() {
    $('[data-toggle="tooltip"]').tooltip()
}

function toggleIcon(icon) {
    $(icon).toggleClass('fa fa-chevron-down fa fa-chevron-right');
}

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

function activatePending() {
    $(".pending").find(".btn").addClass("disabled");
}