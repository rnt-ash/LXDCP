$( document ).ready(
    activateGadgets()
);

function activateGadgets() {
    activateConfirmButton(),
    activateToolTips()
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
                if(result) window.location = link;
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
