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
                },
            },
            callback: function (result) {
                if(result) window.location = link;
            } 
        });
    });
});